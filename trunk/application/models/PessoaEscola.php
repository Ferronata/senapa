<?php
/**
 * Modelo da classe PessoaEscola
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("PessoaFisica.php");

class PessoaEscola extends PessoaFisica {
	protected $_name = 'pessoa_escola';
	private $matricula;
	private $pessoaFisicaPessoaId;

	public function getMatricula(){return $this->matricula;}
	public function setMatricula($var){$this->matricula = $var;}

	public function getPessoaFisicaPessoaId(){return $this->pessoaFisicaPessoaId;}
	public function setPessoaFisicaPessoaId($var){$this->pessoaFisicaPessoaId = $var;}

	public function insert(){
		$array = array
			(
			'matricula' => $this->getMatricula(),
			'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'matricula' => $this->getMatricula(),
			'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setMatricula($object->matricula);
			$this->setPessoaFisicaPessoaId($object->pessoa_fisica_pessoa_id);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
