<?php
$donors = btcpay_donors_get_donors();

function btcpay_donors_get_donor_image($donor_name)
{
    $btcpay_donors_options = get_option("btcpay_donors");
    $plugin_url = plugin_dir_url( dirname( __FILE__ ) ) . 'images/';
    $default_images = [
        $plugin_url . 'Asset-51.svg',
        $plugin_url . 'Asset-52.svg',
        $plugin_url . 'Asset-53.svg',
        $plugin_url . 'Asset-65.svg',
    ];
    $profile_image_url = $default_images[array_rand($default_images)];
    if (preg_match("/^@.*/", $donor_name)) {
        $twitter_username = str_replace("@", "", $donor_name);
        if (
            isset($btcpay_donors_options["twitter_bearer_token"]) &&
            $btcpay_donors_options["twitter_bearer_token"] != ""
        ) {
            $url = "https://api.twitter.com/1.1/users/show.json?screen_name=" . $twitter_username;
            $args = [
                "headers" => [
                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer " . $btcpay_donors_options["twitter_bearer_token"],
                ],
            ];

            $response = wp_remote_get($url, $args);
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $user = json_decode($body);
                if ($user && isset($user->profile_image_url)) {
                    $profile_image_url = preg_replace('/^(.*)_normal\.(.*)$/', '${1}.${2}', $user->profile_image_url);
                }
            }
        }

        // Use unavatar.io if the Twitter API fails or is not configured
        if (in_array($profile_image_url, $default_images)) {
            $profile_image_url = "https://unavatar.io/twitter/" . $twitter_username;
        }
    }

    return $profile_image_url;
}


function btcpay_donors_get_donor_classification($donor_amount, $gold_limit, $silver_limit, $bronze_limit)
{
    $btcpay_donors_options = get_option("btcpay_donors");
    $gold_limit = $btcpay_donors_options["minimum_donation_amount_gold"];
    $silver_limit = $btcpay_donors_options["minimum_donation_amount_silver"];
    $bronze_limit = $btcpay_donors_options["minimum_donation_amount"];

    if ($donor_amount >= $gold_limit) {
        return "Gold";
    } elseif ($donor_amount >= $silver_limit) {
        return "Silver";
    } elseif ($donor_amount >= $bronze_limit) {
        return "Bronze";
    }
    return "";
}

?>
<div class="donors-container">
    <h2>Gold Donors</h2>
    <div class="gold-donors">
        <?php foreach ($donors as $donor) : ?>
            <?php $donor_amount = $donor->amount; ?>
            <?php $donor_classification = btcpay_donors_get_donor_classification($donor_amount, $gold_limit, $silver_limit, $bronze_limit); ?>
            <?php if ($donor_classification === 'Gold') : ?>
                <div class="donor-card">
                    <?php if (preg_match("/^@.*/", $donor->name)) : ?>
                        <a href="https://twitter.com/<?php echo str_replace("@", "", $donor->name); ?>" target="_blank">
                            <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                        </a>
                    <?php else : ?>
                        <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                    <?php endif; ?>
                    <span class="donor-name"><?php echo $donor->name; ?></span>
                    <?php if (is_admin()) : ?>
                        <form method="POST" action="<?php echo esc_url(admin_url("admin-post.php")); ?>">
                            <input type="hidden" name="id" value="<?php echo $donor->id; ?>">
                            <input type="hidden" name="action" value="btcpay_donors_delete_donor">
                            <input type="hidden" name="delete_donor_meta_nonce" value="<?php echo wp_create_nonce("delete_donor_meta_form_nonce"); ?>" />
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>

                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h2>Silver Donors</h2>
    <div class="silver-donors">
        <?php foreach ($donors as $donor) : ?>
            <?php $donor_amount = $donor->amount; ?>
            <?php $donor_classification = btcpay_donors_get_donor_classification($donor_amount, $gold_limit, $silver_limit, $bronze_limit); ?>
            <?php if ($donor_classification === 'Silver') : ?>
                <div class="donor-card">
                    <?php if (preg_match("/^@.*/", $donor->name)) : ?>
                        <a href="https://twitter.com/<?php echo str_replace("@", "", $donor->name); ?>" target="_blank">
                            <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                        </a>
                    <?php else : ?>
                        <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                    <?php endif; ?>
                    <span class="donor-name"><?php echo $donor->name; ?></span>

                    <?php if (is_admin()) : ?>
                        <form method="POST" action="<?php echo esc_url(admin_url("admin-post.php")); ?>">
                            <input type="hidden" name="id" value="<?php echo $donor->id; ?>">
                            <input type="hidden" name="action" value="btcpay_donors_delete_donor">
                            <input type="hidden" name="delete_donor_meta_nonce" value="<?php echo wp_create_nonce("delete_donor_meta_form_nonce"); ?>" />
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <h2>Bronze Donors</h2>
    <div class="bronze-donors">
        <?php foreach ($donors as $donor) : ?>
            <?php $donor_amount = $donor->amount; ?>
            <?php $donor_classification = btcpay_donors_get_donor_classification($donor_amount, $gold_limit, $silver_limit, $bronze_limit); ?>
            <?php if ($donor_classification === 'Bronze') : ?>
                <div class="donor-card">
                    <?php if (preg_match("/^@.*/", $donor->name)) : ?>
                        <a href="https://twitter.com/<?php echo str_replace("@", "", $donor->name); ?>" target="_blank">
                            <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                        </a>
                    <?php else : ?>
                        <img class="donor-img" src="<?php echo btcpay_donors_get_donor_image($donor->name); ?>" alt="<?php echo $donor->name; ?>'s picture">
                    <?php endif; ?>
                    <span class="donor-name"><?php echo $donor->name; ?></span>

                    <?php if (is_admin()) : ?>
                        <form method="POST" action="<?php echo esc_url(admin_url("admin-post.php")); ?>">
                            <input type="hidden" name="id" value="<?php echo $donor->id; ?>">
                            <input type="hidden" name="action" value="btcpay_donors_delete_donor">
                            <input type="hidden" name="delete_donor_meta_nonce" value="<?php echo wp_create_nonce("delete_donor_meta_form_nonce"); ?>" />
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif; ?>

                </div>
            <?php endif; ?>


        <?php endforeach; ?>
    </div>

</div>

<style>
    .donors-container {
        gap: 12px;
    }

    h2 {
        text-align: center;
    }

    .gold-donors,
    .silver-donors,
    .bronze-donors {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .donor-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
        margin: 30px;
    }

    .donor-img {
        border-radius: 50%;
        display: block;
        width: 120px;
        height: 120px;
    }

    <?php
    $btcpay_donors_options = get_option("btcpay_donors");
    if (!is_admin() && isset($btcpay_donors_options["custom_css"]) && $btcpay_donors_options["custom_css"] != "") {
        echo $btcpay_donors_options["custom_css"];
    }
    ?>
</style>