<?php
/**
 * Modelo da classe DefaultObject
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

require_once 'Enum.php';

class DefaultObject extends Zend_Db_Table{
	
	private function enums(){
		$enums = array(
			"QUESTAO" 		=> 1,
			"AVALIACAO" 	=> 2
		);
		return new DefinedEnum($enums);
	}
	public function getTipoPesquisa($enum){
		$enum = strtoupper($enum);
		$enums = $this->enums();
		try{
			return $enums->$enum;
		}catch(Exception $e){return NULL;}
	}
	
	public function toString(){
		$str = "[";
		if(!empty($this->_name)){
			$tmp = "  ";
			$list = array();
			
			$metodos = get_class_methods($this->_name);
			
			foreach($metodos as $metodo){
				if(strpos(" ".$metodo,"get") && !strpos(" ".$metodo,"_get"))
					$list[] = $metodo;
			}
			foreach($list as $linha){
				try{
					if(is_string($this->$linha()))
						$tmp .= $this->$linha()."; ";
				}catch(Exception $e){}
			}
			$tmp = trim(substr($tmp,0,-2));
			$str .= $tmp;
		}
		$str .= "]";
		return $str;
	}
}