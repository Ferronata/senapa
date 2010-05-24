<?php
/**
 * Modelo da classe Assunto
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once 'DAO.php';

class Assunto extends DAO {
	protected $_name = 'assunto';
	private $id;
	private $nome;
	private $disciplinas;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}
	
	public function getDisciplinas(){
		if(empty($this->disciplinas))
			$this->setDisciplinas("");
		return $this->disciplinas;
	}
	public function setDisciplinas($var){
		if(empty($var))
			$var = new ListaDisciplina();
		$this->disciplinas = $var;
	}

	public function insert(){
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome()
			);
		$result = parent::insert($array);
		if($result){
			$disc 	= new DisciplinaAssunto();
			foreach($this->getDisciplinas()->getDisciplinas() as $disciplina){
				$disc->setAssuntoId($result);
				$disc->setDisciplinaId($disciplina->getId());
				$disc->setDataAtribuicao(date("Y-m-d"));
				
				$disc->insert(); // INSERE SE NÃO EXISTE OU ATUALIZA EM CASO DE EXISTENCIA
			}
		}
		return $result;
	}
	public function update(){
		$where = 
		"
			`assunto_id` = '".$this->getId()."'
		";
		
		$tmp 	= $this->getAdapter();		
		$tmp->delete("disciplina_assunto",$where);
		
		$disc 	= new DisciplinaAssunto();
		foreach($this->getDisciplinas()->getDisciplinas() as $disciplina){
			$disc->setAssuntoId($this->getId());
			$disc->setDisciplinaId($disciplina->getId());
			$disc->setDataAtribuicao(date("Y-m-d"));
			
			$disc->insert(); // INSERE SE NÃO EXISTE OU ATUALIZA EM CASO DE EXISTENCIA
		}
		
		$array = array
			(
			'id' => $this->getId(),
			'nome' => $this->getNome()
			);
		return parent::update($array,"id = '".$this->getId()."'");
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setNome($object->nome);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
			
			$disciplina = new Disciplina();
			$disciplinas = new ListaDisciplina();
			$lista = $disciplina->fetchAll("`date_delete` IS NULL  AND `id` IN (SELECT `disciplina_id` FROM `disciplina_assunto` WHERE `assunto_id` = '".$this->getId()."' )","nome");
			
			foreach($lista as $linha){
				$tmp = new Disciplina();
				$tmp->load($linha->id);
				$disciplinas->addDisciplina($tmp);
			}
			
			$this->setDisciplinas($disciplinas);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
