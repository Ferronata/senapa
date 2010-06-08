<?php
/**
 * Projeto Photograf Web
 * Iniciado em 01/02/2010
 * 
 * Arquivo principal da aplica��o
 * 
 * Data de Crica��o - 09/02/2010
 * 
 * @filesource
 * @author Leonardo Popik Bastos
 * @copyright Copyright 2010 Leonardo Popik Bastos
 * @version 1.0
 */
header('Content-type: text/html; charset=ISO-8859-1');

include_once("library/Project/config.php");
include("debuglib.php");

//show_vars();

$applicationName = basename(getcwd());

// Faz include do componente Zend_loader. � obrigat�rio para carregar arquivos, classes e recursos
include ('Zend/Loader.php');

// Registro � um container para armazenar objetos e valores no espa�o de aplica��o
Zend_Loader::loadClass('Zend_Registry');

Zend_Loader::loadClass('Zend_View_Abstract');

// O m�todo loadClass � respons�vel por incluir o arquivo respons�vel pela classe
// Tenta carregar o arquivo passado por par�metro e se n�o conseguir gera exce��o
// o simbolo _ significa separador de pasta => Zend_Controller equivale a Zend/Controller

// Classe de controladores
Zend_Loader::loadClass('Zend_Controller_Front');

// Classe de vis�es
//Zend_Loader::loadClass('Zend_View');

// Classe Substituta do Zend_View => Smarty
Zend_Loader::loadClass('Smarty_View_Smarty');

// Classe para configura��es
Zend_Loader::loadClass('Zend_Config_Ini');

// Classe de acesso a base de dados
Zend_Loader::loadClass('Zend_Db');

// Classe para usar as tabelas como objetos
Zend_Loader::loadClass('Zend_Db_Table');

// Classe usada para filtrar os dados
Zend_Loader::loadClass('Zend_Filter_Input');

// Classe usada para gerenciar a sess�o
Zend_Loader::loadClass('Zend_Session');

// Classe usada para armazenar e recuperar dados da sess�o
Zend_Loader::loadClass('Zend_Session_Namespace');

Zend_Loader::loadFile('Project/include.php');

// o m�todo set � respons�vel por armazenar vari�veis que podem ser usadas pelos aplicativos
Zend_Registry::set('post',new Zend_Filter_Input(NULL,NULL,$_POST));
Zend_Registry::set('get',new Zend_Filter_Input(NULL,NULL,$_GET));

// Instancia e configura��o de vis�o
//$view = new Zend_View();
$view = new Smarty_View_Smarty();
$view->setEncoding('UTF-8');
$view->setEscape('htmlentities');
//$view->setBasePath('./application/views/');
$view->setTemplateDir($applicationName);

Zend_Registry::set('view',$view);

// Inicia e registra a sess�o
Zend_Session::start();

Zend_Registry::set('session',new Zend_Session_Namespace());


// Configura��o do controlador do projeto
// o controlado � o index.php

//Cria uma nova instancia da class controladora
$frontController = Zend_Controller_Front::getInstance();

$frontController->setBaseUrl(BASE_URL);
$frontController->setControllerDirectory('./application/controllers');

// O controlador deve tratar as exce��es
$frontController->throwExceptions(true);


// Configura��o da base de dados

$config = new Zend_Config_Ini('./application/configs/config.ini','database');
Zend_Registry::set('config',$config);

//Configura a conex�o com a base de dados
//$config->get();

$db = Zend_Db::factory($config->db->adapter, $config->db->config->toArray());
Zend_Db_Table_Abstract::setDefaultAdapter($db);
Zend_Registry::set('db',$db);

// Executa o Controller do projeto
// Ele que receber� todas as requisi��es e dispachar� para os arquivos correspondentes

$frontController->dispatch();