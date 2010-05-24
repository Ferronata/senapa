<?php
/**
 * Modelo da classe Disciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class Disciplina extends DAO {
	protected $_name = 'disciplina';
	private $id;
	private $codigo;
	private $nome;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getCodigo(){return $this->codigo;}
	public function setCodigo($var){$this->codigo = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'codigo' => $this->getCodigo(),
			'nome' => $this->getNome()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'codigo' => $this->getCodigo(),
			'nome' => $this->getNome()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setCodigo($object->codigo);
			$this->setNome($object->nome);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
