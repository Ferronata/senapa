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
	private $nivel;
	private $professorAvaliacaoId;
	private $dataNivelamento;

	public function getNivel(){return $this->nivel;}
	public function setNivel($var){$this->nivel = $var;}

	public function getProfessorAvaliacaoId(){return $this->professorAvaliacaoId;}
	public function setProfessorAvaliacaoId($var){$this->professorAvaliacaoId = $var;}

	public function getDataNivelamento(){return $this->dataNivelamento;}
	public function setDataNivelamento($var){$this->dataNivelamento = $var;}

	public function insert(){
		$array = array
			(
			'nivel' => $this->getNivel(),
			'professor_avaliacao_id' => $this->getProfessorAvaliacaoId(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::insert($array);
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
			$this->setNivel($object->nivel);
			$this->setProfessorAvaliacaoId($object->professor_avaliacao_id);
			$this->setDataNivelamento($object->data_nivelamento);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
