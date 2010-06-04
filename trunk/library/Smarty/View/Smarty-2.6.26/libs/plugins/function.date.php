<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {eval} function plugin
 *
 * Type:     function<br>
 * Name:     date<br>
 * @author Leonardo Popik Bastos <leual27@gmail.com>
 * @param array
 * @param Smarty
 */
function smarty_function_date($params)
{
	$type 	= null;
	$value 	= null;
	
	foreach($params as $key => $line){
		switch($key){
			case 'type':
				$$key = $line;
				break;
			case 'value':
				$$key = $line;
		}
	}
	
	if(empty($type))
		$type = "%d/%m/%Y";
	
	"%W,%d de %M de %Y";
	$command = explode("%",$type);
	$lista = array();
	
	foreach($command as $line){
		if(!empty($line)){
			$lista[] = array(
				'codigo' 	=> substr(trim($line),0,1),
				'text' 		=> substr($line,1)
			);
		}
	}
	
	foreach($lista as $linha){
		switch($linha['codigo']){
			case 'W':
				break;
			case 'd':
				break;
			case 'M':
				break;
			case 'Y':
				break;
		}
	}
	if(empty($value))
		$value = "";
	return $value;
}