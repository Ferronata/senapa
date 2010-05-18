<?php
/**
 * Modelo da classe QuestaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class QuestaoAluno extends DefaultObject {
	protected $_name = 'questao_aluno';
	private $id;
	private $alunoPessoaEscolaMatricula;
	private $alunoPessoaEscolaPessoaFisicaPessoaId;
	private $questaoId;
	private $inicio;
	private $tempoResolucao;
	private $resposta;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAlunoPessoaEscolaMatricula(){return $this->alunoPessoaEscolaMatricula;}
	public function setAlunoPessoaEscolaMatricula($var){$this->alunoPessoaEscolaMatricula = $var;}

	public function getAlunoPessoaEscolaPessoaFisicaPessoaId(){return $this->alunoPessoaEscolaPessoaFisicaPessoaId;}
	public function setAlunoPessoaEscolaPessoaFisicaPessoaId($var){$this->alunoPessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getInicio(){return $this->inicio;}
	public function setInicio($var){$this->inicio = $var;}

	public function getTempoResolucao(){return $this->tempoResolucao;}
	public function setTempoResolucao($var){$this->tempoResolucao = $var;}

	public function getResposta(){return $this->resposta;}
	public function setResposta($var){$this->resposta = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'questao_id' => $this->getQuestaoId(),
			'inicio' => $this->getInicio(),
			'tempo_resolucao' => $this->getTempoResolucao(),
			'resposta' => $this->getResposta()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'aluno_pessoa_escola_matricula' => $this->getAlunoPessoaEscolaMatricula(),
			'aluno_pessoa_escola_pessoa_fisica_pessoa_id' => $this->getAlunoPessoaEscolaPessoaFisicaPessoaId(),
			'questao_id' => $this->getQuestaoId(),
			'inicio' => $this->getInicio(),
			'tempo_resolucao' => $this->getTempoResolucao(),
			'resposta' => $this->getResposta()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAlunoPessoaEscolaMatricula($object->aluno_pessoa_escola_matricula);
			$this->setAlunoPessoaEscolaPessoaFisicaPessoaId($object->aluno_pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setQuestaoId($object->questao_id);
			$this->setInicio($object->inicio);
			$this->setTempoResolucao($object->tempo_resolucao);
			$this->setResposta($object->resposta);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
