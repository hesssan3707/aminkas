<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'aminkas' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3nS6/<1s6MOyYsW*tnrt@dnjWS0bb3f=bCcwxm`{vM?Cl[*OR-~?0?!AbIH)N<z+' );
define( 'SECURE_AUTH_KEY',  'O8=**C9AO+i@z9+>Kh3@@lq*7Jg}_9_akEWU3=#:kmzx0{[Vq{TGg%^z;EnAf#r~' );
define( 'LOGGED_IN_KEY',    'TZAf, U4?2)ZQfCo}Q/b l1RG2.k%`l2M}?)Tc},7GyBI}4pG{D0%qkjA8#n9dl)' );
define( 'NONCE_KEY',        'tqFB7nBB:[ 2*QZq.cHX P(ov)FydPsh}hyIS@}nmG<*6P09!n5%D#nt:+iU7Z}?' );
define( 'AUTH_SALT',        '`(wGYxa3;2k$Wv6SEop{4yp+62oz8/CU2J}hS(Ew3dCV g c-/EPTwz^@7v@}<~%' );
define( 'SECURE_AUTH_SALT', '^AQ*+e~,F7?c I}1SJIX^c$KMpL`cGz:M:dM!,h)QS(cUl60XK9fs9j8!b.Qth*4' );
define( 'LOGGED_IN_SALT',   'slFXOD~Bio~_{AFSX=!aEfBa*P!_h N>2ZThVI.GW$ty*TjJv-JKML?;~0Eq0epM' );
define( 'NONCE_SALT',       'GAs&~{IfCwolq&.ZG6omTg73Q<UyeFZ</H#`3ZE.}vqeP^h|9]XvCGEy5091{Zci' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
