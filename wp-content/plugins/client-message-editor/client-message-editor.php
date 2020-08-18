<?php

/**
 * @package Client Message Editor
 */
/*
Plugin Name: Client Message Editor
Plugin URI: https://example.com/
Description: Envoyez des informations à vos clients dans leur espace personnel avec ce plugin.
Version: 1.0.0
Author: Ancelin Quinton
Author URI: https://example.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: client-message-editor
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2020 Automattic, Inc.
*/


//Don't load directly
if (!defined('ABSPATH')) {
  die('Error, Wordpress needs to be initialized first.');
}




class ClientMessageEditor
{
  function __construct()
  {
    add_action('init', array($this, 'custom_post_type'));
    add_action('woocommerce_account_dashboard',  array($this, 'editClientMessage'));
    add_action('woocommerce_account_dashboard',  array($this, 'displayClientMessage'));
  }
  function activate()
  {
    $this->cmeTable_install();
    $this->custom_post_type();
    flush_rewrite_rules();
  }
  function deactivate()
  {
    flush_rewrite_rules();
  }

  function custom_post_type()
  {
    register_post_type(
      'cm_editor',
      array(

        'label' => 'CM-Editor',
        'menu-icon' => 'dashicons-clipboard',
        'public' => true,
        'show_in_rest' => true

      )

    );
  }
  function checkCMETable()
  {
    global $wpdb;
    $table_name = "wp_client_message_editor";
    $check = $wpdb->get_results($wpdb->prepare("SELECT title, text FROM $table_name"));
    if ($check != false) {
      return true;
    } else {
      return false;
    }
  }

  function cmeTable_install()
  {
    if ($this->checkCMETable() === false) {
      global $wpdb;

      $table_name = $wpdb->prefix . "client_message_editor";

      global $wpdb;

      $charset_collate = $wpdb->get_charset_collate();

      $sql = "CREATE TABLE $table_name (
id int(11) NOT NULL AUTO_INCREMENT,
time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
title text NOT NULL,
text text NOT NULL,
PRIMARY KEY  (id)
) $charset_collate;";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      $title = "Cher client !";
      $text = "N'hésitez pas à venir voir nos nouveaux produits en promotion rien que pour vous !";

      $table_name = $wpdb->prefix . 'client_message_editor';

      $wpdb->insert(
        $table_name,
        array(
          'time' => current_time('mysql'),
          'title' => $title,
          'text' => $text,
        )
      );
    } else {
      return false;
    }
  }

  function displayClientMessage()
  {

    global $wpdb;

    $table_name = "wp_client_message_editor";

    $result = $wpdb->get_results("SELECT title, `text` FROM $table_name");

    if ($result != false) { ?>
      <?php
      $title = $result[0]->title;
      $text = $result[0]->text;
      $text = stripslashes($text); ?>

      <article class='client-message' style='border: 1px solid #000000; border-radius:5px; padding: 1rem; text-align:center;'>
        <h2><?php echo $title; ?></h2>

        <p><?php echo $text; ?></p>
      </article>
<?php } else {
      return false;
    }
  }

  function editClientMessage()
  {
    global $wpdb;
    $table_name = "wp_posts";

    $newMessage = $wpdb->get_results("SELECT post_title, post_content FROM $table_name WHERE post_type = 'cm_editor'");

    if ($newMessage != false) {
      $newTitle = $newMessage[0]->post_title;
      $newText = $newMessage[0]->post_content;
      $newText = stripslashes($newText);

      $cmeTable = "wp_client_message_editor";

      $where = ['id' => 1];
      $data = ['title' => $newTitle, 'text' => $newText];

      $wpdb->update($cmeTable, $data, $where);
      $where = ['post_type' => "cm_editor"];
      $wpdb->delete($table_name, $where);
    } else {
      return false;
    }
  }
}


if (class_exists('ClientMessageEditor')) {
  $clientMessageEditor = new ClientMessageEditor();
}

//activation 
register_activation_hook(__FILE__, array($clientMessageEditor, 'activate'));

//deactivation 
register_activation_hook(__FILE__, array($clientMessageEditor, 'deactivate'));
