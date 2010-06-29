<?php
require_once('Smarty/View/Smarty-2.6.26/libs/Smarty.class.php');

class Smarty_View_Smarty extends Zend_View_Abstract{
	private $_smarty;
	private $_operatingSystem;
	private $_bar;
	private $_pathSeparator;
	private $_documentRoot;
	private $_libraryPath;
	
	public function __construct($data = array()){
		parent::__construct($data);
		$this->_smarty = new Smarty();
		
		//define('PROJECT_DIR_NAME',	basename(getcwd()));
		$dir_name = basename(getcwd());
		
		$this->_operatingSystem = stripos($_SERVER['SERVER_SOFTWARE'],'win32') !== FALSE ? 'WINDOWS' : 'LINUX';		
		$this->_bar 			= ($this->_operatingSystem == 'WINDOWS') ? '\\' : '/';
		$this->_pathSeparator	= ($this->_operatingSystem == 'WINDOWS') ? ';' : ':';
		$this->_documentRoot	= str_replace('/',$this->_bar,$_SERVER['DOCUMENT_ROOT']);
		
		/*
		$tmp = str_replace('/',$this->_bar,$_SERVER['DOCUMENT_ROOT']);
		$tmp = str_replace($this->_bar.$dir_name,'',$tmp);
		$this->_documentRoot = $tmp;
		*/
		
		$this->_libraryPath		= $this->_documentRoot .$this->_bar. $dir_name .$this->_bar. 'library' .$this->_bar. 'Smarty' .$this->_bar;
		
		$config					= parse_ini_file($this->_libraryPath. 'config.ini',TRUE);
		
		$this->_smarty->caching 		= (bool)$config['smarty']['caching'];
		$this->_smarty->cache_lifetime 	= (int)$config['smarty']['cachelifetime'];
		$this->_smarty->template_dir 	= '';
		$this->_smarty->compile_dir		= $this->_libraryPath. 'View' .$this->_bar. 'Smarty-2.6.26' .$this->_bar. 'templates_c';
		$this->_smarty->config_dir		= $this->_libraryPath. 'View' .$this->_bar. 'Smarty-2.6.26' .$this->_bar. 'configs';
		$this->_smarty->cache_dir		= $this->_libraryPath. 'View' .$this->_bar. 'Smarty-2.6.26' .$this->_bar. 'cache';
		
		$smartyPath = $this->_pathSeparator .$this->_libraryPath. 'View' .$this->_bar. 'Smarty-2.6.26' .$this->_bar. 'libs';
		
		set_include_path(get_include_path(). $smartyPath);
	}
	
	public function setTemplateDir($applicationName){
		$this->_smarty->template_dir = $this->_documentRoot .$this->_bar. $applicationName .$this->_bar. 'application' .$this->_bar. 'views' .$this->_bar. 'scripts' .$this->_bar;
	}
	
	protected function _run($template = "index.tpl"){
		$this->_smarty->display($template);
	}
	
	public function assign($spec, $value = NULL){
		if(is_string($spec))
			$this->_smarty->assign($spec, $value);
		elseif(is_array($spec))
			foreach ($spec as $key => $value)
				$this->_smarty->assign($key, $value);
		else
			throw new Zend_View_Exception('assign() expects a string or array, got '.gettype($var));
		
	}
	
	public function escape($var){
		if(is_string($var))
			return parent::escape($var);
		elseif(is_array($var))
			foreach ($var as $key => $value)
				$var[$key] = $this->escape($value);
		return $var;
	}
	
	public function output($name){
		$this->_smarty->display($this->_smarty->template_dir .$name);
		exit;
	}
	
	public function isCached($template){
		if($this->_smarty->is_cached($template))
			return TRUE;
		return FALSE;
	}
	
	public function setCaching($caching){
		$this->_smarty->caching = $caching;
	}
}