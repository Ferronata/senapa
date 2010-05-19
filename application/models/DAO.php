<?php
/**
 * Modelo da classe DAO
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("DefaultObject.php");

class DAO extends DefaultObject{
	private $dateCreate;
	private $dateUpdate;
	private $dateDelete;
	
	public function getDateCreate(){return $this->dateCreate;}
	public function setDateCreate($var){$this->dateCreate = $var;}

	public function getDateUpdate(){return $this->dateUpdate;}
	public function setDateUpdate($var){$this->dateUpdate = $var;}

	public function getDateDelete(){return $this->dateDelete;}
	public function setDateDelete($var){$this->dateDelete = $var;}
	
	public function insert($array, $where){
		$array['date_create'] = date("Y-m-d H:i:s");
		return parent::insert($array,$where);
	}
	
	public function update($array, $where){
		$array['date_update'] = date("Y-m-d H:i:s");
		return parent::update($array,$where);
	}
	public function delete($where){
		if(!$this->getDateDelete()){
			$array = array('date_delete' => date("Y-m-d H:i:s"));
			return parent::update($array,$where);
		}
		return NULL;
	}
}