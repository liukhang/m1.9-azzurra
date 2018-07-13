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
define('DB_NAME', 'm1_m19_azzurra_live');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         ')uY^e^7@l@/@3!fipmlz+Z$Ni*{T^W3h_?RbMcZ gBDpJ|365I!p#I#T{njyN-va');
define('SECURE_AUTH_KEY',  'TOTu0qhh[BEqg)FH*[D#U%Y~.=Ia:!3N>GmV93|kriduQ<*NJt.?9:5*ool^(gq}');
define('LOGGED_IN_KEY',    'b.MB~u#:R=k,u?A|j1f|>Naw$6,$O|+1!P}^+_JT3dH?a;;6_gzt{Rk=hkv`BT^T');
define('NONCE_KEY',        '}5f|l@F6n2&tx~Zpo7x36NunL@5@hUBF~Tij[[}AVDhOf|_!}G@m6[2<3sH9xgvr');
define('AUTH_SALT',        '(n?IH:@u$<*y|%:m!.VDck29F,FChFJORa+|n^pV,h&BB qF%&{eYStj<!x5|Q~J');
define('SECURE_AUTH_SALT', '@4NmyFW*m=HNmHAM{B=lJ3QNw=WN_fh#/[hLzeUBXdQso;4HMz+c{x4iA_FMtQ;!');
define('LOGGED_IN_SALT',   '?c`8QKIlbzO8Hot!1K3gujZ{yGFU-U8DL0ejl!/2!jx dHR9n9! QyL4vhveg7;m');
define('NONCE_SALT',       'A4?#-fzkW}{zVogLWe8LKVF$P3Q7, EKj~a)ysud0go$k`=+QvlFc=Lp/]L!=Q|+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
