<?php
/**
 * Modelo da classe DisciplinaAssunto
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class DisciplinaAssunto extends DefaultObject {
	protected $_name = 'disciplina_assunto';
	private $id;
	private $disciplinaId;
	private $assuntoId;
	private $dataAtribuicao;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDisciplinaId(){return $this->disciplinaId;}
	public function setDisciplinaId($var){$this->disciplinaId = $var;}

	public function getAssuntoId(){return $this->assuntoId;}
	public function setAssuntoId($var){$this->assuntoId = $var;}

	public function getDataAtribuicao(){return $this->dataAtribuicao;}
	public function setDataAtribuicao($var){$this->dataAtribuicao = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'assunto_id' => $this->getAssuntoId(),
			'data_atribuicao' => $this->getDataAtribuicao()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'disciplina_id' => $this->getDisciplinaId(),
			'assunto_id' => $this->getAssuntoId(),
			'data_atribuicao' => $this->getDataAtribuicao()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setDisciplinaId($object->disciplina_id);
			$this->setAssuntoId($object->assunto_id);
			$this->setDataAtribuicao($object->data_atribuicao);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
