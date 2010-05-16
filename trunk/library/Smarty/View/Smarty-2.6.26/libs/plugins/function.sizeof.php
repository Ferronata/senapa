<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {sizeof} function plugin
 *
 * Type:     function<br>
 * Name:     sizeof<br>
 * Purpose:  print out a sizeof value
 * @author Monte Ohrt <monte at ohrt dot com>
 * @link http://smarty.php.net/manual/en/language.function.sizeof.php {sizeof}
 *       (Smarty online manual)
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_sizeof($params){
	$name = null;
	
	foreach($params as $key => $value){
		switch($key){
			case 'item':
			case 'value':
				$$key = $value;
		}
	}
	
	if(!empty($item))
		$name = $item;
	if(!empty($value))
		$name = $value;
		
	if(is_array($name))
		return sizeof($name);
	return 0;
}