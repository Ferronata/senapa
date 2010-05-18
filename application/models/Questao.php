<?php
/**
 * Modelo da classe Questao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class Questao extends DAO {
	protected $_name = 'questao';
	private $id;
	private $descricao;
	private $resposta;
	private $descricaoResposta;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDescricao(){return $this->descricao;}
	public function setDescricao($var){$this->descricao = $var;}

	public function getResposta(){return $this->resposta;}
	public function setResposta($var){$this->resposta = $var;}

	public function getDescricaoResposta(){return $this->descricaoResposta;}
	public function setDescricaoResposta($var){$this->descricaoResposta = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'descricao' => $this->getDescricao(),
			'resposta' => $this->getResposta(),
			'descricao_resposta' => $this->getDescricaoResposta()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'descricao' => $this->getDescricao(),
			'resposta' => $this->getResposta(),
			'descricao_resposta' => $this->getDescricaoResposta()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setDescricao($object->descricao);
			$this->setResposta($object->resposta);
			$this->setDescricaoResposta($object->descricao_resposta);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
		}
		return parent::fetchRow("id = '".$this->getId()."'");
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
