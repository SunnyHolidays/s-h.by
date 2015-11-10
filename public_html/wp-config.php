<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sunnyhol_wp2');

/** MySQL database username */
define('DB_USER', 'sunnyhol_wp2');

/** MySQL database password */
define('DB_PASSWORD', 'H|QjkZQYl#)#5');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '2ai3Z23SkMik1bb6GDzGfLolQuaRDuHAeDjFXsgIh07eW7VnkbG8jmMyUCr4i4s6');
define('SECURE_AUTH_KEY',  'pRq7KHRoR88Uh8aUpmuPxO1rrBR7v9wSHNwuB0RPkgSVFq8l1sLGgqlgbOKk8T78');
define('LOGGED_IN_KEY',    'zzn3e55qmWfj8EhD3ay7258c6aFU07Ut1HCv4X6H2u2KnYnnxoqOrYtrX55ag1jj');
define('NONCE_KEY',        'RioCWyCmZrx21JM0BwIEm7JLxVh904JDH6FtRbMHsIi3ZZt3iwHqlT3jHluNAdM5');
define('AUTH_SALT',        'vikewrQIqeIMIBniGMQJTsOzkZImuZeVsCyKxSGM7JlIpCxDWOnKG8x7TFErZFAc');
define('SECURE_AUTH_SALT', '2ynAHds0Y3dx9hi9hjeeDQp6NCQxdR6e1F4skZZktPi7fyTJKEMYGufN8JbG7nkN');
define('LOGGED_IN_SALT',   'Fp1eV9TPmXiwgCwJJrMmKaDCLe6hOvSWJbXgzF1ATqTWD0IHcPsbdt1ie4dSMvQO');
define('NONCE_SALT',       'wXoa98c2WnbZjeeSl7oQOzwEmAulZyZWp2rp2Npfa3RMJm1BKV7juDGXJbQL6pr2');

/**
 * Other customizations.
 *
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'ru_RU');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
