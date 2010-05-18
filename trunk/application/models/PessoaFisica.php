<?php
/**
 * Modelo da classe PessoaFisica
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("Pessoa.php");

class PessoaFisica extends Pessoa {
	protected $_name = 'pessoa_fisica';
	private $pessoaId;
	private $cpf;
	private $dataNascimento;

	public function getPessoaId(){return $this->pessoaId;}
	public function setPessoaId($var){$this->pessoaId = $var;}

	public function getCpf(){return $this->cpf;}
	public function setCpf($var){$this->cpf = $var;}

	public function getDataNascimento(){return $this->dataNascimento;}
	public function setDataNascimento($var){$this->dataNascimento = $var;}

	public function insert(){
		$array = array
			(
			'pessoa_id' => $this->getPessoaId(),
			'cpf' => $this->getCpf(),
			'data_nascimento' => $this->getDataNascimento()
			);
		
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'cpf' => $this->getCpf(),
			'data_nascimento' => $this->getDataNascimento()
			);
		$this->setId($this->getPessoaId());
		
		$update = Zend_Db_Table::getDefaultAdapter();		
		$update->update($this->_name,$array,"pessoa_id = '".$this->getPessoaId()."'");
		
		$pessoa = new Pessoa();
		$pessoa->load($this->getPessoaId());
		$pessoa->update();
		
		return $pessoa;
	}
	public function load($id = ""){
		$object = parent::fetchRow("pessoa_id = '".$id."'");
		if($object){
			$this->setPessoaId($object->pessoa_id);
			$this->setCpf($object->cpf);
			$this->setDataNascimento($object->data_nascimento);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
