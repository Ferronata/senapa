<?php
/**
 * Projeto Photograf Web
 * Iniciado em 01/02/2010
 * 
 * Arquivo principal da aplicação
 * 
 * Data de Cricação - 09/02/2010
 * 
 * @filesource
 * @author Leonardo Popik Bastos
 * @copyright Copyright 2010 Leonardo Popik Bastos
 * @version 1.0
 */
include_once("library/Project/ini.php");
include("debuglib.php");

//show_vars();

header('Content-type: text/html; charset='.CHARSET.'');

//basename Retorna a parte nome do arquivo do caminho/path ex: basename("/home/httpd/html/index.php"); retorna index.php
//getcwd Obtem o diretorio atual
$applicationName = basename(getcwd());

Zend_Loader::loadClass('Zend_View_Abstract');

// O método loadClass é responsável por incluir o arquivo responsável pela classe
// Tenta carregar o arquivo passado por parâmetro e se não conseguir gera exceção
// o simbolo _ significa separador de pasta => Zend_Controller equivale a Zend/Controller

// Classe de controladores
Zend_Loader::loadClass('Zend_Controller_Front');

// Classe de visões
//Zend_Loader::loadClass('Zend_View');

// Classe Substituta do Zend_View => Smarty
Zend_Loader::loadClass('Smarty_View_Smarty');

// Classe de acesso a base de dados
Zend_Loader::loadClass('Zend_Db');

// Classe para usar as tabelas como objetos
Zend_Loader::loadClass('Zend_Db_Table');

// Classe usada para filtrar os dados
Zend_Loader::loadClass('Zend_Filter_Input');

// Classe usada para gerenciar a sessão
Zend_Loader::loadClass('Zend_Session');

// Classe usada para armazenar e recuperar dados da sessão
Zend_Loader::loadClass('Zend_Session_Namespace');

Zend_Loader::loadFile('Project/include.php');

// o método set é responsável por armazenar variáveis que podem ser usadas pelos aplicativos
Zend_Registry::set('post',new Zend_Filter_Input(NULL,NULL,$_POST));
Zend_Registry::set('get',new Zend_Filter_Input(NULL,NULL,$_GET));

// Instancia e configuração de visão
//$view = new Zend_View();
$view = new Smarty_View_Smarty();
$view->setEncoding(CHARSET);
$view->setEscape('htmlentities');
//$view->setBasePath('./application/views/');
$view->setTemplateDir($applicationName);

Zend_Registry::set('view',$view);

// Inicia e registra a sessão
Zend_Session::start();

Zend_Registry::set('session',new Zend_Session_Namespace());


// Configuração do controlador do projeto
// o controlado é o index.php

//Cria uma nova instancia da class controladora
$frontController = Zend_Controller_Front::getInstance();

$frontController->setBaseUrl(BASE_URL);
$frontController->setControllerDirectory('./application/controllers');

// O controlador deve tratar as exceções
$frontController->throwExceptions(true);

//Configura a conexão com a base de dados
//$config->get();

$database = new Zend_Config_Ini('./application/configs/config.ini','database');

$db = Zend_Db::factory($database->db->adapter, $database->db->config->toArray());
Zend_Db_Table_Abstract::setDefaultAdapter($db);
Zend_Registry::set('db',$db);

// Executa o Controller do projeto
// Ele que receberá todas as requisições e dispachará para os arquivos correspondentes

$frontController->dispatch();