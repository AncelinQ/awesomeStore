<?php

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'awesome_store');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'a<q:i<aBa<UtjpH-:stm{9yu8(N<SYb0C5ie2.]f?3Mr}tKXh`iKu:]t!upH6dK&');
define('SECURE_AUTH_KEY',  '-fe6Oy/LQwr!Zn>8A@aFdsLGv-X/y#N3. }4>&h&<q>T/wIeY.jR^+rq.:&`EMm8');
define('LOGGED_IN_KEY',    '1IuF.gjFUIn$E4BuIgT8)|^A8Jb6(Ap3{iA!,Rb^#|@oZ2/fC8^Cq~5Nz=UjD!%I');
define('NONCE_KEY',        'ri^1vjE=ZwRU.u1;Tr]5d]]!Y`:TnCn#T!x(/Dbt7Dlbr?.I@r3Qxa]S;P99H!~-');
define('AUTH_SALT',        ':$1I%Vd,l&p$a{yg`po8T9B*Q~))@oe!0$zc}G;tT|~P>&lAv0v{l~:GP7O7MD!$');
define('SECURE_AUTH_SALT', '=`QBc}xl1B=&Ld^X7U>fr-Jl^X>jU=`ofG]m-7Y%$82OW<Y#C`kZUdzb?=00u;(o');
define('LOGGED_IN_SALT',   'mwRS9G@V2:Vn:}ei2~z8?NKN1`erBIkqsbG263t)|d>2,u^J1lzv5 Q&$ jT,YC/');
define('NONCE_SALT',       'm{h.]g0S9R6$;_^fuT0K?}_2>0`F#t|6nMj,@lm8rg#DYeuPQv;:+]CqiVT$I:[$');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
