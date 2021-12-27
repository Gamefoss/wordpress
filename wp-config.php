<?php

$env = parse_ini_file('env.ini', false);

// ENVIRONMENT
switch ($_SERVER['SERVER_NAME']) {
	case "gamefoss.com":
	case "gamefoss.com.br":
	define('WP_ENV', 'production');
	break;
	default:
	define('WP_ENV', 'localhost');
	break;
}

// PROTOCOL CONFIGURATION
define('HTTPS_PROTOCOL', "https://");
define('WP_PROTOCOL', $_SERVER['HTTPS']? HTTPS_PROTOCOL : "http://");

// DATABASE CONFIGURATION

define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
define('DB_HOST', $env['DB_HOST']);

define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix  = 'wp_';

/*	SALTS CONFIGURATION
*	https://api.wordpress.org/secret-key/1.1/salt/
*/

define('AUTH_KEY', $env['AUTH_KEY']);
define('SECURE_AUTH_KEY', $env['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $env['LOGGED_IN_KEY']);
define('NONCE_KEY', $env['NONCE_KEY']);
define('AUTH_SALT', $env['AUTH_SALT']);
define('SECURE_AUTH_SALT', $env['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $env['LOGGED_IN_SALT']);
define('NONCE_SALT', $env['NONCE_SALT']);

// ENVIRONMENT CONFIGURATION
switch (WP_ENV) {
    case "production":
		define('WP_DEBUG', false);
		// Force SSL
		define('WP_HOME',    HTTPS_PROTOCOL . $_SERVER['SERVER_NAME']);
		define('WP_SITEURL', HTTPS_PROTOCOL . $_SERVER['SERVER_NAME']);
		define('FORCE_SSL_ADMIN', true);
		break;
	case "localhost":
	case "development":
	default:
		define('WP_SITEURL', WP_PROTOCOL . $_SERVER['SERVER_NAME'] ."/gamefoss");
		define('WP_HOME',    WP_PROTOCOL . $_SERVER['SERVER_NAME'] . "/gamefoss");
		define('WP_DEBUG', true);
		break;
}

// WP STUFF
if ( !defined('ABSPATH') ) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

require_once(ABSPATH . 'wp-settings.php');
