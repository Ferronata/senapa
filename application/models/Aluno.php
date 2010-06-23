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
	public function setPessoaEscolaPessoaFisicaPessoaId($var){
		$this->pessoaEscolaPessoaFisicaPessoaId = $var;
		$this->setPessoaFisicaPessoaId($var);
	}

	public function getPessoaEscolaMatricula(){return $this->pessoaEscolaMatricula;}
	public function setPessoaEscolaMatricula($var){
		$this->pessoaEscolaMatricula = $var;
		$this->setMatricula($var);
	}

	public function getAreaInterece(){return $this->areaInterece;}
	public function setAreaInterece($var){$this->areaInterece = $var;}

	public function insert(){
		$id = parent::insert(); // INSERE UMA NOVA PESSOA NO BANCO
		
		$this->_name = "aluno"; // INFORMA AO OBJETO QUE A TABELA RELACIONADA VOLTA A SER ALUNO
		$object = NULL;
		
		if($id){ // EM CASO DE SUCESSO INSERE A ALUNO
			$object = $this->getAdapter();
			$this->setPessoaEscolaPessoaFisicaPessoaId($id);
			$array = array
				(
				'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
				'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
				'area_interece' => $this->getAreaInterece()
				);
			$object = $object->insert($this->_name ,$array);
		}
		return $object;
	}
	public function update(){
		parent::update(); // ATUALIZA OS DADOS
		
		$this->_name = 'aluno';
		$array = array
			(
			'pessoa_escola_pessoa_fisica_pessoa_id' => $this->getPessoaEscolaPessoaFisicaPessoaId(),
			'pessoa_escola_matricula' => $this->getPessoaEscolaMatricula(),
			'area_interece' => $this->getAreaInterece()
			);
		$object = $this->getAdapter();
			
		return $object->update($this->_name,$array,"pessoa_escola_pessoa_fisica_pessoa_id = '".$this->getPessoaEscolaPessoaFisicaPessoaId()."'");  // ATUALIZA OS DADOS DE PESSOA FISICA
	}
	public function load($id = ""){
		$this->_name = 'aluno';
		
		$object = parent::fetchRow("pessoa_escola_matricula = '".$id."'");
		if($object){
			parent::load($object->pessoa_escola_pessoa_fisica_pessoa_id);
			
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setAreaInterece($object->area_interece);
		}
		return $object;
	}
	public function loadId($id = ""){
		$this->_name = 'aluno';
		
		$object = parent::fetchRow("pessoa_escola_pessoa_fisica_pessoa_id = '".$id."'");
		if($object){
			parent::load($object->pessoa_escola_pessoa_fisica_pessoa_id);
			
			$this->setPessoaEscolaPessoaFisicaPessoaId($object->pessoa_escola_pessoa_fisica_pessoa_id);
			$this->setPessoaEscolaMatricula($object->pessoa_escola_matricula);
			$this->setAreaInterece($object->area_interece);
		}
		return $object;
	}
	public function delete(){
		return parent::delete();
	}
	public function getAvaliacoes(){
		$avaliacoes = array();
		if($this->getId()){
			$avaliacao = new Avaliacao();
			foreach($this->getDisciplinas()->getDisciplinas() as $linha){
				$now 		= date("Y-m-d H:i:s");
				$situacao = $this->ENUM('A_S_ANDAMENTO');
				
				$where = 
				"			
				CONCAT(`data_inicio`,' ',`hora_iniccio`) <= '".$now."' AND 
				CONCAT(`data_fim`,' ',`hora_fim`) > '".$now."' AND
				`status` = TRUE AND 
				`date_delete` IS NULL AND 
				`avaliacao_situacao_id` = '".$situacao['id']."' AND 				
				`id` IN 
					(
						SELECT `avaliacao_id` FROM `avaliacao_questao` WHERE `questao_id` IN 
							(
								SELECT `questao_id` FROM `assunto_questao` WHERE `assunto_id` IN 
									(
										SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$linha->getId()."'
									)
							)
					)
				";
				$tmp = $avaliacao->fetchAll($where,array('data_inicio','hora_iniccio','data_fim','hora_fim'));
				foreach($tmp as $linhaAvaliacao){
					$tmpAvaliacao = new Avaliacao();
					$tmpAvaliacao->load($linhaAvaliacao->id);
					
					$avaliacoes[] = $tmpAvaliacao;
				}
			}
		}
		return $avaliacoes;
	}
}
