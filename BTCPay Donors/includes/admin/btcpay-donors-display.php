<?php
/*
 * form add donor manually
 */
?>
<h1>Donors</h1>

<div>
  <h2 class="h2-donors-admin">Add a donor</h2>
  <form class="" method="post" action="<?php echo esc_url(admin_url("admin-post.php")); ?>" id="add_donor_meta_form">
    <div class="flex">
      <input required type="text" id="name" name="name" placeholder="@decouvrebitcoin">

      <input required type="number" id="amount" name="amount" placeholder="Amount" step="0.00000001" min="0">

      <button type="submit" class="form-button">Add</button>
    </div>

    <input type="hidden" name="action" value="btcpay_donors_add_donor">
    <input type="hidden" name="add_donor_meta_nonce" value="<?php echo wp_create_nonce("add_donor_meta_form_nonce"); ?>" />
  </form>
</div>

<div>
  <h2 class="h2-donors-admin">Donors list</h2>
  <?php echo do_shortcode("[btcpay_donors_shortcode_donors]"); ?>
</div>
<br>

<style>
  .h2-donors-admin{
    text-align: start;
    margin-top: 30px;
  }

  input {
    width: 500px;
    padding: 5px 12px;
    box-sizing: border-box;
    margin-bottom: 10px;
  }

  .form-button {
    right: 65px;
    background-color: #4CAF5030;
    border: 2px solid #4CAF50;
    border-radius: 4px;
    color: black;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    transition-duration: 0.4s;
    cursor: pointer;
  }

  .form-button:hover {
    background-color: #4CAF50;
    color: white;
  }

  .flex {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
</style>