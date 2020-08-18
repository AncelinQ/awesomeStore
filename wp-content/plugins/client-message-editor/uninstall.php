<?php

/** 
 *Trigger this file on Plugin uninstall
 * @package Client Message Editor
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

//clear database 

$postClientMessages = get_posts(array('post_type' => 'cm_editor', 'numberposts' => -1));

if ($postClientMessages != false) {
  foreach ($postClientMessages as $clientMessage) {

    wp_delete_post($clientMessage->ID, true);
  }
}

global $wpdb;

$wpdb->query("DROP TABLE wp_client_message_editor");
