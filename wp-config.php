<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'gamefoss');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'root');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KJTW47]G^1h9AALjYW/yjEJ[^j^{.zj?*1k.|uo,us6}}IB=Mw~D+7oq/kgEXx)4');
define('SECURE_AUTH_KEY',  'EX~]]Od` zS#V$=SPiCP6XxRpao~DZAY?zag_.0CIjg]jAhq$qN`dO;!:}/-LmL2');
define('LOGGED_IN_KEY',    '`_KQeZN.x&6c`$U?j >Pq}zI{`ObK13*bi|c7tf`-)qduxm1/<{IS_W#PJ/u/~.,');
define('NONCE_KEY',        'YV?&q%u9`UQ>#zl6O~! ]Y&b(ApP.55k^6;m3T6LCdCaoFl}}]eg>T|5fj2r/fK*');
define('AUTH_SALT',        'mT,OHQcL|3c_kd16@%wJxsp=+K%0Z-G}JH1gyT>^mUd|R13h~G`CM80/dn_|30}b');
define('SECURE_AUTH_SALT', 's21wUrrUWxTHt_<bY81RrB@@nt}Xa!`@bdOighVM8_cV3cQ?TAqGX)z.:emtt`4s');
define('LOGGED_IN_SALT',   '3p@IZbuNF(`zp*T@hy=eC:v(cSX K!XTj;] ,$x]a7z.}UX(#xA&`nF@A=hCgyUL');
define('NONCE_SALT',       'eiYwgkgY#K3xCz<~li h-sae,Lml1w{FZp4[Tna2hQD2H2 2&HLeK1%^U?&qen,Y');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
