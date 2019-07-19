<?php

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
define('WP_PROTOCOL', $_SERVER['HTTPS']? "https://" : "http://");

// DATABASE CONFIGURATION
switch (WP_ENV) {
	case "localhost":
	define('DB_NAME', 'gamefoss');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_HOST', 'localhost');
	break;
	case "production":
	define('DB_NAME', 'u566229331_gf');
	define('DB_USER', 'u566229331_gf');
	define('DB_PASSWORD', 'AoPmWpq8hUa6oadX');
	define('DB_HOST', 'localhost');
	break;
}
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix  = 'wp_';

/*	SALTS CONFIGURATION
*	https://api.wordpress.org/secret-key/1.1/salt/
*/

define('AUTH_KEY',         'KJTW47]G^1h9AALjYW/yjEJ[^j^{.zj?*1k.|uo,us6}}IB=Mw~D+7oq/kgEXx)4');
define('SECURE_AUTH_KEY',  'EX~]]Od` zS#V$=SPiCP6XxRpao~DZAY?zag_.0CIjg]jAhq$qN`dO;!:}/-LmL2');
define('LOGGED_IN_KEY',    '`_KQeZN.x&6c`$U?j >Pq}zI{`ObK13*bi|c7tf`-)qduxm1/<{IS_W#PJ/u/~.,');
define('NONCE_KEY',        'YV?&q%u9`UQ>#zl6O~! ]Y&b(ApP.55k^6;m3T6LCdCaoFl}}]eg>T|5fj2r/fK*');
define('AUTH_SALT',        'mT,OHQcL|3c_kd16@%wJxsp=+K%0Z-G}JH1gyT>^mUd|R13h~G`CM80/dn_|30}b');
define('SECURE_AUTH_SALT', 's21wUrrUWxTHt_<bY81RrB@@nt}Xa!`@bdOighVM8_cV3cQ?TAqGX)z.:emtt`4s');
define('LOGGED_IN_SALT',   '3p@IZbuNF(`zp*T@hy=eC:v(cSX K!XTj;] ,$x]a7z.}UX(#xA&`nF@A=hCgyUL');
define('NONCE_SALT',       'eiYwgkgY#K3xCz<~li h-sae,Lml1w{FZp4[Tna2hQD2H2 2&HLeK1%^U?&qen,Y');

// ENVIRONMENT CONFIGURATION
switch (WP_ENV) {
	case "localhost":
		define('WP_SITEURL', WP_PROTOCOL . $_SERVER['SERVER_NAME'] ."/gamefoss");
		define('WP_HOME',    WP_PROTOCOL . $_SERVER['SERVER_NAME'] . "/gamefoss");
		define('WP_DEBUG', true);
		break;
	case "development":
		break;
	case "production":
		define('WP_DEBUG', false);
		// Force SSL
		define('WP_HOME',    "https://" . $_SERVER['SERVER_NAME']);
		define('WP_SITEURL', "https://" . $_SERVER['SERVER_NAME']);
		define('FORCE_SSL_ADMIN', true);
		break;
}

// WP STUFF
if ( !defined('ABSPATH') ) define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');