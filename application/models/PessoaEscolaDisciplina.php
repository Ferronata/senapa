<?php
/**
 * Modelo da classe PessoaEscolaDisciplina
 * Data de Cricação - 23/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("DefaultObject.php");

class PessoaEscolaDisciplina extends DefaultObject {
	protected $_name = 'pessoa_escola_disciplina';
	private $id;
	private $pessoaEscolaPessoaFisicaPessoaId;
	private $pessoaEscolaMatricula;
	private $disciplinaId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getPessoaEscolaPessoaFisicaPessoaId(){return $this->pessoaEscolaPessoaFisicaPessoaId;}
	public function setPessoaEscolaPessoaFisicaPessoaId($var){$this->pessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getPessoaEscolaMatricula(){return $this->pessoaEscolaMatricula;}
	public function setPessoaEscolaMatricula($var){$this->pessoaEscolaMatricula = $var;}

	public function getDisciplinaId(){return $this->disciplinaId;}
	public function setDisciplinaId($var){$this->disciplinaId = $var;}

	public function insert(){
		$tmp = new PessoaEscolaDisciplina();
		$where = 
		"
			`pessoa_escola_pessoa_fisica_pessoa_id` = '".$this->getPessoaEscolaPessoaFisicaPessoaId()."' AND 
			`pessoa_escola_matricula` = '".$this->getPessoaEscolaMatricula()."' AND 
			`disciplina_id` = '".$this->getDisciplinaId()."'
		";
		if($tmp->fetchRow($where))
			return $this->update();
		else{
			$array = array
				(
				'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
				'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
				'disciplina_id' => $this->getDisciplinaId()
				);
			return parent::insert($array);
		}
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'disciplina_id' => $this->getDisciplinaId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setDisciplinaId($object->disciplina_id);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
