<?php
/**
 * Modelo da classe ProfessorDisciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class ProfessorDisciplina extends DefaultObject {
	protected $_name = 'professor_disciplina';
	private $id;
	private $disciplinaId;
	private $professorPessoaEscolaMatricula;
	private $professorPessoaEscolaPessoaFisicaPessoaId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDisciplinaId(){return $this->disciplinaId;}
	public function setDisciplinaId($var){$this->disciplinaId = $var;}

	public function getProfessorPessoaEscolaMatricula(){return $this->professorPessoaEscolaMatricula;}
	public function setProfessorPessoaEscolaMatricula($var){$this->professorPessoaEscolaMatricula = $var;}

	public function getProfessorPessoaEscolaPessoaFisicaPessoaId(){return $this->professorPessoaEscolaPessoaFisicaPessoaId;}
	public function setProfessorPessoaEscolaPessoaFisicaPessoaId($var){$this->professorPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'professor_pessoa_escola_matricula' => $this->getProfessorPessoaEscolaMatricula(),
			'professor_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getProfessorPessoaEscolaPessoaFisicaPessoaId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'professor_pessoa_escola_matricula' => $this->getProfessorPessoaEscolaMatricula(),
			'professor_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getProfessorPessoaEscolaPessoaFisicaPessoaId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setDisciplinaId($object->disciplina_id);
			$this->setProfessorPessoaEscolaMatricula($object->professor_pessoa_escola_matricula);
			$this->setProfessorPessoaEscolaPessoaFisicaPessoaId($object->professor_pessoa_escola_pessoa_fisica_pessoa_id);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
