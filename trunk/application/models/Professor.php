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
	public function setPessoaEscolaPessoaFisicaPessoaId($var){$this->pessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getPessoaEscolaMatricula(){return $this->pessoaEscolaMatricula;}
	public function setPessoaEscolaMatricula($var){$this->pessoaEscolaMatricula = $var;}

	public function getFormacao(){return $this->formacao;}
	public function setFormacao($var){$this->formacao = $var;}

	public function getAreaAtuacao(){return $this->areaAtuacao;}
	public function setAreaAtuacao($var){$this->areaAtuacao = $var;}

	public function insert(){
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'formacao' => $this->getFormacao(),
			'area_atuacao' => $this->getAreaAtuacao()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'formacao' => $this->getFormacao(),
			'area_atuacao' => $this->getAreaAtuacao()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setFormacao($object->formacao);
			$this->setAreaAtuacao($object->area_atuacao);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
