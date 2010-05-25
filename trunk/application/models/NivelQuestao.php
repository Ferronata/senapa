<?php
/**
 * Modelo da classe NivelQuestao
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class NivelQuestao extends DefaultObject {
	protected $_name = 'nivel_questao';
	private $id;
	private $questaoId;
	private $nivel;
	private $dataNivelamento;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getNivel(){return $this->nivel;}
	public function setNivel($var){$this->nivel = $var;}

	public function getDataNivelamento(){return $this->dataNivelamento;}
	public function setDataNivelamento($var){$this->dataNivelamento = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setQuestaoId($object->questao_id);
			$this->setNivel($object->nivel);
			$this->setDataNivelamento($object->data_nivelamento);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function lastRegister($questao_id){
		$object = parent::fetchRow("`questao_id` = '".$questao_id."'","data_nivelamento DESC");
		if($object){
			$this->setId($object->id);
			return $this->load($this->getId());
		}
		return NULL;
	}
}
