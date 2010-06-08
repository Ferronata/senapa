<?php
/**
 * Modelo da classe NivelQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DefaultObject.php';

class NivelQuestao extends DefaultObject {
	protected $_name = 'nivel_questao';
	private $id;
	private $questaoId;
	private $nivel;
	private $dataNivelamento;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getQuestaoId(){return $this->questaoId;}
	public function setQuestaoId($var){$this->questaoId = $var;}

	public function getNivel(){return $this->nivel;}
	public function setNivel($var){$this->nivel = $var;}

	public function getDataNivelamento(){return $this->dataNivelamento;}
	public function setDataNivelamento($var){$this->dataNivelamento = $var;}
	
	public function isExiste(){return $this->existe;}
	public function setExiste($var){$this->existe = $var;}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::insert($array);
	}
	public function update(){
		$array = array
			(
			'id' => $this->getId(),
			'questao_id' => $this->getQuestaoId(),
			'nivel' => $this->getNivel(),
			'data_nivelamento' => $this->getDataNivelamento()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setQuestaoId($object->questao_id);
			$this->setNivel($object->nivel);
			$this->setDataNivelamento($object->data_nivelamento);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function lastRegister($questao_id){
		$object = $this->fetchRow("`questao_id` = '".$questao_id."'","data_nivelamento DESC, id");
		if($object){
			$this->setId($object->id);
			return $this->load($this->getId());
		}
		return NULL;
	}
	public function find($lista = array(),$nivelQuestao){
		for($i =0; $i<sizeof($lista); $i++)
			if($lista[$i]->getNivel() == $nivelQuestao->getNivel())
				return $i;
		return -1;
	}
	public function existe($lista = array(),$nivelQuestao){
		if($this->find($lista,$nivelQuestao)>=0)
			return true;
		return false;
	}
	public function ordena($lista = array()){
		for($j =0; $j<sizeof($lista); $j++){
			$aux = 0;
			for($i =1; $i<(sizeof($lista)-$j); $i++){
				if($lista[$aux]->getNivel() > $lista[$i]->getNivel()){
					$tmp = $lista[$i];
					$lista[$i] = $lista[$aux];
					$lista[$aux] = $tmp;
					$aux = $i;
				}
			}
		}
		return $lista;
	}
}
