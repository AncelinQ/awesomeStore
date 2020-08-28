<?php

/**
 * Include Style and Script files
 *
 * @return void
 */
function storefrontChildStyles()
{

  $parent_style = 'storefront-style';


  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  wp_enqueue_style(
    'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version'),
    'all'
  );
}
add_action('wp_enqueue_scripts', 'storefrontChildStyles');

/**
 * Check if User Data Exists in wp_ananas table
 *
 * @param [type] $userId
 * @return void
 */
function checkTable($userId)
{
  global $wpdb;
  $table_name = "wp_ananas";
  $check = $wpdb->get_results($wpdb->prepare("SELECT ananas_lover, ananas_text FROM $table_name WHERE user_id = %d", $userId));
  if ($check != false) {
    return true;
  } else {
    return false;
  }
}

/**
 * Send form info to the DB
 * 
 * @return void
 */
function sendAnanasForm()
{

  global $wpdb;

  $userId = get_current_user_id();
  $table_name = "wp_ananas";

  if (isset($_POST['submitBtn'])) {

    if (!isset($_POST['ananas_radio']) || !isset($_POST['ananas_text'])) { ?>
      <div>
        <p>Veuillez remplir tous les champs svp !</p>
      </div>
    <?php } else {

      $check = checkTable($userId);
      $radio = htmlspecialchars($_POST['ananas_radio']);
      $text = htmlspecialchars($_POST['ananas_text']);
      $data = ['ananas_lover' => $radio, 'ananas_text' => $text];

      if ($check === true) {
        $where = ['user_id' => $userId];
        $wpdb->update($table_name, $data, $where);
      } else {
        $data = ['user_id' => $userId, 'ananas_lover' => $radio, 'ananas_text' => $text];
        $wpdb->insert($table_name, $data);
      }
    }
  }
}

/**
 * Display the Client's form answers in his Dashboard
 *
 * @return void
 */
function displayAnanasForm()
{

  global $wpdb;

  $userId = get_current_user_id();
  $table_name = "wp_ananas";
  $check = checkTable($userId);


  if ($check === true) {
    $result = $wpdb->get_results($wpdb->prepare("SELECT ananas_lover, ananas_text FROM $table_name WHERE user_id = %d", $userId));

    if ($result != false) : ?>
      <div>
        <h3>Aimez vous l'ananas ?</h3>
        <?php
        $ananas_lover = htmlspecialchars($result[0]->ananas_lover);
        $ananas_text = htmlspecialchars($result[0]->ananas_text);
        $ananas_text = stripslashes($ananas_text);

        if ($ananas_lover === "yes") : ?>

          <p>Oui, vous aimez les ananas.</p>

        <?php elseif ($ananas_lover === "no") : ?>

          <p>Non, vous n'aimez pas les ananas.</p>

        <?php endif; ?>

        <p><?php echo $ananas_text; ?></p>
      </div>
  <?php endif;
  } else {
    return false;
  }
}

add_action('ananasForm', 'sendAnanasForm');
add_action('woocommerce_account_dashboard', 'displayAnanasForm');


function ipAddress_scripts()
{
  wp_enqueue_script('ip_address', get_stylesheet_directory_uri() . '/js/ip_address.js');
  ?>
  <button type='button' id='ipBtn'>Voir l'addresse IP</button>
  <p id='ipAddressDisplay'></p>
<?php
}

add_action('woocommerce_after_single_product_summary', 'ipAddress_scripts');
