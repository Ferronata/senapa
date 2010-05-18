<?php
/**
 * Modelo da classe AvaliacaoSituacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class AvaliacaoSituacao extends DAO {
	protected $_name = 'avaliacao_situacao';
	private $id;
	private $nome;
	private $status;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}

	public function getStatus(){return $this->status;}
	public function setStatus($var){$this->status = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'status' => $this->getStatus()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'status' => $this->getStatus()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setNome($object->nome);
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
