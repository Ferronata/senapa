<?php
/**
 * Modelo da classe Papel
 * Data de Cricação - 20/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class Papel extends Zend_Db_Table {
	protected $_name = 'papel';
	private $id;
	private $nome;
	private $status2;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}

	public function getStatus2(){return $this->status2;}
	public function setStatus2($var){$this->status2 = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'status_2' => $this->getStatus2()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'status_2' => $this->getStatus2()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setNome($object->nome);
			$this->setStatus2($object->status_2);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
