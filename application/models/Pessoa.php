<?php
/**
 * Modelo da classe Pessoa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("DAO.php");

class Pessoa extends DAO {
	protected $_name = 'pessoa';
	private $id;
	private $nome;
	private $email;
	private $site;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}

	public function getEmail(){return $this->email;}
	public function setEmail($var){$this->email = $var;}

	public function getSite(){return $this->site;}
	public function setSite($var){$this->site = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'email' => $this->getEmail(),
			'site' => $this->getSite()
			);
		return parent::insert($array);
	}
	public function update(){
		$this->load($this->getId());
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome(),
			'email' => $this->getEmail(),
			'site' => $this->getSite()
			);
		
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setNome($object->nome);
			$this->setEmail($object->email);
			$this->setSite($object->site);
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
