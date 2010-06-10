<?php
/**
 * Modelo da classe Feedbackavaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class Feedbackavaliacao extends DAO {
	protected $_name = 'feedbackavaliacao';
	private $id;
	private $descricao;
	private $alternativas;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDescricao(){return $this->descricao;}
	public function setDescricao($var){$this->descricao = $var;}
	
	public function getAlternativas(){
		if(empty($this->alternativas))
			$this->setAlternativas(new ListaAlternativa());
		return $this->alternativas;
	}
	public function setAlternativas($var){
		if(empty($var))
			$var = new ListaAlternativa();
		$this->alternativas = $var;
	}

	public function insert(){
		$array = array
			(
			'descricao' => $this->getDescricao()
			);
		$return = parent::insert($array);
		
		if($return){
			$this->setId($return);
			
			foreach($this->getAlternativas()->getAlternativas() as $linha){
				$linha->setFeedbackavaliacaoId($this->getId());
				$linha->insert();		
			}
		}
		
		return $return;
	}
	public function update(){
		$array = array
			(
			'descricao' => $this->getDescricao()
			);

		$return = parent::update($array,"id = '".$this->getId()."'");
		$ids = " ";
		foreach($this->getAlternativas()->getAlternativas() as $linha){
			// update
			if($linha->getId()){
				$ids .= $linha->getId().",";
			}else{//insert
				$linha->setFeedbackavaliacaoId($this->getId());
				$id = $linha->insert();
				if($id){
					$linha->setId($id);
					$ids .= $linha->getId().",";
				}
			}
		}
		$ids = trim(substr($ids,0,-1));
		$tmp = $this->getAdapter();
		$tmp->delete("questao_alternativa","`id` NOT IN (".$ids.") AND `questao_id` = '".$this->getId()."'");
		
		return $return;
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setDescricao($object->descricao);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
			
			$list = $this->getAdapter()->fetchAll("SELECT * FROM `feedback_avaliacao_alternativa` WHERE `feedbackAvaliacao_id` = '".$this->getId()."'");
			$this->setAlternativas(new ListaAlternativa());
			foreach($list as $linha){
				$alternativa = new FeedbackAvaliacaoAlternativa();
				$alternativa->load($linha['id']);
				
				$this->getAlternativas()->addAlternativa($alternativa);
			}
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
