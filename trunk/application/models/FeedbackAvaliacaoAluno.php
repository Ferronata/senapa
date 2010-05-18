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
	private $alunoAvaliacaoId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getFeedbackAvaliacaoAlternativaId(){return $this->feedbackAvaliacaoAlternativaId;}
	public function setFeedbackAvaliacaoAlternativaId($var){$this->feedbackAvaliacaoAlternativaId = $var;}

	public function getAlunoAvaliacaoId(){return $this->alunoAvaliacaoId;}
	public function setAlunoAvaliacaoId($var){$this->alunoAvaliacaoId = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'feedback_avaliacao_alternativa_id' => $this->getFeedbackAvaliacaoAlternativaId(),
			'aluno_avaliacao_id' => $this->getAlunoAvaliacaoId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'feedback_avaliacao_alternativa_id' => $this->getFeedbackAvaliacaoAlternativaId(),
			'aluno_avaliacao_id' => $this->getAlunoAvaliacaoId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setFeedbackAvaliacaoAlternativaId($object->feedback_avaliacao_alternativa_id);
			$this->setAlunoAvaliacaoId($object->aluno_avaliacao_id);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
