<?php
global $btcpay_donors_request;

$btcpay_donors_options = get_option("btcpay_donors");
$request_body = $btcpay_donors_request->get_body();
$request_header_hash = $btcpay_donors_request->get_header("btcpay_sig");

function btcpay_donors_get_invoice_details($invoice_id)
{
  $btcpay_donors_options = get_option("btcpay_donors");

  $url = $btcpay_donors_options["btcpay_store_url"] . "/api/v1/stores/" . $btcpay_donors_options["btcpay_store_id"] . "/invoices/" . $invoice_id;
  $args = [
    "headers" => [
      "Content-Type" => "application/json",
      "Authorization" => "token " . $btcpay_donors_options["btcpay_api_key"],
    ],
  ];

  $response = wp_remote_get($url, $args);
  $body = wp_remote_retrieve_body($response);
  $invoice = json_decode($body);

  return $invoice;
}

/* API to convert currency to BTC
 * blockchain.info
 */
function btcpay_donors_currency_to_btc($currency, $amount)
{
  if (strtolower($currency) == "sats") {
    return $amount / 100000000;
  }
  return file_get_contents("https://blockchain.info/tobtc?currency=$currency&value=$amount");
}

/*

/*
 * Webhook receiver callback
 * add a donor if invoice is settled and more than min amount expected
 * BTCPAY SIG
 * https://docs.btcpayserver.org/API/Greenfield/v1/#operation/Webhooks_CreateWebhook
 */
if (
  isset($request_header_hash) &&
  $request_header_hash == "sha256=" . hash_hmac("sha256", $request_body, $btcpay_donors_options["btcpay_store_secret"])
) {
  $body = json_decode($request_body);
  $invoice_type = $body->type;
  $invoice_id = $body->invoiceId;

  // We only care about settled invoices
  if ($invoice_type == "InvoiceSettled") {
    $invoice = btcpay_donors_get_invoice_details($invoice_id);
    $invoice_in_btc =
      strtolower($invoice->currency) != "btc" ? btcpay_donors_currency_to_btc($invoice->currency, $invoice->amount) : $invoice->amount;
    $minimum_donation_in_btc =
      strtolower($btcpay_donors_options["minimum_donation_amount_currency"]) != "btc"
      ? btcpay_donors_currency_to_btc($btcpay_donors_options["minimum_donation_amount_currency"], $btcpay_donors_options["minimum_donation_amount"])
      : $btcpay_donors_options["minimum_donation_amount"];

    if (floatval($invoice_in_btc) >= floatval($minimum_donation_in_btc)) {
      $donor_name = $invoice->metadata->itemDesc;
      $donor_amount = $invoice_in_btc;

      if (is_string($donor_name) && $donor_name != "") {
        if (!btcpay_donors_add_donor($donor_name, $donor_amount)) {
          echo json_encode(["message" => "error adding donor"]);
        } else {
          echo json_encode(["message" => "donor added"]);
        }
      } else {
        echo json_encode(["message" => "no donor name, skipping"]);
      }
    } else {
      echo json_encode(["message" => "amount too low, skipping"]);
    }
  }
} else {
  echo json_encode(["message" => "invalid signature"]);
}

?>