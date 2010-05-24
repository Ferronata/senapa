<?php
/**
 * Modelo da classe PessoaEscola
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class ListaDisciplina{
	
	private $disciplinas;
	
	public function __construct(){
		$this->setDisciplinas(array());
	}
	public function getDisciplinas(){
		if(!$this->disciplinas)
			$this->setDisciplinas(array());
		return $this->disciplinas;
	}
	public function setDisciplinas($var){
		if(!$this->disciplinas)
			$var = array();
		$this->disciplinas = $var;
	}
	
	public function addDisciplina($disciplina){
		$i = $this->findDisicplina($disciplina);
		if($i < 0)
			$this->disciplinas[] = $disciplina;
		
	}
	public function findDisicplina($disciplina){
		for($i=0;$i<sizeof($this->getDisciplinas());$i++)
			if($this->disciplinas[$i]->getId() == $disciplina->getId())
				return $i;
		return -1;
	}
}