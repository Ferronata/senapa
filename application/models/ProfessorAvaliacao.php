<?php
/**
 * Modelo da classe ProfessorAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class ProfessorAvaliacao extends DAO {
	protected $_name = 'professor_avaliacao';
	private $id;
	private $avaliacaoId;
	private $professorPessoaEscolaMatricula;
	private $professorPessoaEscolaPessoaFisicaPessoaId;
	private $dataCadastro;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function getProfessorPessoaEscolaMatricula(){return $this->professorPessoaEscolaMatricula;}
	public function setProfessorPessoaEscolaMatricula($var){$this->professorPessoaEscolaMatricula = $var;}

	public function getProfessorPessoaEscolaPessoaFisicaPessoaId(){return $this->professorPessoaEscolaPessoaFisicaPessoaId;}
	public function setProfessorPessoaEscolaPessoaFisicaPessoaId($var){$this->professorPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getDataCadastro(){return $this->dataCadastro;}
	public function setDataCadastro($var){$this->dataCadastro = $var;}

	public function insert(){
		$array = array
			(
			'avaliacao_id' => $this->getAvaliacaoId(),
			'professor_pessoa_escola_matricula' => $this->getProfessorPessoaEscolaMatricula(),
			'professor_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getProfessorPessoaEscolaPessoaFisicaPessoaId(),
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'professor_pessoa_escola_matricula' => $this->getProfessorPessoaEscolaMatricula(),
			'professor_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getProfessorPessoaEscolaPessoaFisicaPessoaId(),
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAvaliacaoId($object->avaliacao_id);
			$this->setProfessorPessoaEscolaMatricula($object->professor_pessoa_escola_matricula);
			$this->setProfessorPessoaEscolaPessoaFisicaPessoaId($object->professor_pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
