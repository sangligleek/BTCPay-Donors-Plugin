# BTCPay Donors - Wordpress plugin

Display your BTCPay Donors directly on your Wordpress website. 
Donors can add their Twitter username to the donation description in order for their profile picture to get fetched and displayed in the donors list.


Use the shortcode [btcpay_donors_shortcode_donors] to display the list.

## Main Features

- **Donor Management:** Easily add, update, and delete donors.
- **Donor Ranking:** Donors are ranked in Gold, Silver, and Bronze categories based on their contributions.
- **Twitter Integration:** Donors' profile images can be automatically fetched from Twitter.
- **Shortcode:** Use the shortcode [btcpay_donors_shortcode_donors] to display
the list of donors on your website.
- **Customizable:** Customize the look and feel of the donors list with CSS.

## Installation

1. Download the plugin from the official WordPress repository or get the plugin zip file.
2. Go to your WordPress dashboard, then to "Plugins" > "Add New" and click on "Upload Plugin".
3. Select the plugin zip file and click "Install Now".
4. After installation, click "Activate Plugin".

## Configuration

### BTCPay Server

#### Get your Store ID

Go to your BTCPay Server Store's settings and copy the `Store ID` to the plugin settings page.

<img src="BTCPay Donors/docs/btcpay-id.png" style="width: 500px;" />

#### Get your API Key

Go to your BTCPay Server Account's settings, and click the `API Keys` tab.

<img src="BTCPay Donors/docs/btcpay-keys.png" style="width: 500px;" />

Generate a new key and click `Select specific stores` for `View invoices`. Select your store, then generate the key with the submit button.

<img src="BTCPay Donors/docs/btcpay-add-key.png" style="width: 500px;" />

Copy the generated key to `API Key` in the plugin settings page.

#### Setup the webhook

Go to your BTCPay Server Store's settings, and click the `Webhooks` tab.

<img src="BTCPay Donors/docs/btcpay-webhooks.png" style="width: 500px;" />

Create a new webhook with URL `https://your-website.org/wp-json/btcpay-donors/v1/callback`, triggered by the specific event `an invoice has been settled`. Copy the secret to `Store Secret` in the plugin settings page.

<img src="BTCPay Donors/docs/btcpay-add-webhook.png" style="width: 500px;" />

### Minimum Donation Amount and Currency

To configure the minimum donation amount per category and currency, follow these steps:

1. Enter the minimum donation amount for each category (Gold, Silver, Bronze) in the provided fields.
2. Select the desired currency for each category from the corresponding dropdown lists.

## Usage

### Adding a Donor

To add a donor, follow these steps:

1. Go to the "Donors" section of your dashboard.
2. Click on "Add a Donor".
3. Fill out the form with the donor's name and donation amount.
4. Click "Add".

**Note:** If a donor already exists, the amount will be updated.

### Updating a Donor

To update an existing donor, follow the same steps as adding a donor. If the donor's name already exists, the amount will be updated.

### Deleting a Donor

To delete a donor, go to the "Donors" section of your dashboard, find the donor you want to delete, and click the "Delete" button next to their name.

## Displaying Donors

Use the shortcode `[btcpay_donors_shortcode_donors]` to display the list of donors on any page or post on your site.

## Frequently Asked Questions (FAQ)

### How can I fetch a donor's profile image from Twitter?

When you add a donor with their Twitter handle (e.g., @username), the plugin will automatically attempt to fetch the profile image from Twitter. If it fails, a default image will be used. Ensure you have configured the Twitter access token in the plugin options.

### How can I customize the plugin's styles?

You can add your own custom CSS in the plugin settings section. This allows you to modify the appearance of the donor cards and other elements of the plugin.

## Support

If you need further assistance, feel free to contact:

- **Email:** sangligleek@gmail.com

## Compatibility

Tested with:

- BTCPay Server v1.13.1
- WordPress Version 6.5.3

## Screenshots

<img src="docs/settings.png" />
<img src="docs/admin-donors.png" />
<img src="docs/donors.png" />
