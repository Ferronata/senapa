<?php
/**
 * Modelo da classe PessoaEscola
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */
require_once("PessoaFisica.php");
require_once("ListaDisciplina.php");

class PessoaEscola extends PessoaFisica {
	protected $_name = 'pessoa_escola';
	private $matricula;
	private $pessoaFisicaPessoaId;
	private $senha;
	private $disciplinas;

	public function getMatricula(){return $this->matricula;}
	public function setMatricula($var){$this->matricula = $var;}

	public function getPessoaFisicaPessoaId(){return $this->pessoaFisicaPessoaId;}
	public function setPessoaFisicaPessoaId($var){
		$this->pessoaFisicaPessoaId = $var;
		$this->setPessoaId($var);
	}
	
	public function getSenha(){return $this->senha;}
	public function setSenha($var){$this->senha = $var;}
	
	public function getDisciplinas(){
		if(!$this->disciplinas)
			$this->setDisciplinas(new ListaDisciplina());
		return $this->disciplinas;
	}
	public function setDisciplinas($var){
		if(!$var)
			$var = new ListaDisciplina();
		$this->disciplinas = $var;
	}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO

		$this->_name = "pessoa_escola"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER PESSOA ESCOLA
		$pEscola = NULL;
				
		if($id){ // EM CASO DE SUCESSO INSERE A PESSOA ESCOLA
			$pEscola = $this->getAdapter();
			$this->setPessoaFisicaPessoaId($id);
			$array = array
				(
				'matricula' => $this->getMatricula(),
				'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId(),
				'senha' => $this->getSenha()
				);
			$pEscola->insert($this->_name ,$array);
		}
		if($pEscola){
			$disc = new PessoaEscolaDisciplina();
			foreach($this->getDisciplinas()->getDisciplinas() as $disciplina){
				$disc->setDisciplinaId($disciplina->getId());
				$disc->setPessoaEscolaMatricula($this->getPessoaEscolaMatricula());
				$disc->setPessoaEscolaPessoaFisicaPessoaId($this->getPessoaEscolaPessoaFisicaPessoaId());
				
				$disc->insert();
			}
		}
		
		return $id;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS
		
		$this->_name = "pessoa_escola";
		$array = array
			(
			'matricula' => $this->getMatricula(),
			'pessoa_fisica_pessoa_id' => $this->getPessoaFisicaPessoaId(),
			'senha' => $this->getSenha()
			);
		
		$where = 
		"
			`pessoa_escola_pessoa_fisica_pessoa_id` = '".$this->getPessoaFisicaPessoaId()."' AND 
			`pessoa_escola_matricula` = '".$this->getMatricula()."'
		";
		
		$disc 	= new PessoaEscolaDisciplina();
		$tmp 	= $this->getAdapter();		
		$tmp->delete("pessoa_escola_disciplina",$where);
		
		foreach($this->getDisciplinas()->getDisciplinas() as $disciplina){
			$disc->setDisciplinaId($disciplina->getId());
			$disc->setPessoaEscolaMatricula($this->getPessoaEscolaMatricula());
			$disc->setPessoaEscolaPessoaFisicaPessoaId($this->getPessoaEscolaPessoaFisicaPessoaId());
			
			$disc->insert(); // INSERE SE NÃO EXISTE OU ATUALIZA EM CASO DE EXISTENCIA
		}
		
		$pEscola = $this->getAdapter();
			
		return $pEscola->update($this->_name,$array,"pessoa_fisica_pessoa_id = '".$this->getPessoaFisicaPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA FISICA
	}
	public function load($id = ""){
		$this->_name = 'pessoa_escola';
		$object = parent::fetchRow("pessoa_fisica_pessoa_id = '".$id."'");
		if($object){
			parent::load($id);
			
			$this->setMatricula($object->matricula);
			$this->setPessoaFisicaPessoaId($object->pessoa_fisica_pessoa_id);
			$this->setSenha($object->senha);
			
			$disciplina = new Disciplina();
			$disciplinas = new ListaDisciplina();
			$lista = $disciplina->fetchAll("`date_delete` IS NULL  AND `id` IN (SELECT `disciplina_id` FROM `pessoa_escola_disciplina` WHERE `pessoa_escola_pessoa_fisica_pessoa_id` = '".$this->getId()."' )","nome");
			
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
