<?php
/**
 * Modelo da classe Questao
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos => Classgen 1.0
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
	public function getResumo($length = ""){
		$tam = trim($length);
		if(empty($tam))
			$tam = 60;
		$str = trim(strip_tags($this->getDescricao()));
		if(strlen($str)>$tam){
			$tmp = strpos($str," ",$tam+1);
			if($tmp>0){
				$str = substr($str,0,$tmp);
				$str = trim($str)."...";
			}
			else
				$str = substr($str,0,$tam);
			
		}			
		return $str;
	}

	public function insert(){
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
				if($id && $linha->isResposta()){
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
		$array = array
			(
			'id' => $this->getId(),
			'descricao' => $this->getDescricao(),
			'resposta' => $this->getResposta(),
			'descricao_resposta' => $this->getDescricaoResposta()
			);
		$return = parent::update($array,"id = '".$this->getId()."'");

		
		
		$ids = " ";
		foreach($this->getAlternativas()->getAlternativas() as $linha){
			// update
			if($linha->getId()){
				$ids .= $linha->getId().",";
			}else{//insert
				$linha->setQuestaoId($this->getId());
				$id = $linha->insert();
				if($id){
					$linha->setId($id);
					$ids .= $linha->getId().",";
					if($linha->isResposta()){
						$this->setResposta($id);
						$this->getAdapter()->update($this->_name,array('resposta' => $this->getResposta()),"id = '".$this->getId()."'");
					}
				}
			}
		}
		$ids = trim(substr($ids,0,-1));
		$tmp 	= $this->getAdapter();
		$tmp->delete("questao_alternativa","`id` NOT IN (".$ids.") AND `questao_id` = '".$this->getId()."'");
		
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
		$this->_name = 'questao';
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
			
			// DisciplinaAssunto VERIFICAR INSER��O... o mesmo assunto serve para duas disciplinas?
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
	
	public function toSimpleString(){
		$alternativas = $this->getAlternativas()->getAlternativas();
		$str = "<h1 class='h1Questoes'>".$this->getDescricao()."</h1><hr />";
		$str .= "<h2 class='h2Questoes'>Alternativas</h2>";
		if(empty($alternativas))
			$str .= "<span class='semAlternativas'>N�o possui alternativas cadastradas</span>";
		else{
			$str .= "<ul class='popupAlternativas'>";
			foreach($alternativas as $linha){
				if($linha->getId() == $this->getResposta())
					$str .= "<li class='popupAlternativaResposta'>".$linha->getDescricao()."</li>";
				else
					$str .= '<li>'.$linha->getDescricao().'</li>';
			}
			$str .= '</ul>';
		}		
		
		return $str;
	}
	
	public function toString(){
		$alternativas = $this->getAlternativas()->getAlternativas();
		$str = "<h1 class='h1Questoes'>".$this->getDescricao()."</h1><hr />";
		$str .= "<h2 class='h2Questoes'>Alternativas</h2>";
		if(empty($alternativas))
			$str .= "<span class='semAlternativas'>N�o possui alternativas cadastradas</span>";
		else{
			$str .= "<ul class='popupAlternativas'>";
			foreach($alternativas as $linha){
				if($linha->getId() == $this->getResposta())
					$str .= "<li class='popupAlternativaResposta'>".$linha->getDescricao()."</li>";
				else
					$str .= '<li>'.$linha->getDescricao().'</li>';
			}
			$str .= '</ul>';
		}		
		if($this->getDescricaoResposta()){
			$str .= '<hr \>';
			$str .= "<h2 class='h2Questoes'>Descricao da Resposta</h2>";
			$str .= "<span class='descricaoResposta'>".$this->getDescricaoResposta()."</span>";
		}
		return $str;
	}
}
