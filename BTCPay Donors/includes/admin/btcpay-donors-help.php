<?php
/*
Plugin Name: BTCPay Donors
Description: This file provides help documentation for the BTCPay Donors plugin.
*/
?>

<h1>BTCPay Donors Plugin Help</h1>

<div class="section">
    <h2>Introduction</h2>
    <p>Welcome to the BTCPay Donors plugin. Display your BTCPay Donors directly on your Wordpress website.
        <br>Donors can add their Twitter username to the donation description in order for their profile picture to get fetched and displayed in the donors list.
        <br>It is designed to provide a seamless integration between your website and BTCPay Server, enabling you to showcase your donors and their contributions.
        <br>You can add, update, and delete donors, as well as rank them based on their donation amounts.
    </p>
</div>

<div class="section">
    <h2>Main Features</h2>
    <ul>
        <li><strong>Donor Management:</strong> Easily add, update, and delete donors.</li>
        <li><strong>Donor Ranking:</strong> Donors are ranked in Gold, Silver, and Bronze categories based on their contributions.</li>
        <li><strong>Twitter Integration:</strong> Donors' profile images can be automatically fetched from Twitter.</li>
        <li><strong>Shortcode Support:</strong> Display the list of donors on any page or post with a shortcode.</li>
        <li><strong>Custom Styling:</strong> Customize the appearance of the donor cards with your own CSS.</li>
    </ul>
</div>

<div class="section">
    <h2>Installation</h2>
    <ol>
        <li>Download the plugin from the official WordPress repository or get the plugin zip file.</li>
        <li>Go to your WordPress dashboard, then to "Plugins" > "Add New" and click on "Upload Plugin".</li>
        <li>Select the plugin zip file and click "Install Now".</li>
        <li>After installation, click "Activate Plugin".</li>
    </ol>
</div>

<div class="section">
    <h2>Configuration</h2>

    <h3>BTCPay Server</h3>

    <h4>Get Your Store ID</h4>
    <p>Go to your BTCPay Server Store's settings and copy the `Store ID` to the plugin settings page.</p>
    <img src="<?php echo plugins_url('../../docs/btcpay-id.png', __FILE__); ?>" style="width: 500px;" />

    <h4>Get Your API Key</h4>
    <p>Go to your BTCPay Server Account's settings, and click the `API Keys` tab.</p>
    <img src="<?php echo plugins_url('../../docs/btcpay-keys.png', __FILE__); ?>" style="width: 500px;" />

    <p>Generate a new key and click `Select specific stores` for `View invoices`. Select your store, then generate the key with the submit button.</p>
    <img src="<?php echo plugins_url('../../docs/btcpay-add-key.png', __FILE__); ?>" style="width: 500px;" />

    <p>Copy the generated key to `API Key` in the plugin settings page.</p>

    <h4>Setup the Webhook</h4>
    <p>Go to your BTCPay Server Store's settings, and click the `Webhooks` tab.</p>
    <img src="<?php echo plugins_url('../../docs/btcpay-webhooks.png', __FILE__); ?>" style="width: 500px;" />

    <p>Create a new webhook with URL `https://your-website.org/wp-json/btcpay-donors/v1/callback`, triggered by the specific event `an invoice has been settled`. Copy the secret to `Store Secret` in the plugin settings page.</p>
    <img src="<?php echo plugins_url('../../docs/btcpay-add-webhook.png', __FILE__); ?>" style="width: 500px;" />

    <h3>Minimum Donation Amount and Currency</h3>
    <p>To configure the minimum donation amount per category and currency, follow these steps:</p>
    <ol>
        <li>Enter the minimum donation amount for each category (Gold, Silver, Bronze) in the provided fields.</li>
        <li>Select the desired currency for each category from the corresponding dropdown lists.</li>
    </ol>
</div>

<div class="section">
    <h2>Usage</h2>

    <h3>Adding a Donor</h3>
    <p>To add a donor, follow these steps:</p>
    <ol>
        <li>Go to the "Donors" section of your dashboard.</li>
        <li>Click on "Add a Donor".</li>
        <li>Fill out the form with the donor's name and donation amount.</li>
        <li>Click "Add".</li>
    </ol>
    <p><strong>Note:</strong> If a donor already exists, the amount will be updated.</p>

    <h3>Updating a Donor</h3>
    <p>To update an existing donor, follow the same steps as adding a donor. If the donor's name already exists, the amount will be updated.</p>

    <h3>Deleting a Donor</h3>
    <p>To delete a donor, go to the "Donors" section of your dashboard, find the donor you want to delete, and click the "Delete" button next to their name.</p>
</div>

<div class="section">
    <h2>Displaying Donors</h2>
    <p>Use the shortcode <code>[btcpay_donors_shortcode_donors]</code> to display the list of donors on any page or post on your site.</p>
</div>

<div class="section">
    <h2>Frequently Asked Questions (FAQ)</h2>

    <h3>How can I fetch a donor's profile image from Twitter?</h3>
    <p>When you add a donor with their Twitter handle (e.g., @username), the plugin will automatically attempt to fetch the profile image from Twitter. If it fails, a default image will be used. Ensure you have configured the Twitter access token in the plugin options.</p>

    <h3>How can I customize the plugin's styles?</h3>
    <p>You can add your own custom CSS in the plugin settings section. This allows you to modify the appearance of the donor cards and other elements of the plugin.</p>
</div>

<div class="section">
    <h2>Support</h2>
    <p>If you need further assistance, feel free to contact:</p>
    <ul>
        <li><strong>Email:</strong> sangligleek@gmail.com</li>
    </ul>
</div>

<div class="section">
    <h2>Compatibility</h2>
    <p>Tested with:</p>
    <ul>
        <li>BTCPay Server v1.13.1</li>
        <li>WordPress Version 6.5.3</li>
    </ul>
</div>

<div class="section">
    <h2>Documentation</h2>
    <p>For more details, visit the documentation on <a href="https://github.com/sangligleek/BTCPay-Donors-Plugin">GitHub</a>.</p>
</div>

<style>
    h1,
    h2 {
        color: #333;
    }

    h3 {
        color: #333333db;
        font-size: 1em;
    }

    ul,
    ol {
        margin-left: 20px;
    }

    img {
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 10px 0;
    }

    code {
        background-color: #f9f2f4;
        padding: 2px 4px;
        border-radius: 4px;
    }

    .section {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 30px;
        margin-bottom: 20px;
        margin-top: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 6%);
        max-width: 65%;
    }
</style>
