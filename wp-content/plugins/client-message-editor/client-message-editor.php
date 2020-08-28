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


/**
 * Client Message Editor Plugin
 */
class ClientMessageEditor
{
  function __construct()
  {
    add_action('init', array($this, 'custom_taxonomies'));
    add_action('init', array($this, 'custom_post_type'));
    add_action('woocommerce_account_dashboard',  array($this, 'displayClientMessage'));
  }
  function activate()
  {
    flush_rewrite_rules();
  }
  function deactivate()
  {
    flush_rewrite_rules();
  }
  function custom_post_type()
  {
    $labels = array(
      'name'                  => "Client Message Editor",
      'singular_name'         => "Client Message",
      'menu_name'             => "Client Message",
      'name_admin_bar'        => 'Client Message',
      'add_new'               => 'Ajouter un Nouveau Message',
      'add_new_item'          => 'Ajouter un Nouveau Message',
      'new_item'              => 'Nouveau Message',
      'edit_item'             => 'Modifier le Message',
      'view_item'             => 'Afficher le Message',
      'all_items'             => 'Tous les Messages',
      'search_items'          => 'Recherche de Messages',
      'parent_item_colon'     => 'Message:',
      'not_found'             => 'Pas de Message Trouvé',
      'not_found_in_trash'    => 'Pas de Message Trouvé dans la Corbeille',
      'featured_image'        => 'Image du Message',
      'set_featured_image'    => 'Ajouter / Remplacer l\'Image',
      'remove_featured_image' => 'Supprimer l\image',
    );

    $args = array(
      'labels'             => $labels,
      'menu_icon'          => 'dashicons-welcome-write-blog',
      'public'             => true,
      'show_in_rest'       => true,
      'publicly_queryable' => false,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'exclude_from_search' => true,
      'supports'           => array('title', 'editor', 'author', 'thumbnail', 'revisions', 'categories')
    );
    register_post_type('client_message', $args);
  }

  function custom_taxonomies()
  {

    $labels = array(
      'name'                  => "Domaines",
      'singular_name'         => "Domaine",
      'menu_name'             => "Domaines",
      'add_new_item'          => 'Ajouter un Nouveau Domaine',
      'new_item'              => 'Nouveau Domaine',
      'new_item_name'         => 'Renommer le Domaine',
      'edit_item'             => 'Modifier le Domaine',
      'edit_item'             => 'Mettre le Domaine à jour',
      'view_item'             => 'Afficher le Domaine',
      'all_items'             => 'Tous les Domaines',
      'search_items'          => 'Recherche de Domaines',
      'parent_item'           => 'Domaine Parent',
      'parent_item_colon'     => 'Domaine Parent :'
    );

    $args = array(
      'labels'             => $labels,
      'show_in_rest'       => true,
      'hierarchical'       => true,
      'show_ui'            => true,
      'show_admin_column'  => true,
      'query_var'          => true,
      'rewrite'            => array('slug' => 'domaine'),
    );
    register_taxonomy('domaine', array('client_message'), $args);
  }

  function displayClientMessage()
  {

    $args = array(
      'type' => 'post',
      'post_type' => 'client_message',
      'tax_query' =>  array(
        array(
          'taxonomy' => 'domaine',
          'terms' => array('Désactivé', 'desactive'),
          'field' => 'slug',
          'operator' => 'NOT IN',
        ),
      )
    );
    $messages = new WP_Query($args);

    if ($messages->have_posts()) { ?>
      <?php
      while ($messages->have_posts()) {
        $messages->the_post();
      ?>

        <article class='client-message' style='border: 1px solid #000000; border-radius:5px; padding: 1rem;
        margin: 1rem; text-align:center;'>
          <small>
            <?php
            $domaines_list = wp_get_post_terms(get_the_ID(), 'domaine');

            foreach ($domaines_list as $domaine) {
              echo $domaine->name . ' ';
            }

            ?>
          </small>
          <h2><?php the_title(); ?></h2>
          <p><?php the_content(); ?></p>
        </article>



<?php }
    } else {
      return false;
    }
    wp_reset_postdata();
  }
}

if (class_exists('ClientMessageEditor')) {
  $clientMessage = new ClientMessageEditor();
}


// Activation
register_activation_hook(__FILE__, array($clientMessage, 'activate'));

// Deactivation 
register_activation_hook(__FILE__, array($clientMessage, 'deactivate'));
