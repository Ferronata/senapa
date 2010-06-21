<?php
/**
 * Projeto Senapa Web
 * Iniciado em 01/02/2010
 * 
 * Arquivo de configuraчуo da aplicaчуo
 * 
 * Data de Cricaчуo - 09/02/2010
 * 
 * @filesource
 * @author Leonardo Popik Bastos
 * @copyright Copyright 2010 Leonardo Popik Bastos
 * @version 1.0
 */

// Configura as mensagens de erro que devem ser apresentadas

// Identifica o SO do servidor e configura as variсveis delimitadoras
define('SYS_OS',			(stripos($_SERVER['SERVER_SOFTWARE'],'win32') !== false) ? 'WINDOWS' : 'LINUX');
define('SYS_BAR',			(SYS_OS === 'WINDOWS') ? '\\' : '/');
define('SYS_SEPARATOR_PATH',(SYS_OS === 'WINDOWS') ? ';' : ':');
define('SYS_DOCUMENT_ROOT',	str_replace('/',SYS_BAR,$_SERVER['DOCUMENT_ROOT']));

define('PROJECT_DIR_NAME',	basename(getcwd()));
define('PROJECT_ROOT',		SYS_DOCUMENT_ROOT . SYS_BAR . PROJECT_DIR_NAME . SYS_BAR);
define('BASE_URL',			trim(substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/index.php'))));

// Configura o caminho a ser procurado em todos os includes
$tmp 		= SYS_SEPARATOR_PATH . PROJECT_ROOT;
$includes 	= array(
		'library', 
		'application'. SYS_BAR .'controllers',
		'application'. SYS_BAR .'models', 
		"library". SYS_BAR ."Project". SYS_BAR .'class' .SYS_BAR
	);
$path		= '';
foreach ($includes as $include)
	$path .= $tmp.$include;

set_include_path(get_include_path().$path);

require_once('config.php');