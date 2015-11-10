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
define('DB_NAME', 'sunnyhol_wp1');

/** MySQL database username */
define('DB_USER', 'sunnyhol_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'BO4QQAVul)k*3');

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

define('AUTH_KEY',         'CsOd3M7ltvxU8SibWQXvvRlXSmriHqZkR6VoCQVjPtmqoXiXmgDGaVQAkq7zYl9w');
define('SECURE_AUTH_KEY',  'i6HJVwvYyPRjkisL2MwXePokKsU1a1dz0qLwOeOa8LlsomkQMZCbthkcOE2p3MlH');
define('LOGGED_IN_KEY',    'uDqfNrBGi2W9DuggPOPsolYCrlMO50F8SCUywlmWCgb7W8Bi2EltvROzXlY4DWTW');
define('NONCE_KEY',        'pUrtr6qJdS3LY8Tn7t7MYBPVq3AIdQ9oql1IL5vUkZdWdsjXCZtCGX8OiqJ0pm3H');
define('AUTH_SALT',        'IBwxpPubd10jJGm4Zn3a6CfEIcS0kz0MbRfu0b6k0jNQaUxFboMe78Su2SN2SNpW');
define('SECURE_AUTH_SALT', 'fCsVzgvMOD9US3VTwAJeHaK8VK0gkbZ03MWWtc8mxtw8KePDRj5p3ibP0xq0Klym');
define('LOGGED_IN_SALT',   'jtxj4psBGo3ozywpnlDWknFvKg1oomRs17Wyq1553Z5VH1v8zUhHJZ28RUeeMglq');
define('NONCE_SALT',       'WoqWuB4ZOT29tlzl9uHk6QAZI49Krbm7c6QH8uOTeEQdVgqewUv0Jto8hxZkpWTA');
define('WP_TEMP_DIR',      '/home/sunnyhol/public_html/wp-content/uploads');

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
