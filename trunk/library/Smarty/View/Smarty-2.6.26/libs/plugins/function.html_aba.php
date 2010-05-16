<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {html_checkboxes} function plugin
 *
 * File:       function.html_aba.php<br>
 * Type:       function<br>
 * Name:       html_aba<br>
 * Date:       09.Mar.2010<br>
 
 * @link http://smarty.php.net/manual/en/language.function.html.aba.php {html_aba}
 *      (Smarty online manual)
 * @author     Leonardo Popik Bastos <leual27@gmail.com>
 * @version    1.0
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_html_aba($params)
{

    $value 	= null;
    $forid	= null;
    $classe	= null;
    $url	= null;
    
    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'url':
                $$_key = $_val;
                break;
            case 'forid':
                $$_key = $_val;
                break;
            case 'classe':
                $$_key = $_val;
                break;
            case 'value':
            case 'output':
                $$_key = $_val;
                break;
        }
    }
    if (!isset($value) && !isset($forid))
        return ''; /* raise error here? */
        
	if(empty($url))
		$url = "<span id=\"k\" class=\"aba".(($classe)?" selected":"")."\"><input type=\"button\" class=\"bt_aba\" value=\"".$value."\" onclick=\"aba(this,'".$forid."')\" /></span>";
		
	print $url;
}