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
define('DB_NAME', 'yi_store');

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
define('AUTH_KEY',         '+^qvVJB?qk23ADPl&2g%`!UEQM&;AGnJ5jziS(F1t6sBqI]X*fD_.{grZ Zo4`*S');
define('SECURE_AUTH_KEY',  'd`:<Rq2ZYcI!8oIr95-tF|DW+]~?B}r)a![cUaHN:79,!:PABkJ ?[a?0&|a[b5%');
define('LOGGED_IN_KEY',    'y)Hvf1We;A$JsmNyA!._@Rt/1JSXc~Yl8?5~Cc2T^_0_0s};e:^F{+$9-T.Q9:A)');
define('NONCE_KEY',        'BF;Uu!E$ 5|pIn?M{/<#JkVP Q0H-cJv<Ax{x`nl;7x&9ikH;5URb#pW`sh!7rp&');
define('AUTH_SALT',        '(!,iAHb~z$}ju.0)H4.dgbSl:R&=ys-}@r52U-6Ft:Lk5YZv rHlDVFAI2{IXDlN');
define('SECURE_AUTH_SALT', 'bLaWH)Tc.03o5|FT`a,|WqaDt,+(VnRlo .?S)vc)1m]g/>Kti(kjlqP30Jaowz#');
define('LOGGED_IN_SALT',   ':E4cmTW3e`9# Y=!SI,1MRU^Ofg?hWtMbC4PPim#S?rok/NsYT(Viy$77(*<1<^U');
define('NONCE_SALT',       '0_!1yzN1Jmh|bK^Bw2kzf}pN5QN@8-9_9XWThA_d/.$R10z>gmC{j2UnTMX0.~[(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpft_';

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
