<?php
/**
 * Modelo da classe PessoaJuridica
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("Pessoa.php");

class PessoaJuridica extends Pessoa {
	protected $_name = 'pessoa_juridica';
	private $pessoaId;
	private $cnpj;
	private $nomeFantasia;
	private $inscricaoEstadual;
	private $inscricaoMunicipal;

	public function getPessoaId(){return $this->pessoaId;}
	public function setPessoaId($var){
		$this->pessoaId = $var;
		$this->setId($var);
	}

	public function getCnpj(){return $this->cnpj;}
	public function setCnpj($var){$this->cnpj = $var;}

	public function getNomeFantasia(){return $this->nomeFantasia;}
	public function setNomeFantasia($var){$this->nomeFantasia = $var;}

	public function getInscricaoEstadual(){return $this->inscricaoEstadual;}
	public function setInscricaoEstadual($var){$this->inscricaoEstadual = $var;}

	public function getInscricaoMunicipal(){return $this->inscricaoMunicipal;}
	public function setInscricaoMunicipal($var){$this->inscricaoMunicipal = $var;}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO
		
		$this->_name = "pessoa_juridica"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA JURIDICA
		$pJuridica = NULL;
		
		if($id){ // EM CASO DE SUCESSO INSERE A PESSOA JURIDICA
			$this->setPessoaId($id);
			
			$array = array
				(
				'pessoa_id' => $this->getPessoaId(),
				'cnpj' => $this->getCnpj(),
				'nome_fantasia' => $this->getNomeFantasia(),
				'inscricao_estadual' => $this->getInscricaoEstadual(),
				'inscricao_municipal' => $this->getInscricaoMunicipal()
				);
			
			$pJuridica = $this->getAdapter();
			$pJuridica = $pJuridica->insert($this->_name,$array);
		}
		return $pJuridica;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS DE PESSOA
		
		$this->_name = "pessoa_juridica"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA JURIDICA
		$array = array
			(
			'cnpj' => $this->getCnpj(),
			'nome_fantasia' => $this->getNomeFantasia(),
			'inscricao_estadual' => $this->getInscricaoEstadual(),
			'inscricao_municipal' => $this->getInscricaoMunicipal()
			);
		$pJuridica = $this->getAdapter();
			
		return $pJuridica->update($this->_name,$array,"pessoa_id = '".$this->getPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA JURIDICA
		
	}
	public function load($id = ""){
		$object = parent::fetchRow("pessoa_id = '".$id."'");
		if($object){
			parent::load($object->pessoa_id);
			
			$this->_name = "pessoa_juridica";
			$this->setPessoaId($object->pessoa_id);
			$this->setCnpj($object->cnpj);
			$this->setNomeFantasia($object->nome_fantasia);
			$this->setInscricaoEstadual($object->inscricao_estadual);
			$this->setInscricaoMunicipal($object->inscricao_municipal);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
