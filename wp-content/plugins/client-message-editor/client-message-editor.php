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


function clientMessage()
{

?>
  <article class='client-message' style='border: 1px solid #000000; border-radius:5px; padding: 1rem; text-align:center;'>
    <h2>Cher client !</h2>
    <p>N'hésitez pas à venir voir nos nouveaux produits en promotion rien que pour vous !</p>
  </article>
<?php
}
add_action('woocommerce_account_dashboard', 'clientMessage');
