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
 * Name:     crypt<br>

 * @link http://smarty.php.net/manual/en/language.function.crypt.php {crypt}
 *       (Smarty online manual)
 * @author Leonardo Popik Bastos <leual27@gmail.com>
 * @param array
 * @param Smarty
 */
function smarty_function_crypt($params)
{
	$crypt 	= null;
	$value 	= null;
	$action = null;
	
	foreach($params as $key => $line){
		switch($key){
			case 'crypt':
				$$key = $line;
				break;
			case 'value':
				$$key = $line;
			case 'action':
				$$key = $line;
		}
	}
	
	if(empty($value))
		return "";
	
	$funcao = new FuncoesProjeto();
	switch($crypt){
		case 'md5':
			if($action == 'decrypt')
				return $funcao->md5_decrypt($value);
			return $funcao->md5_encrypt($value);	
			break;
		default:
			return $value;
	}
}