<?php

/**
 * Projeto Senapa Web
 * Iniciado em 01/02/2010
 * 
 * Arquivo de configuração da aplicação
 * 
 * Data de Cricação - 09/02/2010
 * 
 * @filesource
 * @author Leonardo Popik Bastos
 * @copyright Copyright 2010 Leonardo Popik Bastos
 * @version 1.0
 */

// CAPTURA CONFIGURAÇÕES DO CONFIG.INI

/*
 * CARREGA CLASSES BASES DO ZEND
 */

// Faz include do componente Zend_loader. É obrigatório para carregar arquivos, classes e recursos
include ('Zend/Loader.php');

// Registro é um container para armazenar objetos e valores no espaço de aplicação
Zend_Loader::loadClass('Zend_Registry');

// Classe para configurações
Zend_Loader::loadClass('Zend_Config_Ini');

$config = new Zend_Config_Ini('./application/configs/config.ini','database');
Zend_Registry::set('config',$config);

// Configura exibição das mensagens de erro.
error_reporting($config->project->error_reporting);

define('PROJECT_NAME',$config->project->name);
define('MD5_TEXT',$config->project->md5_text); // PALAVRA CHAVE PARA CRIPTOGRAFIA

date_default_timezone_set($config->project->timezone);

//Configura o formato da moeda local
setlocale(LC_MONETARY,$config->project->lc_monetary);

ini_set('max_execution_time',$config->project->max_execution_time);