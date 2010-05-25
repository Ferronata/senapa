<?php
/**
 * Modelo da classe ListaAlternativa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class ListaAlternativa{
	
	private $alternativas;
	
	public function __construct(){
		$this->setAlternativas(array());
	}
	public function getAlternativas(){
		return $this->alternativas;
	}
	public function setAlternativas($var){
		$this->alternativas = $var;
	}
	
	public function addAlternativa($alternativa){
		$i = $this->findAlternativa($alternativa);
		if($i < 0){
			$this->alternativas[] = $alternativa;
		}
	}
	public function findAlternativa($alternativa){
		for($i=0;$i<sizeof($this->getAlternativas());$i++)
			if($this->alternativas[$i]->getDescricao() == $alternativa->getDescricao())
				return $i;
		return -1;
	}
}