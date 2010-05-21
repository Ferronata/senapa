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
	private $senha;

	public function getMatricula(){return $this->matricula;}
	public function setMatricula($var){$this->matricula = $var;}

	public function getPessoaFisicaPessoaId(){return $this->pessoaFisicaPessoaId;}
	public function setPessoaFisicaPessoaId($var){
		$this->pessoaFisicaPessoaId = $var;
		$this->setPessoaId($var);
	}
	
	public function getSenha(){return $this->senha;}
	public function setSenha($var){$this->senha = $var;}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO

		$this->_name = "pessoa_escola"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA ESCOLA
		$pEscola = NULL;
				
		if($id){ // EM CASO DE SUCESSO INSERE A PESSOA ESCOLA
			$pEscola = $this->getAdapter();
			$this->setPessoaFisicaPessoaId($id);
			$array = array
				(
				'matricula' => $this->getMatricula(),
				'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId(),
				'senha' => $this->getSenha()
				);
			$pEscola->insert($this->_name ,$array);
		}
		
		
		return $id;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS
		
		$this->_name = "pessoa_escola";
		$array = array
			(
			'matricula' => $this->getMatricula(),
			'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId(),
			'senha' => $this->getSenha()
			);
		$pEscola = $this->getAdapter();
			
		return $pEscola->update($this->_name,$array,"pessoa_fisica_pessoa_id = '".$this->getPessoaFisicaPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA FISICA
	}
	public function load($id = ""){
		$this->_name = 'pessoa_escola';
		$object = parent::fetchRow("pessoa_fisica_pessoa_id = '".$id."'");
		if($object){
			parent::load($id);
			
			$this->setMatricula($object->matricula);
			$this->setPessoaFisicaPessoaId($object->pessoa_fisica_pessoa_id);
			$this->setSenha($object->senha);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
