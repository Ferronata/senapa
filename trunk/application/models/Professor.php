<?php
/**
 * Modelo da classe Professor
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("PessoaEscola.php");

class Professor extends PessoaEscola {
	protected $_name = 'professor';
	private $pessoaEscolaPessoaFisicaPessoaId;
	private $pessoaEscolaMatricula;
	private $formacao;
	private $areaAtuacao;

	public function getPessoaEscolaPessoaFisicaPessoaId(){return $this->pessoaEscolaPessoaFisicaPessoaId;}
	public function setPessoaEscolaPessoaFisicaPessoaId($var){
		$this->pessoaEscolaPessoaFisicaPessoaId = $var;
		$this->setPessoaFisicaPessoaId($var);
	}

	public function getPessoaEscolaMatricula(){return $this->pessoaEscolaMatricula;}
	public function setPessoaEscolaMatricula($var){
		$this->pessoaEscolaMatricula = $var;
		$this->setMatricula($var);
	}

	public function getFormacao(){return $this->formacao;}
	public function setFormacao($var){$this->formacao = $var;}

	public function getAreaAtuacao(){return $this->areaAtuacao;}
	public function setAreaAtuacao($var){$this->areaAtuacao = $var;}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO
		
		$this->_name = "professor"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA ESCOLA
		$pProfessor = NULL;
		
		if($id){ // EM CASO DE SUCESSO INSERE A PESSOA ESCOLA
			$pProfessor = $this->getAdapter();
			$this->setPessoaEscolaPessoaFisicaPessoaId($id);
			
			$array = array
				(
				'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
				'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
				'formacao' => $this->getFormacao(),
				'area_atuacao' => $this->getAreaAtuacao()
				);
			$pProfessor = $pProfessor->insert($this->_name ,$array);
		}
		return $pProfessor;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS
		
		$this->_name = 'professor';
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'formacao' => $this->getFormacao(),
			'area_atuacao' => $this->getAreaAtuacao()
			);
		$pProfessor = $this->getAdapter();
			
		return $pProfessor->update($this->_name,$array,"pessoa_escola_pessoa_fisica_pessoa_id = '".$this->getPessoaEscolaPessoaFisicaPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA FISICA
	}
	public function load($id = ""){
		$this->_name = 'professor';
		
		$object = parent::fetchRow("pessoa_escola_matricula = '".$id."'");
		if($object){
			parent::load($object->pessoa_escola_pessoa_fisica_pessoa_id);
			
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setFormacao($object->formacao);
			$this->setAreaAtuacao($object->area_atuacao);
		}
		return $object;
	}
	public function delete(){
		return parent::delete();
	}
}
