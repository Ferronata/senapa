<?php
/**
 * Modelo da classe AlunoResolveQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("DefaultObject.php");

class AlunoResolveQuestao extends DefaultObject {
	protected $_name = 'aluno_resolve_questao';
	
	private $id;
	private $pessoaId;
	private $avaliacaoId;
	private $disciplinaId;
	private $questaoId;
	private $respostaId;
	private $inicio;
	private $fim;
	private $reinicio;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}
	
	public function getPessoaId(){return $this->pessoaId;}
	public function setPessoaId($var){$this->pessoaId = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}
	
	public function getDisciplinaId(){return $this->disciplinaId;}
	public function setDisciplinaId($var){$this->disciplinaId = $var;}
	
	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}
	
	public function getRespostaId(){return $this->respostaId;}
	public function setRespostaId($var){$this->respostaId = $var;}
	
	public function getInicio(){return $this->inicio;}
	public function setInicio($var){$this->inicio = $var;}
	
	public function getFim(){return $this->fim;}
	public function setFim($var){$this->fim = $var;}
	
	public function getReinicio(){return $this->reinicio;}
	public function setReinicio($var){$this->reinicio = $var;}
	
	public function insert(){
		$array = array
			(
			'pessoa_id' => $this->getPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'questao_id' => $this->getQuestaoId(),
			'questao_alternativa_id' => $this->getRespostaId(),
			'inicio' => $this->getInicio(),
			'fim' => $this->getFim()
			);
		$return = parent::insert($array);
		$this->setId($return);
		return $return;
	}
	public function update(){
		$array = array
			(
			'pessoa_id' => $this->getPessoaId(),
			'avaliacao_id' => $this->getAvaliacaoId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'questao_id' => $this->getQuestaoId(),
			'questao_alternativa_id' => $this->getRespostaId(),
			'inicio' => $this->getInicio(),
			'fim' => $this->getFim()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("`id` = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setPessoaId($object->pessoa_id);
			$this->setAvaliacaoId($object->avaliacao_id);
			$this->setDisciplinaId($object->disciplina_id);
			$this->setQuestaoId($object->questao_id);
			$this->setRespostaId($object->questao_alternativa_id);
			$this->setInicio($object->inicio);
			$this->setFim($object->fim);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("`id` = '".$this->getId()."'");
	}
	public function toString(){
		$str = "id:".$this->getId()."; pessoa:".$this->getPessoaId()."; avaliacao:".$this->getAvaliacaoId()."; disciplina:".$this->getDisciplinaId()."; questao:".$this->getQuestaoId()."; resposta".$this->getRespostaId()."; inicio:".$this->getInicio()."; fim:".$this->getFim();
		return $str;
	}
}