<?php

/**
 * Template Name : Ananas
 *
 * @version 1.0.0
 */


if (get_current_user_id() == 0) {
  wp_redirect("/mon-compte");
}

get_header(); ?>

<h2>Aimez-vous l'ananas ?</h2>

<form method="post" class="woocommerce-form">

  <label>Oui / Non<span class="required">*</span></label>
  <p><input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="ananas_radio" value="yes">
    <label for="yes">Oui</label>
    <input type="radio" class="woocommerce-Input woocommerce-Input--radio input-radio" name="ananas_radio" value="no">
    <label for="no">Non</label>
  </p>

  <p><label for="ananas_textarea">Pourquoi aimez-vous ou non l'ananas ? <span class="required">*</span></label></p>
  <p>
    <textarea type="textarea" class="woocommerce-Input woocommerce-Input--textarea input-textarea" name="ananas_text" id="ananas_text"></textarea>
  </p>
  <p class="woocommerce-form-row form-row">
    <button type="submit" class="woocommerce-Button woocommerce-button" name="submitBtn" value="<?php esc_attr_e('Submit', 'woocommerce'); ?>"><?php esc_html_e('Submit', 'woocommerce'); ?></button>
  </p>

</form>

<?php

do_action('ananasForm');
get_footer();
