<?php
/**
 * Modelo da classe ListaQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class ListaQuestao{
	
	private $listaQuestao;
	
	public function __construct(){
		$this->setListaQuestao(array());
	}
	public function getListaQuestao(){
		return $this->listaQuestao;
	}
	public function setListaQuestao($var){
		$this->listaQuestao = $var;
	}
	
	public function addQuestao($questao){
		$i = $this->findQuestao($questao);
		if($i < 0)
			$this->listaQuestao[] = $questao;
	}
	public function findQuestao($questao){
		for($i=0;$i<sizeof($this->getListaQuestao());$i++)
			if($this->listaQuestao[$i]->getDescricao() == $questao->getDescricao())
				return $i;
		return -1;
	}
	public function findNivel($questao, $listaNivel = array()){
		for($i=0; $i<sizeof($listaNivel); $i++){
			if($listaNivel[$i] == $questao->getNivelQuestao()->getNivel())
				return $i;
		}
		return -1;
	}
}