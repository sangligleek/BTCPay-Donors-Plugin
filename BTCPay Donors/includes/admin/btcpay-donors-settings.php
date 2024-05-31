<?php

function btcpay_donors_settings_page()
{
?>
  <div class="wrap">
    <h1>BTCPay Donors Settings</h1>
    <p></p>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
      <?php
      settings_fields("btcpay_donors");
      do_settings_sections("btcpay-donors-admin");
      submit_button(); ?>
    </form>
  </div>
<?php
}
function btcpay_donors_settings_init()
{
  register_setting(
    "btcpay_donors", // option_group
    "btcpay_donors", // option_name
    "btcpay_donors_sanitize" // sanitize_callback
  );

  add_settings_section(
    "btcpay_donors_setting_btcpay", // id
    "BTCPay Server", // title
    "btcpay_donors_section_btcpay_info", // callback
    "btcpay-donors-admin" // page
  );

  add_settings_field(
    "btcpay_store_id", // id
    "Store ID", // title
    "btcpay_store_id_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "btcpay_store_url", // id
    "Store URL", // title
    "btcpay_store_url_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "btcpay_store_secret", // id
    "Store Secret", // title
    "btcpay_store_secret_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "btcpay_api_key", // id
    "API Key", // title
    "btcpay_api_key_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "minimum_donation_amount_gold", // id
    "Minimum donation amount for Gold donors", // title
    "minimum_donation_amount_gold_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "minimum_donation_amount_silver", // id
    "Minimum donation amount for Silver donors", // title
    "minimum_donation_amount_silver_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "minimum_donation_amount", // id
    "Minimum donation amount for Bronze donors", // title
    "minimum_donation_amount_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_field(
    "minimum_donation_amount_currency", // id
    "Minimum donation amount currency", // title
    "minimum_donation_amount_currency_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_btcpay" // section
  );

  add_settings_section(
    "btcpay_donors_setting_twitter", // id
    "Twitter", // title
    "btcpay_donors_section_twitter_info", // callback
    "btcpay-donors-admin" // page
  );

  add_settings_field(
    "twitter_bearer_token", // id
    "Bearer Token", // title
    "twitter_bearer_token_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_twitter" // section
  );

  add_settings_section(
    "btcpay_donors_setting_display", // id
    "Display", // title
    "btcpay_donors_section_display_info", // callback
    "btcpay-donors-admin" // page
  );

  add_settings_field(
    "custom_css", // id
    "Custom CSS", // title
    "custom_css_callback", // callback
    "btcpay-donors-admin", // page
    "btcpay_donors_setting_display", // section
    [
      "description" => __("Custom CSS to be applied to the widget"),
    ]
  );
}

function btcpay_donors_sanitize($input)
{
  $sanitary_values = [];
  if (isset($input["btcpay_store_id"])) {
    $sanitary_values["btcpay_store_id"] = sanitize_text_field($input["btcpay_store_id"]);
  }

  if (isset($input["btcpay_store_url"])) {
    $sanitary_values["btcpay_store_url"] = sanitize_text_field($input["btcpay_store_url"]);
  }

  if (isset($input["btcpay_store_secret"])) {
    $sanitary_values["btcpay_store_secret"] = sanitize_text_field($input["btcpay_store_secret"]);
  }

  if (isset($input["btcpay_api_key"])) {
    $sanitary_values["btcpay_api_key"] = sanitize_text_field($input["btcpay_api_key"]);
  }

  if (isset($input["minimum_donation_amount_gold"])) {
    $sanitary_values["minimum_donation_amount_gold"] = sanitize_text_field($input["minimum_donation_amount_gold"]);
  }

  if (isset($input["minimum_donation_amount_silver"])) {
    $sanitary_values["minimum_donation_amount_silver"] = sanitize_text_field($input["minimum_donation_amount_silver"]);
  }

  if (isset($input["minimum_donation_amount"])) {
    $sanitary_values["minimum_donation_amount"] = sanitize_text_field($input["minimum_donation_amount"]);
  }

  if (isset($input["minimum_donation_amount_currency"])) {
    $sanitary_values["minimum_donation_amount_currency"] = $input["minimum_donation_amount_currency"];
  }

  if (isset($input["twitter_bearer_token"])) {
    $sanitary_values["twitter_bearer_token"] = sanitize_text_field(str_replace("%3D", "=", $input["twitter_bearer_token"]));
  }

  if (isset($input["custom_css"])) {
    $sanitary_values["custom_css"] = sanitize_textarea_field($input["custom_css"]);

    /*
    $custom_css_str = sanitize_textarea_field($input["custom_css"]);

    // Minify CSS
    $custom_css_str = str_replace(["\n", "\r", "\t", " "], "", $custom_css_str);

    // Beautify CSS
    $custom_css_str = preg_replace("/;([^}])/", ';&#10;&#09;${1}', $custom_css_str);
    $custom_css_str = preg_replace("/([^&#10;]);\}/", '${1};&#10;}', $custom_css_str);
    $custom_css_str = preg_replace("/\{/", " {&#10;&#09;", $custom_css_str);
    $custom_css_str = preg_replace("/\{[&#10;,&#09;]*\}/", "{}", $custom_css_str);
    $custom_css_str = preg_replace("/&#09;([^:]+):/", "&#09;${1}: ", $custom_css_str);
    $custom_css_str = preg_replace("/,/", ",&#10;", $custom_css_str);
    $custom_css_str = preg_replace("/\}/", "}&#10;", $custom_css_str);
    $custom_css_str = preg_replace("/\{[&#10;,&#09;]*\}/", "{}", $custom_css_str);

    $sanitary_values["custom_css"] = $custom_css_str;
    */
  }

  return $sanitary_values;
}

function btcpay_donors_section_btcpay_info()
{
  printf("<p>Enter the details of the BTCPay Server on which you will receive donations.</p>");
}

function btcpay_donors_section_twitter_info()
{
  printf("<p>This is used to fetch the donator's Twitter profile picture (if they specified an username).</p>");
}

function btcpay_donors_section_display_info()
{
  printf("<p>Customize the look of the donors list.</p>");
}

function btcpay_store_id_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[btcpay_store_id]" id="btcpay_store_id" value="%s">',
    isset($btcpay_donors_options["btcpay_store_id"]) ? esc_attr($btcpay_donors_options["btcpay_store_id"]) : ""
  );
}

function btcpay_store_url_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[btcpay_store_url]" id="btcpay_store_url" value="%s">',
    isset($btcpay_donors_options["btcpay_store_url"]) ? esc_attr($btcpay_donors_options["btcpay_store_url"]) : ""
  );
}

function btcpay_store_secret_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[btcpay_store_secret]" id="btcpay_store_secret" value="%s">',
    isset($btcpay_donors_options["btcpay_store_secret"]) ? esc_attr($btcpay_donors_options["btcpay_store_secret"]) : ""
  );
}

function btcpay_api_key_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[btcpay_api_key]" id="btcpay_api_key" value="%s">',
    isset($btcpay_donors_options["btcpay_api_key"]) ? esc_attr($btcpay_donors_options["btcpay_api_key"]) : ""
  );
}

function minimum_donation_amount_gold_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[minimum_donation_amount_gold]" id="minimum_donation_amount_gold" value="%s">',
    isset($btcpay_donors_options["minimum_donation_amount_gold"]) ? esc_attr($btcpay_donors_options["minimum_donation_amount_gold"]) : ""
  );
}

function minimum_donation_amount_silver_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[minimum_donation_amount_silver]" id="minimum_donation_amount_silver" value="%s">',
    isset($btcpay_donors_options["minimum_donation_amount_silver"]) ? esc_attr($btcpay_donors_options["minimum_donation_amount_silver"]) : ""
  );
}

function minimum_donation_amount_callback()
{
  $btcpay_donors_options = get_option("btcpay_donors");
  printf(
    '<input required class="regular-text" type="text" name="btcpay_donors[minimum_donation_amount]" id="minimum_donation_amount" value="%s">',
    isset($btcpay_donors_options["minimum_donation_amount"]) ? esc_attr($btcpay_donors_options["minimum_donation_amount"]) : ""
  );
}

function minimum_donation_amount_currency_callback()
{
  $btcpay_donors_options = get_option(
    "btcpay_donors"
  ); ?> <select required name="btcpay_donors[minimum_donation_amount_currency]" id="minimum_donation_amount_currency">
    <?php $selected =
      isset($btcpay_donors_options["minimum_donation_amount_currency"]) && $btcpay_donors_options["minimum_donation_amount_currency"] === "btc"
      ? "selected"
      : ""; ?>
    <option value="btc" <?php echo $selected; ?>>BTC</option>
    <!-- <?php $selected =
            isset($btcpay_donors_options["minimum_donation_amount_currency"]) && $btcpay_donors_options["minimum_donation_amount_currency"] === "sats"
            ? "selected"
            : ""; ?>
			<option value="sats" <?php echo $selected; ?>>sats</option> -->
    <?php $selected =
      isset($btcpay_donors_options["minimum_donation_amount_currency"]) && $btcpay_donors_options["minimum_donation_amount_currency"] === "eur"
      ? "selected"
      : ""; ?>
    <option value="eur" <?php echo $selected; ?>>EUR</option>
  </select> <?php
          }

          function twitter_bearer_token_callback()
          {
            $btcpay_donors_options = get_option("btcpay_donors");
            printf(
              '<input class="regular-text" type="text" name="btcpay_donors[twitter_bearer_token]" id="twitter_bearer_token" value="%s">',
              isset($btcpay_donors_options["twitter_bearer_token"]) ? esc_attr($btcpay_donors_options["twitter_bearer_token"]) : ""
            );
          }

          function custom_css_callback()
          {
            $btcpay_donors_options = get_option("btcpay_donors");

            printf(
              '<textarea class="regular-text" name="btcpay_donors[custom_css]" id="custom_css" rows="10">%s</textarea>',
              isset($btcpay_donors_options["custom_css"])
                ? esc_attr($btcpay_donors_options["custom_css"])
                : ".donors-container {}&#10;.donor-card {}&#10;.donor-img {}&#10;.donor-name {}"
            );
          }
