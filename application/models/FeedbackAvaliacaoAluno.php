<?php
/**
 * Modelo da classe FeedbackAvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class FeedbackAvaliacaoAluno extends DefaultObject {
	protected $_name = 'feedback_avaliacao_aluno';
	private $id;
	private $feedbackAvaliacaoAlternativaId;
	private $avaliacaoAlunoId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getFeedbackAvaliacaoAlternativaId(){return $this->feedbackAvaliacaoAlternativaId;}
	public function setFeedbackAvaliacaoAlternativaId($var){$this->feedbackAvaliacaoAlternativaId = $var;}
	
	public function getAvaliacaoAlunoId(){return $this->avaliacaoAlunoId;}
	public function setAvaliacaoAlunoId($var){$this->avaliacaoAlunoId = $var;}

	public function insert(){
		$array = array
			(
			'feedback_avaliacao_alternativa_id' => $this->getFeedbackAvaliacaoAlternativaId(),
			'avaliacao_aluno_id' => $this->getAvaliacaoAlunoId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'feedback_avaliacao_alternativa_id' => $this->getFeedbackAvaliacaoAlternativaId(),
			'avaliacao_aluno_id' => $this->getAvaliacaoAlunoId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setFeedbackAvaliacaoAlternativaId($object->feedback_avaliacao_alternativa_id);
			$this->setAvaliacaoAlunoId($object->avaliacao_aluno_id);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function toString(){
		$str = $this->getFeedbackAvaliacaoAlternativaId()." - ".$this->getAvaliacaoAlunoId();
		return $str;
	}
}
