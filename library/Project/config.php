<?php

/**
 * Projeto Senapa Web
 * Iniciado em 01/02/2010
 * 
 * Arquivo de configura��o da aplica��o
 * 
 * Data de Crica��o - 09/02/2010
 * 
 * @filesource
 * @author Leonardo Popik Bastos
 * @copyright Copyright 2010 Leonardo Popik Bastos
 * @version 1.0
 */

// CAPTURA CONFIGURA��ES DO CONFIG.INI

/*
 * CARREGA CLASSES BASES DO ZEND
 */

// Faz include do componente Zend_loader. � obrigat�rio para carregar arquivos, classes e recursos
include ('Zend/Loader.php');

// Registro � um container para armazenar objetos e valores no espa�o de aplica��o
Zend_Loader::loadClass('Zend_Registry');

// Classe para configura��es
Zend_Loader::loadClass('Zend_Config_Ini');

$config = new Zend_Config_Ini('./application/configs/config.ini','database');
Zend_Registry::set('config',$config);

// Configura exibi��o das mensagens de erro.
error_reporting($config->project->error_reporting);

define('PROJECT_NAME',$config->project->name);
define('MD5_TEXT',$config->project->md5_text); // PALAVRA CHAVE PARA CRIPTOGRAFIA

date_default_timezone_set($config->project->timezone);

//Configura o formato da moeda local
setlocale(LC_MONETARY,$config->project->lc_monetary);

ini_set('max_execution_time',$config->project->max_execution_time);