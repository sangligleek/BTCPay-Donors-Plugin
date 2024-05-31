<?php
/*
Plugin Name: BTCPay Donors 
Description: Automatically register a donor when a BTCPay Server invoice is paid (a minimum amount per classification can be set). Donors can also be added manually. Display donors list with a WP shortcode.
Author: Sangligleek
Version: 2.0
*/
require_once plugin_dir_path(__FILE__) . "includes/btcpay-donors-database.php";

if (is_admin()) {
  require_once plugin_dir_path(__FILE__) . "includes/admin/btcpay-donors-admin.php";
}

add_action("rest_api_init", "btcpay_donors_register_endpoints");
add_action("admin_post_btcpay_donors_add_donor", "btcpay_donors_form_add_donor");
add_action("admin_post_btcpay_donors_delete_donor", "btcpay_donors_form_delete_donor");

function btcpay_donors_register_endpoints()
{
  register_rest_route("btcpay-donors/v1", "callback", [
    "methods" => "POST",
    "callback" => "btcpay_donors_rest_webhook_callback",
    "permission_callback" => "__return_true",
  ]);
}

function btcpay_donors_form_add_donor($request)
{
  if (isset($_POST["add_donor_meta_nonce"]) && wp_verify_nonce($_POST["add_donor_meta_nonce"], "add_donor_meta_form_nonce")) {
    $donor_name = sanitize_text_field($_POST["name"]);
    $donor_amount = sanitize_text_field($_POST["amount"]);

    $donor = btcpay_donors_add_donor($donor_name, $donor_amount);

    if ($donor) {
      wp_redirect(admin_url("admin.php?page=btcpay-donors-list&donor_added=true"));
    } else {
      wp_redirect(admin_url("admin.php?page=btcpay-donors-list&donor_added=false"));
    }
  }
}

function btcpay_donors_form_delete_donor($request)
{
  if (isset($_POST["delete_donor_meta_nonce"]) && wp_verify_nonce($_POST["delete_donor_meta_nonce"], "delete_donor_meta_form_nonce")) {
    $donor_id = sanitize_text_field($_POST["id"]);

    $donor = btcpay_donors_delete_donor($donor_id);

    if ($donor) {
      wp_redirect(admin_url("admin.php?page=btcpay-donors-list&donor_deleted=true"));
    } else {
      wp_redirect(admin_url("admin.php?page=btcpay-donors-list&donor_deleted=false"));
    }
  }
}

function btcpay_donors_rest_webhook_callback($request)
{
  global $btcpay_donors_request;
  $btcpay_donors_request = $request;

  include plugin_dir_path(__FILE__) . "includes/btcpay-donors-webhook.php";

  return;
}

add_shortcode("btcpay_donors_shortcode_donors", "btcpay_donors_shortcode_donors");
function btcpay_donors_shortcode_donors()
{
  ob_start();
  include plugin_dir_path(__FILE__) . "includes/btcpay-donors-list.php";
  return ob_get_clean();
}
