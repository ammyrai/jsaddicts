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
define('DB_NAME', 'jsedits');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'z=17@*H9X}cYnDDiXXD:LH4J@@KN<,g>c>y.Z=s4<><M9W-uFxt=a`uKdC$AyVTi');
define('SECURE_AUTH_KEY',  'zeZ<D9t$K[Jjrn/va@=P0o&4lp]Z3lJE4X.K+h%Q*KwzvmC9x39XticfLX=gL{dU');
define('LOGGED_IN_KEY',    'y&yaqm^wUYi*za?vCXbIkAXEE4i?LM#Z6cbh>}mq,0>OoM(p1In!l}1:IPSfH2}o');
define('NONCE_KEY',        'QXHCT mU*ZeeOEe+Fo|4esZ-Wb~-XrYQQ*/rm*Gwdr81Tl()!$BXCuZ1!~*D/]s#');
define('AUTH_SALT',        '~.hkWn5<S0B-=;L5fQKkZlS%dW?NaHJ{6K?Lzj@{i%r|d^kxt3V^u;At@uH=dLEN');
define('SECURE_AUTH_SALT', 'b4VuGnj1mmzUR+%WI3TH_MOm3G^dQtBR7pYi6j9iP%erZgRzdz$ h?g[lG+IvbqS');
define('LOGGED_IN_SALT',   '7h3[#r?@O8w_IaBLBg9dgT&&qb+DQsni:jsG+C+X]=+ZX9{jl67Z@CYh,?C4zjFN');
define('NONCE_SALT',       '^tG;f2/~FNnj6i;`j&F7*01|Ckvj4bTUtLWWIyk-giEG6%Oco7Q2TI#}t&(8G.0;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'js_';

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
