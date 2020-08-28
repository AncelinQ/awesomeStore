<?php

/** 
 *Trigger this file on Plugin uninstall
 * @package Client Message Editor
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

//clear database 

$clientMessages = get_posts(array('post_type' => 'client_message', 'numberposts' => -1));

if ($clientMessages != false) {
  foreach ($clientMessages as $clientMessage) {

    wp_delete_post($clientMessage->ID, true);
  }
}
