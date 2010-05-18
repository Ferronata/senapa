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
	private $horaInicio;
	private $horaFim;

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

	public function getHoraInicio(){return $this->horaInicio;}
	public function setHoraInicio($var){$this->horaInicio = $var;}

	public function getHoraFim(){return $this->horaFim;}
	public function setHoraFim($var){$this->horaFim = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'data_inicio' => $this->getDataInicio(),
			'hora_inicio' => $this->getHoraInicio(),
			'hora_fim' => $this->getHoraFim()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'data_inicio' => $this->getDataInicio(),
			'hora_inicio' => $this->getHoraInicio(),
			'hora_fim' => $this->getHoraFim()
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
			$this->setHoraInicio($object->hora_inicio);
			$this->setHoraFim($object->hora_fim);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
