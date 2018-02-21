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
define('DB_NAME', 'mossmoss');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '$uVIHVQK~Ku}A2z%&IZ<tO=PA5jFQCPX%x:pquMt|epB %rsIQUhtc*qXEJHvW*P');
define('SECURE_AUTH_KEY',  '>K@$_-RZ<}S)2cm&7jmE}.7e|1,xa]|Lg1y1MoiWJ s|g7_w!cr>rD|{h>W!,@28');
define('LOGGED_IN_KEY',    'BijX_sIQRrikF{d-r3*yq7NO~$P*S/7MF^R6Lh>s}>}?l,=cM347;x_S%k1J)Q~u');
define('NONCE_KEY',        'GSz9Dd9sQd.~6qJ=EP|n{efgV&Hb|?!%.On^El9NwTUUPqSj+Xjtst~aa69OzgO:');
define('AUTH_SALT',        'e=qTVqIFV4O_-l8zvQF$P|WJRG{Q5PaNd7KQrk5VrA)ZinRVUGq{0gAZ%:xt7$IE');
define('SECURE_AUTH_SALT', '<6{|Tgk<LC93gMc_KpO4#v&Jm3[m2Q<vbEWx~qdl.jluH*|,YDSF<$Cx1|wn8FkP');
define('LOGGED_IN_SALT',   'jD~lY2>|hd@FeV&YzT~`>41fB]qtz`#.|Nw]tZucJ?ou[Ij^T]GjOjLEt}71p[77');
define('NONCE_SALT',       'a? v]Tb#q1DuHqxgK$f(M~Rqk5Pi/ap(bk^6b<:~FOe=x=L~Sp~y&dV@c5-FaOxV');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
