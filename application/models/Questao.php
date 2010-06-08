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
require_once 'ListaAlternativa.php';
require_once 'AssuntoQuestao.php';
require_once 'NivelQuestao.php';
require_once 'Disciplina.php';

class Questao extends DAO {
	protected $_name = 'questao';
	private $id;
	private $descricao;
	private $resposta;
	private $descricaoResposta;
	
	private $alternativas;
	private $assuntoQuestao;
	private $nivelQuestao;
	private $disciplina;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getDescricao(){return $this->descricao;}
	public function setDescricao($var){$this->descricao = $var;}

	public function getResposta(){return $this->resposta;}
	public function setResposta($var){$this->resposta = $var;}

	public function getDescricaoResposta(){return $this->descricaoResposta;}
	public function setDescricaoResposta($var){$this->descricaoResposta = $var;}
	
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
	
	public function getAssuntoQuestao(){
		if(empty($this->assuntoQuestao))
			$this->setAssuntoQuestao(new AssuntoQuestao());
		return $this->assuntoQuestao;
	}
	public function setAssuntoQuestao($var){
		if(empty($var))
			$var = new AssuntoQuestao();
		$this->assuntoQuestao = $var;
	}
	public function getNivelQuestao(){
		if(empty($this->nivelQuestao))
			$this->setNivelQuestao(new NivelQuestao());
		return $this->nivelQuestao;
	}
	public function setNivelQuestao($var){
		if(empty($var))
			$var = new NivelQuestao();
		$this->nivelQuestao = $var;
	}
	public function getDisciplina(){
		if(empty($this->disciplina))
			$this->setDisciplina(new Disciplina());
		return $this->disciplina;
	}
	public function setDisciplina($var){
		if(empty($var))
			$var = new Disciplina();
		$this->disciplina = $var;
	}

	public function insert(){
		$resp = $this->getResposta();
		$this->setResposta(0);
		$array = array
			(
			'id' => $this->getId(),
			'descricao' => $this->getDescricao(),
			'resposta' => $this->getResposta(),
			'descricao_resposta' => $this->getDescricaoResposta()
			);
		$return = parent::insert($array);
		
		if($return){
			$this->setId($return);
			
			foreach($this->getAlternativas()->getAlternativas() as $linha){
				$linha->setQuestaoId($this->getId());
				$id = $linha->insert();
				if($id){
					$this->setResposta($id);
					$db = $this->getAdapter();
					$db->update($this->_name,array('resposta' => $this->getResposta()),"`id` = '".$return."'");
				}		
			}
			
			$this->getAssuntoQuestao()->setQuestaoId($return);
			$this->getAssuntoQuestao()->insert();
			
			if($this->getNivelQuestao()->getNivel()){
				$this->getNivelQuestao()->setQuestaoId($return);
				$this->getNivelQuestao()->insert();
			}
		}
		
		return $return;
	}
	public function update(){
		$resp = $this->getResposta();
		$this->setResposta(0);
		
		$array = array
			(
			'id' => $this->getId(),
			'descricao' => $this->getDescricao(),
			'resposta' => $this->getResposta(),
			'descricao_resposta' => $this->getDescricaoResposta()
			);
		$return = parent::update($array,"id = '".$this->getId()."'");

		$tmp 	= $this->getAdapter();		
		$tmp->delete("questao_alternativa","`questao_id` = '".$this->getId()."'");
		
		foreach($this->getAlternativas()->getAlternativas() as $linha){
			$id = $tmp->fetchOne("SELECT MAX(`id`) FROM `questao_alternativa`");

			$linha->setId(($id+1));
			$linha->setQuestaoId($this->getId());
			$id = $linha->insert();
			if($id && $linha->getDescricao() == $resp){
				$this->setResposta($id);
						
				$tmp->update($this->_name,array('resposta' => $this->getResposta()),"id = '".$this->getId()."'");
			}	
		}
		$assuntoQuestao = $tmp->fetchRow("SELECT * FROM `assunto_questao` WHERE `questao_id` = '".$this->getId()."'");
		$this->getAssuntoQuestao()->setQuestaoId($this->getId());
		if($assuntoQuestao['id']){
			$this->setId($assuntoQuestao['questao_id']);
			$this->getAssuntoQuestao()->update();
		}else
			$this->getAssuntoQuestao()->insert();
		
		$nivelQuestao = new NivelQuestao();
		$nivelQuestao->lastRegister($this->getId());
	//	print $this->getId()." - ".$nivelQuestao->getNivel()." => ".$this->getNivelQuestao()->getNivel();
		
		if($nivelQuestao->getNivel() != $this->getNivelQuestao()->getNivel()){
			$this->getNivelQuestao()->setQuestaoId($this->getId());
			$this->getNivelQuestao()->insert();
		}
			
		return $return;
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
			
			$list = $this->getAdapter()->fetchAll("SELECT * FROM `questao_alternativa` WHERE `questao_id` = '".$this->getId()."'");
			$this->setAlternativas(new ListaAlternativa());
			foreach($list as $linha){
				$alternativas = new QuestaoAlternativa();
				$alternativas->setId($linha['id']);
				$alternativas->setQuestaoId($linha['questao_id']);
				$alternativas->setDescricao($linha['descricao']);
				
				$this->getAlternativas()->addAlternativa($alternativas);
			}
			
			$assuntoQuestao = new AssuntoQuestao();
			$assuntoQuestao->load2Questao($object->id);
			$this->setAssuntoQuestao($assuntoQuestao);
			
			$disciplinaAssunto = new DisciplinaAssunto();
			$disciplinaAssunto = $disciplinaAssunto->fetchRow("`assunto_id` = '".$this->getAssuntoQuestao()->getAssuntoId()."'");
			
			$this->getDisciplina()->load($disciplinaAssunto->disciplina_id);
			
			$nivelQuestao = new NivelQuestao();
			$nivelQuestao->lastRegister($object->id);
			
			$this->setNivelQuestao($nivelQuestao);
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	
	public function toString(){
		$alternativas = $this->getAlternativas()->getAlternativas();
		$str = "<h1 class='h1Questoes'>".$this->getDescricao()."</h1><hr />";
		$str .= "<h2 class='h2Questoes'>Alternativas</h2>";
		if(empty($alternativas))
			$str .= "<span class='semAlternativas'>Não possui alternativas cadastradas</span>";
		else{
			$str .= "<ul class='popupAlternativas'>";
			foreach($alternativas as $linha){
				if($linha->getId() == $this->getResposta())
					$str .= "<li class='popupAlternativaResposta'>".$linha->getDescricao()."</li>";
				else
					$str .= '<li>'.$linha->getDescricao().'</li>';
			}
		}		
		$str .= '</ul>';
		
		$str .= '<hr \>';
		$str .= "<h2 class='h2Questoes'>Descricao da Resposta</h2>";
		$str .= "<span class='descricaoResposta'>".$this->getDescricaoResposta()."</span>";

		return $str;
	}
}
