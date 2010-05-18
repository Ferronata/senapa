<?php
/**
 * Modelo da classe UsabilidadeQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class UsabilidadeQuestao extends DefaultObject {
	protected $_name = 'usabilidade_questao';
	private $id;
	private $avaliacaoId;
	private $professorPessoaEscolaMatricula;
	private $professorPessoaEscolaPessoaFisicaPessoaId;
	private $questaoAlternativaId;
	private $dataEscolha;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function getProfessorPessoaEscolaMatricula(){return $this->professorPessoaEscolaMatricula;}
	public function setProfessorPessoaEscolaMatricula($var){$this->professorPessoaEscolaMatricula = $var;}

	public function getProfessorPessoaEscolaPessoaFisicaPessoaId(){return $this->professorPessoaEscolaPessoaFisicaPessoaId;}
	public function setProfessorPessoaEscolaPessoaFisicaPessoaId($var){$this->professorPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getQuestaoAlternativaId(){return $this->questaoAlternativaId;}
	public function setQuestaoAlternativaId($var){$this->questaoAlternativaId = $var;}

	public function getDataEscolha(){return $this->dataEscolha;}
	public function setDataEscolha($var){$this->dataEscolha = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'professor_pessoa_escola_matricula' => $this->getProfessorPessoaEscolaMatricula(),
			'professor_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getProfessorPessoaEscolaPessoaFisicaPessoaId(),
			'questao_alternativa_id' => $this->getQuestaoAlternativaId(),
			'data_escolha' => $this->getDataEscolha()
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
			'questao_alternativa_id' => $this->getQuestaoAlternativaId(),
			'data_escolha' => $this->getDataEscolha()
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
			$this->setQuestaoAlternativaId($object->questao_alternativa_id);
			$this->setDataEscolha($object->data_escolha);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
