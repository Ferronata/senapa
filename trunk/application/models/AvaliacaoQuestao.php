<?php
/**
 * Modelo da classe AvaliacaoQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class AvaliacaoQuestao extends DefaultObject {
	protected $_name = 'avaliacao_questao';
	private $id;
	private $questaoId;
	private $avaliacaoId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'avaliacao_id' => $this->getAvaliacaoId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'avaliacao_id' => $this->getAvaliacaoId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setQuestaoId($object->questao_id);
			$this->setAvaliacaoId($object->avaliacao_id);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
