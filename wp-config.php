<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dulich-ks' );

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
define( 'AUTH_KEY',         'D50}w%ljgp,K2*}}lnQuaSIILc-# TA[xh6g000 *o$.WunO.)EUSDW$/m=}eZ,.' );
define( 'SECURE_AUTH_KEY',  'bF?nvHSZ}-D5Q!,d2F rV_Z^o9}Q5J+o)?NkeX:;>9olbFfK]GB87{3r-tzJr&D>' );
define( 'LOGGED_IN_KEY',    'jwS~ -yd(0Dh006g>B_G{X=$Lr$#Iz@g,=(Lf/]UewYb+E@a~vC?;GdahExB=jDQ' );
define( 'NONCE_KEY',        'mI)LQl/fCd%jw=91a<mQ2nKHXWp~FJ[JytZ5qf,XHp%CR044{/l~[lQm^<$nE>ZG' );
define( 'AUTH_SALT',        'LV]QHvI<mQ]88A*!*@X]%Mfg{rs8!0dc6qip1RrJ}2~*KJx=^+c}a+k.ORcj-OI:' );
define( 'SECURE_AUTH_SALT', '-IGpY=iJ%HKTbWO/J7MHnvU,`WKtOFtfv}N!J5b-WWJ9oiPVk`zQ4@Fe}6[=o;]5' );
define( 'LOGGED_IN_SALT',   '/d}KV&H9n6@M_uik,GlbDpaY&XeeN0F)p($(8wOh[#fO|.}L!N>%PlIw*9$<94iL' );
define( 'NONCE_SALT',       't9n2&ewV-Br.rmKK% %AC`IkK8SG0GeVFxqF($;;zgXa8!//CS2g9ZchE1vaH,_;' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
