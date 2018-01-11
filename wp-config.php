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
define('DB_NAME', 'radesoldb');

/** MySQL database username */
define('DB_USER', 'radesoldbadmin');

/** MySQL database password */
define('DB_PASSWORD', 'radesoldbolga');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



/** Заборонити REVISIONS */
define('AUTOSAVE_INTERVAL', 17000 ); // seconds
define('WP_POST_REVISIONS', false );

/** Заборонити оновлення */
define( 'AUTOMATIC_UPDATER_DISABLED', true );


/* // Заборонити зміни файлів у адмінці, установку плагінів 
define( 'DISALLOW_FILE_MODS', true );
 */


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_UDniP[c+*b!TL>F4VAC{7@%N($AF?aBYK1n2C&k^x[,FGnB|[Rl-2q=X(}d6[xG');
define('SECURE_AUTH_KEY',  '-|4Da!)51h|paKhmR7M`<Wt$Ozy)+Uu:S ios+#_,:+ysxWpwGla?d4jM?JTHPEs');
define('LOGGED_IN_KEY',    'wlPvI_SF.&].e:$uO[|| 1T_$U<.-RmOz2tP.s5(M3!0INx6?}NU#tP+64oqxi>(');
define('NONCE_KEY',        '6 ?{Ild-u+gSMu+LSw8U2!H80$A3[md$d/IJ+ JfDQKRiv?(,uk9*Gj<*Sv%2{LD');
define('AUTH_SALT',        ':lg.@tul%T)^0YY-ogz *fR0H|70jYX[%,k2ht=9M/h;5!8_,nV<j2IBd>Kf#Tm=');
define('SECURE_AUTH_SALT', 'T/%}DlS?Yi&Ei|01*KfH%i7KE>*^{y>M5>]*RLD}^`?(FMj#*+s$vn-[MFhK8GMO');
define('LOGGED_IN_SALT',   'WV0d/VD_Q`&Yl|1SY+1zC)D<s0-)4!v6| !J*hu!@wns0G%nA#!fLs0UJlT&Lb;X');
define('NONCE_SALT',       ')j$<kK8[ +CF;3!]cwy8+brLKiU([28Tq9%a<.ADy`c>U@uHM <Ledl -,V6z=Q;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rdb_';

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
