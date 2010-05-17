<?php
/**
 * Modelo da classe Aluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

class Aluno extends Zend_Db_Table {
	protected $_name = 'aluno';
	private $pessoaEscolaPessoaFisicaPessoaId;
	private $pessoaEscolaMatricula;
	private $areaInterece;

	public function getPessoaEscolaPessoaFisicaPessoaId(){return $this->pessoaEscolaPessoaFisicaPessoaId;}
	public function setPessoaEscolaPessoaFisicaPessoaId($var){$this->pessoaEscolaPessoaFisicaPessoaId = $var;}

	public function getPessoaEscolaMatricula(){return $this->pessoaEscolaMatricula;}
	public function setPessoaEscolaMatricula($var){$this->pessoaEscolaMatricula = $var;}

	public function getAreaInterece(){return $this->areaInterece;}
	public function setAreaInterece($var){$this->areaInterece = $var;}

	public function insert(){
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'area_interece' => $this->getAreaInterece()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'area_interece' => $this->getAreaInterece()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load(){
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
