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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-slider' );

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
define( 'AUTH_KEY',         'n/4^YME[f@:d0CcV@?I^=aKq,BztgE_Ca.P`8.2J>d=l7^nbsY>AAi<9}q`3x1Di' );
define( 'SECURE_AUTH_KEY',  '!oGza=u^$XTKB00q3Z8R8*2n./~.b?Tk*`4znG stuc?hE%xS9xe|Mq{[5o6TP>4' );
define( 'LOGGED_IN_KEY',    'o5k#|v@G{Eba?>&_TIblcCuf&JBK+JS[XIqj.yi;~#!e*nH;kWkHjIHGwCDQR-b(' );
define( 'NONCE_KEY',        'D7YLTXBU~4`3NHJ(*^%0EpYwMP8ymgaO(}/U8 ?P-%?hW@#y)*tU@^tsbVchuQP|' );
define( 'AUTH_SALT',        '>ez4b2r|y%T13?q^Tmguxr*sJ$Y(U3yRC-Ld@f(-kEn08:Psp7&zccjjr5/N[%:L' );
define( 'SECURE_AUTH_SALT', ') *pDSs/l]wZk_n}>tdGK(#Gl_WR5VI#b2N@>d{uG/nWs(lsa1{zd2cxJ-Y@-?*A' );
define( 'LOGGED_IN_SALT',   '*(%dJMfx5 !tgG1)FQ:8XNuVz/}]8^VFmhQiecj( <BmUsF5fqF}+l6VM6M,lu&O' );
define( 'NONCE_SALT',       'v9W,NUTH[7Ygq~zz;>7zry0F,19GIvADYzA~i!$lpb &w:-RKt{2Y0^}<_ksz<TO' );

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
