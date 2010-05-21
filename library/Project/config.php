<?php

/**
 * Projeto Photograf Web
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
//error_reporting(E_ALL|E_STRICT|~E_NOTICE);
error_reporting(~E_NOTICE&~E_STRICT&~E_WARNING);

// Identifica o SO do servidor e configura as variсveis delimitadoras
define('SYS_OS',			(stripos($_SERVER['SERVER_SOFTWARE'],'win32') !== false) ? 'WINDOWS' : 'LINUX');
define('SYS_BAR',			(SYS_OS === 'WINDOWS') ? '\\' : '/');
define('SYS_SEPARATOR_PATH',(SYS_OS === 'WINDOWS') ? ';' : ':');
define('SYS_DOCUMENT_ROOT',	str_replace('/',SYS_BAR,$_SERVER['DOCUMENT_ROOT']));

define('PROJECT_NAME',		'Sga');
define('PROJECT_DIR_NAME',	basename(getcwd()));
define('PROJECT_ROOT',		SYS_DOCUMENT_ROOT . SYS_BAR . PROJECT_DIR_NAME . SYS_BAR);
define('BASE_URL',			substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/index.php')));

define('MD5_TEXT', "SeNaPa_MD5"); // PALAVRA CHAVE PARA CRIPTOGRAFIA

// Configura o caminho a ser procurado em todos os includes
$tmp 		= SYS_SEPARATOR_PATH . PROJECT_ROOT;
$includes 	= array(
		'library', 
		'application'. SYS_BAR .'models', 
		"library". SYS_BAR ."Project". SYS_BAR .'class' .SYS_BAR
	);
$path		= '';
foreach ($includes as $include)
	$path .= $tmp.$include;

set_include_path(get_include_path().$path);

date_default_timezone_set('America/Sao_Paulo');
