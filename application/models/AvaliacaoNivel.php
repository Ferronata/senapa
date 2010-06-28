<?php
/**
 * Modelo da classe AvaliacaoNivel
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class AvaliacaoNivel extends DefaultObject {
	protected $_name = 'avaliacao_nivel';
	private $id;
	private $avaliacaoId;
	private $nivel;
	private $dataNivelamento;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAvaliacaoId(){return $this->avaliacaoId;}
	public function setAvaliacaoId($var){$this->avaliacaoId = $var;}

	public function getNivel(){return $this->nivel;}
	public function setNivel($var){$this->nivel = $var;}

	public function getDataNivelamento(){return $this->dataNivelamento;}
	public function setDataNivelamento($var){$this->dataNivelamento = $var;}

	public function insert(){
		$array = array
			(
			'avaliacao_id' => $this->getAvaliacaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		$id = parent::insert($array);
		$this->setId($id);
		return $id;
	}
	public function update(){
		$array = array
			(
			'avaliacao_id' => $this->getAvaliacaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAvaliacaoId($object->avaliacao_id);
			$this->setNivel($object->nivel);
			$this->setDataNivelamento($object->data_nivelamento);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
