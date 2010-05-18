<?php
/**
 * Modelo da classe Aluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'PessoaEscola.php';

class Aluno extends PessoaEscola {
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
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setAreaInterece($object->area_interece);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
