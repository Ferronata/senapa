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
				$i = date("w");
				$value .= W($i).$linha['text'];
				break;
			case 'd':
				$value .= date('d').$linha['text'];
				break;
			case 'D':	
				$i = date("w");
				$value .= D(($i-1)).$linha['text'];
				break;
			case 'm':
				$i = date("m");
				$value .= _m(($i-1)).$linha['text'];
				break;
			case 'M':
				$i = date("m");
				$value .= M(($i-1)).$linha['text'];
				break;
			case 'Y':
			case 'y':
				$value .= date($linha['codigo']).$linha['text'];
				break;
			default:
				$value .= date($linha['codigo']).$linha['text'];
				break;
		}
	}
	$value = trim($value);
	
	if(empty($value))
		$value = date("d/m/Y");
	return $value;
}
function D($i = 0){
	$lista = array(
		"Dom",
		"Seg",
		"Ter",
		"Qua",
		"Qui",
		"Sex",
		"Sáb"
	);
	return $lista[($i%7)];
}
function _w($i = 0){
	$lista = array(
		"domingo",
		"segunda",
		"terça",
		"quarta",
		"quinta",
		"sexta",
		"sábado"
	);
	$tmp = $lista[($i%7)]."-feira";
	return $tmp;
}
function W($i = 0){
	$tmp = _w($i);
	return strtoupper(substr($tmp,0,1)).substr($tmp,1);
}
function _m($i = 0){
	$lista = array(
		"janeiro",
		"fevereiro",
		"março",
		"abril",
		"maio",
		"junho",
		"julho",
		"agosto",
		"setembro",
		"outubro",
		"novembro",	
		"dezembro"
	);
	return $lista[($i%12)];
}
function M($i = 0){
	$tmp = _m($i);
	return strtoupper(substr($tmp,0,1)).substr($tmp,1);
}