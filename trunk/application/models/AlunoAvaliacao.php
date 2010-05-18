<?php
/**
 * Modelo da classe AlunoAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class AlunoAvaliacao extends DAO {
	protected $_name = 'aluno_avaliacao';
	private $id;
	private $avaliacaoId;
	private $alunoPessoaEscolaMatricula;
	private $alunoPessoaEscolaPessoaFisicaPessoaId;
	private $dataAcesso;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function getAlunoPessoaEscolaMatricula(){return $this->alunoPessoaEscolaMatricula;}
	public function setAlunoPessoaEscolaMatricula($var){$this->alunoPessoaEscolaMatricula = $var;}

	public function getAlunoPessoaEscolaPessoaFisicaPessoaId(){return $this->alunoPessoaEscolaPessoaFisicaPessoaId;}
	public function setAlunoPessoaEscolaPessoaFisicaPessoaId($var){$this->alunoPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getDataAcesso(){return $this->dataAcesso;}
	public function setDataAcesso($var){$this->dataAcesso = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'data_acesso' => $this->getDataAcesso(),
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'data_acesso' => $this->getDataAcesso(),
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAvaliacaoId($object->avaliacao_id);
			$this->setAlunoPessoaEscolaMatricula($object->aluno_pessoa_escola_matricula);
			$this->setAlunoPessoaEscolaPessoaFisicaPessoaId($object->aluno_pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setDataAcesso($object->data_acesso);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
