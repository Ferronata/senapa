<?php
/**
 * Modelo da classe AssuntoQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class AssuntoQuestao extends DefaultObject {
	protected $_name = 'assunto_questao';
	private $id;
	private $questaoId;
	private $assuntoId;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getAssuntoId(){return $this->assuntoId;}
	public function setAssuntoId($var){$this->assuntoId = $var;}

	public function insert(){
		$array = array
			(
			'questao_id' => $this->getQuestaoId(),
			'assunto_id' => $this->getAssuntoId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'assunto_id' => $this->getAssuntoId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setQuestaoId($object->questao_id);
			$this->setAssuntoId($object->assunto_id);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function load2Questao($questao_id){
		$object = parent::fetchRow("`questao_id` = '".$questao_id."'");
		if($object)
			return $this->load($object->id);
		return NULL;
	}
}
