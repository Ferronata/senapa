<?php
/**
 * Modelo da classe QuestaoAlternativa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class QuestaoAlternativa extends DAO {
	protected $_name = 'questao_alternativa';
	private $id;
	private $questaoId;
	private $descricao;
	private $resposta;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getDescricao(){return $this->descricao;}
	public function setDescricao($var){$this->descricao = $var;}
	
	public function isResposta(){
		if(empty($this->resposta))
			$this->setResposta(false);
		return $this->resposta;
	}
	public function setResposta($var){$this->resposta = $var;}

	public function insert(){
		$array = array
			(
			'questao_id' => $this->getQuestaoId(),
			'descricao' => $this->getDescricao()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'descricao' => $this->getDescricao()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setQuestaoId($object->questao_id);
			$this->setDescricao($object->descricao);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function toString(){
		$str = "id:".$this->getId()." - descricao:".$this->getDescricao()." - R:".$this->isResposta();
		return $str;
	}
}
