<?php
/**
 * Modelo da classe FeedbackAvaliacaoAlternativa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class FeedbackAvaliacaoAlternativa extends DAO {
	protected $_name = 'feedback_avaliacao_alternativa';
	private $id;
	private $feedbackavaliacaoId;
	private $descricao;
	private $status;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getFeedbackavaliacaoId(){return $this->feedbackavaliacaoId;}
	public function setFeedbackavaliacaoId($var){$this->feedbackavaliacaoId = $var;}

	public function getDescricao(){return $this->descricao;}
	public function setDescricao($var){$this->descricao = $var;}

	public function getStatus(){return $this->status;}
	public function setStatus($var){$this->status = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'feedbackAvaliacao_id' => $this->getFeedbackavaliacaoId(),
			'descricao' => $this->getDescricao(),
			'status' => $this->getStatus()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'feedbackAvaliacao_id' => $this->getFeedbackavaliacaoId(),
			'descricao' => $this->getDescricao(),
			'status' => $this->getStatus()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setFeedbackavaliacaoId($object->feedbackAvaliacao_id);
			$this->setDescricao($object->descricao);
			$this->setStatus($object->status);
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
