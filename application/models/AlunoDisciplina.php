<?php
/**
 * Modelo da classe AlunoDisciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class AlunoDisciplina extends DefaultObject {
	protected $_name = 'aluno_disciplina';
	private $id;
	private $disciplinaId;
	private $alunoPessoaEscolaMatricula;
	private $alunoPessoaEscolaPessoaFisicaPessoaId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDisciplinaId(){return $this->disciplinaId;}
	public function setDisciplinaId($var){$this->disciplinaId = $var;}

	public function getAlunoPessoaEscolaMatricula(){return $this->alunoPessoaEscolaMatricula;}
	public function setAlunoPessoaEscolaMatricula($var){$this->alunoPessoaEscolaMatricula = $var;}

	public function getAlunoPessoaEscolaPessoaFisicaPessoaId(){return $this->alunoPessoaEscolaPessoaFisicaPessoaId;}
	public function setAlunoPessoaEscolaPessoaFisicaPessoaId($var){$this->alunoPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setDisciplinaId($object->disciplina_id);
			$this->setAlunoPessoaEscolaMatricula($object->aluno_pessoa_escola_matricula);
			$this->setAlunoPessoaEscolaPessoaFisicaPessoaId($object->aluno_pessoa_escola_pessoa_fisica_pessoa_id);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
