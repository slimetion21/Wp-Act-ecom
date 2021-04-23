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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpresscoffin' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'K^N`pLxyH2h4Fk<-429cDm0jM5GW;q.(g*310Rw=WF.!<0)9!>62L+JHx]4;k-Ah' );
define( 'SECURE_AUTH_KEY',  'j)gt|1cDpS|1r)ni90#t=L;Cj9;h3K%0M:z`Z|+FTEGW/^|tFVLvb7FDPkjaLr;0' );
define( 'LOGGED_IN_KEY',    '20`9qgMH3#vmGWyb9Ma.,0-I(grE7^j@q.2u] ygN~}TO)lMQ8LywNIq>-NIqpzp' );
define( 'NONCE_KEY',        '*:<P]2,gl=Y/D]!Ow{n!Zq^I7hvy}}@~]5K[&ug(-zpEc1RKoua`nAITUa]@5_1+' );
define( 'AUTH_SALT',        '<C,4s[R]*[i5BbUR`uxj5<q6nl!mOD0u=2(t&M;9 d>Q%xmO:GHy1aIl|3YiT>N:' );
define( 'SECURE_AUTH_SALT', '??5lzx,5jDge *8v$_`wv0`]*y?Tjd9}sxQ[#3.}O|_NeG{{PoS:Vjue{9b>N](7' );
define( 'LOGGED_IN_SALT',   'Ws6?OR:qy22XD%AVwjUnSv+.yQ+[2JPeD@%@@JmaTrpe>iud}QcL}BIulS$e5RJ#' );
define( 'NONCE_SALT',       '8#)G3@xF=O Z:9tz#,~!>+A5F|zPz%P?^IV?L7-rfK:*J6;w;h]MLGF/qA)k$B=r' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
