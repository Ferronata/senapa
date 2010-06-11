<?php
/**
 * Modelo da classe ListaDisciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class ListaAlunoResolveQuestao{
	
	private $listaAlunoResolveQuestao;
	
	public function __construct(){
		$this->setListaAlunoResolveQuestao(array());
	}
	public function getListaAlunoResolveQuestao(){
		if(!$this->listaAlunoResolveQuestao)
			$this->setListaAlunoResolveQuestao(array());
		return $this->listaAlunoResolveQuestao;
	}
	public function setListaAlunoResolveQuestao($var = array()){
		if(empty($var))
			$var = array();
		$this->listaAlunoResolveQuestao = $var;
	}
	
	public function update($pos, $value){
		if($pos>=0){
			$this->listaAlunoResolveQuestao[$pos] = $value;
			return $this->listaAlunoResolveQuestao[$pos];
		}
		return new AlunoResolveQuestao();
	}
	
	public function add($value){
		$i = $this->find($value);
		if($i < 0)
			$this->listaAlunoResolveQuestao[] = $value;
	}
	public function remove($value){
		$i = $this->find($value);
		
		if($i >= 0){
			if($i == 0)
				$this->setListaAlunoResolveQuestao();
			else
				$this->listaAlunoResolveQuestao[$i] = $this->listaAlunoResolveQuestao[(sizeof($this->getListaAlunoResolveQuestao())-1)];
		}
	}
	public function find($value){
		for($i=0;$i<sizeof($this->getListaAlunoResolveQuestao());$i++)
			if($this->listaAlunoResolveQuestao[$i]->getId() == $value->getId())
				return $i;
		return -1;
	}
}