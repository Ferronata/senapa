<?php
/**
 * Modelo da classe AvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class AvaliacaoAluno extends DefaultObject {
	protected $_name = 'avaliacao_aluno';
	private $id;
	private $alunoPessoaEscolaMatricula;
	private $alunoPessoaEscolaPessoaFisicaPessoaId;
	private $avaliacaoId;
	private $dataInicio;
	private $dataFim;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAlunoPessoaEscolaMatricula(){return $this->alunoPessoaEscolaMatricula;}
	public function setAlunoPessoaEscolaMatricula($var){$this->alunoPessoaEscolaMatricula = $var;}

	public function getAlunoPessoaEscolaPessoaFisicaPessoaId(){return $this->alunoPessoaEscolaPessoaFisicaPessoaId;}
	public function setAlunoPessoaEscolaPessoaFisicaPessoaId($var){$this->alunoPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function getDataInicio(){return $this->dataInicio;}
	public function setDataInicio($var){$this->dataInicio = $var;}

	public function getDataFim(){return $this->dataFim;}
	public function setDataFim($var){$this->dataFim = $var;}

	public function insert(){
		$array = array
			(
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'data_inicio' => $this->getDataInicio()
			);
			$id = parent::insert($array);
			$this->setId($id);
		return $id;
	}
	public function update(){
		$array = array
			(
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'data_inicio' => $this->getDataInicio(),
			'data_fim' => $this->getDataFim()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAlunoPessoaEscolaMatricula($object->aluno_pessoa_escola_matricula);
			$this->setAlunoPessoaEscolaPessoaFisicaPessoaId($object->aluno_pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setAvaliacaoId($object->avaliacao_id);
			$this->setDataInicio($object->data_inicio);
			$this->setDataFim($object->data_fim);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function toString(){
		$str = $this->getId()." - M:".$this->getAlunoPessoaEscolaMatricula()." - P:".$this->getAlunoPessoaEscolaPessoaFisicaPessoaId()." - A:".$this->getAvaliacaoId()." - I:".$this->getDataInicio()." - F:".$this->getDataFim();
		return $str;
	}
}
