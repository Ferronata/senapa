<?php
/**
 * Modelo da classe NivelAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class NivelAvaliacao extends DefaultObject {
	protected $_name = 'nivel_avaliacao';
	private $id;
	private $nivel;
	private $por;
	private $professorAvaliacaoId;
	private $dataNivelamento;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}
	
	public function getNivel(){return $this->nivel;}
	public function setNivel($var){$this->nivel = $var;}
	
	public function getPor(){return $this->por;}
	public function setPor($var){$this->por = $var;}

	public function getProfessorAvaliacaoId(){return $this->professorAvaliacaoId;}
	public function setProfessorAvaliacaoId($var){$this->professorAvaliacaoId = $var;}

	public function getDataNivelamento(){return $this->dataNivelamento;}
	public function setDataNivelamento($var){$this->dataNivelamento = $var;}

	public function insert(){
		$array = array
			(
			'nivel' => $this->getNivel(),
			'professor_avaliacao_id' => $this->getProfessorAvaliacaoId(),
			'por' => $this->getPor(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		$id = parent::insert($array);
		$this->setId($id);
		return $id;
	}
	public function update(){
		$array = array
			(
			'nivel' => $this->getNivel(),
			'professor_avaliacao_id' => $this->getProfessorAvaliacaoId(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setNivel($object->nivel);
			$this->setPor($object->por);
			$this->setProfessorAvaliacaoId($object->professor_avaliacao_id);
			$this->setDataNivelamento($object->data_nivelamento);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
