<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'activite_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pass');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}i0 RreQM~&`L}(uv7}N-^&Eh7p @! RE$Jd(OX<jCV$IB?tcPSC1UHB0<EOizM=');
define('SECURE_AUTH_KEY',  '98hmh2QeX~LNN5kis7-^6%M(-e(LjAaK2>Kz4/rPL3KwKeb[kcMzhYuHe@3}^;%6');
define('LOGGED_IN_KEY',    'LJOv=mHiylwJ>lrJI rsqw3{V,)5l>CG^mT1v82l6gNQ/ytbH2vJaW[DEMWncz3y');
define('NONCE_KEY',        'q /$V6@)_~JT;KB2U<3nDaj9o8s#Gx+,kkEnk_:5uDv ^]1 DL|(Sc<cBbWH|z[,');
define('AUTH_SALT',        'eX/7eL^tcLrSK[zGjLdQeV1%.Gf|y5{,;hwHj3Pt45N#3iWi<`NrOM))p]mm-My!');
define('SECURE_AUTH_SALT', '62aI!h!a9b#cn*#sw<g)JwhGmqCtjks]Xs+@F2|Fu305vxiCP `l>U!@(<e)mv`$');
define('LOGGED_IN_SALT',   '7TBM|oKv/:-7;d>oL{]{q!~=whTC`aYA`*-f<S24b5/|h`_9)D)]?3Sh:%L!=Y$S');
define('NONCE_SALT',       'kPj~KA!oVrL)%t78`b8P%UwV;rZP`LIk]sALRGX{KxKvv&W4}2-.qsr^9?gWv#U/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 't_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
