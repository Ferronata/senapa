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
	public function setPessoaId($var){
		$this->pessoaId = $var;
		$this->setId($var);
	}

	public function getCpf(){return $this->cpf;}
	public function setCpf($var){$this->cpf = $var;}

	public function getDataNascimento(){return $this->dataNascimento;}
	public function setDataNascimento($var){$this->dataNascimento = $var;}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO
		
		$this->_name = "pessoa_fisica"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA FISICA
		$pFisica = NULL;
		
		if($id){ // EM CASO DE SUCESSO INSERE A PESSOA FISICA
			$pFisica = $this->getAdapter();
			$this->setPessoaId($id);
			$array = array
				(
				'pessoa_id' => $this->getPessoaId(),
				'cpf' => $this->getCpf(),
				'data_nascimento' => $this->getDataNascimento()
				);
			$pFisica->insert($this->_name ,$array);
		}
		return $id;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS DE PESSOA
		
		$this->_name = "pessoa_fisica"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA JURIDICA
		$array = array
			(
			'cpf' => $this->getCpf(),
			'data_nascimento' => $this->getDataNascimento()
			);
		$pFisica = $this->getAdapter();
			
		return $pFisica->update($this->_name,$array,"pessoa_id = '".$this->getPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA FISICA
		
	}
	public function load($id = ""){
		$this->_name = 'pessoa_fisica';
		$object = parent::fetchRow("pessoa_id = '".$id."'");
		if($object){
			parent::load($id);
			
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
