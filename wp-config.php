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
define( 'DB_NAME', 'shopping' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'vEFzZ#Ij$Te(S}$D6,8<^Qahd{%]-;$1Zi4}R aPzQj$^laW1M63ho+%{*bm LbT' );
define( 'SECURE_AUTH_KEY',  ':{f_JDpse>5g6Z#3 !7gQW|/Z]R:uBHT&R8.E$/ MSyyALv0d)e@5k|fX?0&m%G3' );
define( 'LOGGED_IN_KEY',    '8`Gl/tM]1L$Y`_e=+](2FTF9smF[KAcj9p;/k<i`Q(^yU}]^Y>,;N`H?Si4AHk~+' );
define( 'NONCE_KEY',        'dA[ruxa&63>r$%n9n6Ws?C7EjTie/>fn3GyKoNwG-|G9=Bihu]&.<L{:}PZQ@plm' );
define( 'AUTH_SALT',        'g)iV:G?kOU>X}y6EYVM]B6J~Ct$rPFEYQm8$*go/U,bb`5_L#{^}?Rx6v6M=FP`n' );
define( 'SECURE_AUTH_SALT', 'qL<g9,uet9<@R!ZF7tUTWl -C7SuGiU:+?e+jQYQ[*qqwq,6}wFfEcSHQ7GU;cd ' );
define( 'LOGGED_IN_SALT',   'nNb3jd4j5gsbt[[EO{9p_[;zzQ;UggHEow>:l7BG2.)*|Ti/X&]LPmS?2Ymw+Ky3' );
define( 'NONCE_SALT',       'yM*.f-0i:}v.RJMf(xb0h6P!PY{Zm-CTP?3GVA)q+pMtq(RsU@:E2PdR@p{<Gb:_' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sp_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
