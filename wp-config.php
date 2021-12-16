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
define( 'DB_NAME', 'lifecare' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '}o>N75YfNeiE*NLCA=Jjmv&$&*7d5OA+r|^|h<n>AT;)<;{oKk M-sl_vs OqQ8-');
define('SECURE_AUTH_KEY',  ';sTEK( UItg[_4FUh0):-?RU]iYf4ghr~]~%~-(0N_TU|MKYB-mBdM(l=2jZwOhc');
define('LOGGED_IN_KEY',    't^i#+VP3+Sl9 |_npp@??yiz5_v03y&eo^GWLxOiBBTg[eKeev(Euki73_Py~iZu');
define('NONCE_KEY',        '<?4/J2| 5o{@TLkX_Ci>Q=`EaK_5.x*$qv4rS5 aeYkm-f*1t5`lx$ E}A*bPDTn');
define('AUTH_SALT',        '/R{*2FkUC)I4zHsWOAko|eHCjb|ZVBxs{wje{GiRUAji<DWp+tfsh7Gf0bF^twDb');
define('SECURE_AUTH_SALT', ' z.,;d+OO2b:-1uH8.1|G5.Gp$u#RkIiGAsAu|r|7Eekmf<F] XF_Rw`y861Ey*!');
define('LOGGED_IN_SALT',   '#{Ih,Wt}5=W}wy.nm1<3|o$W?!1f(M;t|]dI1>Pm_J-F$3hwL[*T*qeY!WZ}d6`~');
define('NONCE_SALT',       'kN&?zAv,a)JZE+88{7aRl50h<E=]Gpq:3pUe7+^x[8jM [R]1jdQG,Z~^,^HfO{9');

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
