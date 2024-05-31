<?php

include plugin_dir_path(__FILE__) . "btcpay-donors-settings.php";

add_action("admin_menu", "btcpay_donors_add_plugin_pages");
add_action("admin_init", "btcpay_donors_pages_init");

function btcpay_donors_add_plugin_pages()
{
  // Add menu for BTCPay Donors
  add_menu_page(
    "BTCPay Donors", // page_title
    "BTCPay Donors", // menu_title
    "manage_options", // capability
    "btcpay-donors", // menu_slug
    false, // function
    "dashicons-money", // icon_url
    99 // position
  );

  /* Settings page */
  add_submenu_page(
    "btcpay-donors", // parent_slug
    "BTCPay Donors Settings", // page_title
    "Settings", // menu_title
    "manage_options", // capability
    "btcpay-donors", // menu_slug
    "btcpay_donors_create_settings_page" // function
  );

  /* Donors page */
  add_submenu_page(
    "btcpay-donors", // parent_slug
    "BTCPay Donors List", // page_title
    "Donors", // menu_title
    "manage_options", // capability
    "btcpay-donors-list", // menu_slug
    "btcpay_donors_create_donors_page" // function
  );

  /* Help page */
  add_submenu_page(
    "btcpay-donors", // parent_slug
    "BTCPay Donors Help", // page_title
    "Help", // menu_title
    "manage_options", // capability
    "btcpay-donors-help", // menu_slug
    "btcpay_donors_create_help_page" // function
  );
}

function btcpay_donors_create_settings_page()
{
  btcpay_donors_settings_page();
}

function btcpay_donors_create_donors_page()
{
  include plugin_dir_path(__FILE__) . "btcpay-donors-display.php";
}

function btcpay_donors_create_help_page()
{
  include plugin_dir_path(__FILE__) . "btcpay-donors-help.php";
}

function btcpay_donors_pages_init()
{
  btcpay_donors_settings_init();
}

/*
 * Retrieve options with:
 *
 * $btcpay_donors_options = get_option( 'btcpay_donors' ); // Array of all options
 *
 * $btcpay_store_id = $btcpay_donors_options['btcpay_store_id']; // BTCPay Store ID
 * $btcpay_store_url = $btcpay_donors_options['btcpay_store_url']; // BTCPay Store URL
 * $btcpay_store_secret = $btcpay_donors_options['btcpay_store_secret']; // BTCPay Store Secret
 * $btcpay_api_key = $btcpay_donors_options['btcpay_api_key']; // BTCPay API Key
 * $minimum_donation_amount_gold = $btcpay_donors_options['minimum_donation_amount_gold']; // Minimum donation amount for Gold donors
 * $minimum_donation_amount_silver = $btcpay_donors_options['minimum_donation_amount_silver']; // Minimum donation amount for Silver donors
 * $minimum_donation_amount = $btcpay_donors_options['minimum_donation_amount']; // Minimum donation amount for Bronze donors
 * $minimum_donation_amount_currency = $btcpay_donors_options['minimum_donation_amount_currency']; // Minimum donation amount currency
 * $twitter_bearer_token = $btcpay_donors_options['twitter_bearer_token']; // Twitter Bearer Token
 */
