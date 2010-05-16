<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_checkboxes} function plugin
 *
 * File:       function.html_data.php<br>
 * Type:       function<br>
 * Name:       html_data<br>
 * Date:       09.Mar.2010<br>
 
 * @link http://smarty.php.net/manual/en/language.function.html.data.php {html_data}
 *      (Smarty online manual)
 * @author     Leonardo Popik Bastos <leual27@gmail.com>
 * @version    1.0
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_html_data($params)
{

    $values 	= null;
    $options 	= null;
    
    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'options':
                $$_key = $_val;
                break;

            case 'values':
            case 'output':
                $$_key = $_val;
                break;
        }
    }

    if (!isset($options) && !isset($values))
        return ''; /* raise error here? */

   	$data = trim($values);
	$dt = "";
	if(strlen($data)>=10 && (int)(str_replace("-","",$data)) && (int)(str_replace("/","",$data)) && (int)(str_replace(".","",$data))){	
	    if (isset($options) && $options == 'db') {
	    	$dt = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2);
			if(strlen($data)>10)
				$dt .= substr($data,10);
	    } else {
	    	$dt = substr($data,8,2)."/".substr($data,5,2)."/".substr($data,0,4);
			if(strlen($data)>10)
				$dt .= substr($data,10);
	    }
	}
    print $dt;
/*
    if(!empty($params['assign'])) {
        $smarty->assign($params['assign'], $_html_result);
    } else {
        return implode("\n",$_html_result);
    }
*/
}