<?php
/*
 * Controle da parte administrativa => Admin
 * Data de Cricação - 05/03/2010
 * @author Léo Popik => Classgen 1.0
 * @package photograf
 * @subpackage photograf.application.controllers
 * @version 1.0
 */
class FinalizarAvaliacaoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}
	public function negado(){
		$view = Zend_Registry::get('view');
		$view->output("negado.tpl");
		die();
	}
	public function acesso($view){
		$session = Zend_Registry::get('session');
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso($session)){
			$view->output("negado.tpl");
			die();
		}
	}

	public function indexAction(){
		$this->finalizaravaliacaoAction();
	}
	
	public function finalizaravaliacaoAction(){
		$view 	= Zend_Registry::get('view');
		$session = Zend_Registry::get('session');
		
		$usuario = $session->usuario;
		
		$this->acesso($view);
		
		$avaliacao = new Avaliacao();
		$avaliacao->load(1);
		
		$view->assign("avaliacao", $avaliacao);
		$view->assign("system", array('nivel'=>''));
		$view->assign("usuario", $usuario);
		$view->assign("tmp", $tmp);		
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","finalizaravaliacao/finalizaravaliacao.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
		
	}
	public function machineAction(){
		$view 	= Zend_Registry::get('view');
		$funcao = new FuncoesProjeto();
		
		$classeModalConfig 		= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','config');
		$classeModalAvaliacao 	= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','avaliacao');
		$classeModalQuestao 	= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','questao');
		
		$tmp1 = array();
		$tmp2 = array();
		$avaliacaoCM = array();
		
		foreach($classeModalAvaliacao->lista->classe as $key => $linha){
			$tmp = explode("-",$linha);
			$tmp1[] = array('min' => ($classeModalConfig->largura*(int)$tmp[0]),'max' => ($classeModalConfig->largura*(int)$tmp[1]));
		}
			
		foreach($classeModalAvaliacao->lista->nivel as $key => $linha)
			$tmp2[] = $linha;
		
		for($i=0;$i < sizeof($tmp1);$i++)
			$avaliacaoCM[] = array('classe' => array('min' => $tmp1[$i]['min'],'max' => $tmp1[$i]['max']),'nivel' => $tmp2[$i]);
		
		print "<h1>Avaliacao</h1>";
		foreach($avaliacaoCM as $linha)
			print $linha['classe']['min']." a ".$linha['classe']['max']." - ".$linha['nivel']."<p />";
			
			
		$tmp1 = array();
		$tmp2 = array();
		$tmp3 = array();
		$questaoCM = array();
		
		foreach($classeModalQuestao->lista->classe as $key => $linha)
			$tmp1[] = $linha;
			
		foreach($classeModalQuestao->lista->nivel->min as $key => $linha)
			$tmp2[] = $linha;
		foreach($classeModalQuestao->lista->nivel->max as $key => $linha)
			$tmp3[] = $linha;
		
		for($i=0;$i < sizeof($tmp1);$i++)
			$questaoCM[] = array('classe' => $tmp1[$i],'nivel' => array('min'=>$tmp2[$i],'max'=>$tmp3[$i]));
		/**
		print "<h1>Questao</h1>";
		foreach($questaoCM as $linha)
			print $linha['classe']." => ".$linha['nivel']['min']." - ".$linha['nivel']['max']."<p />";
		/**/
		
		print "<hr />";
		
		$professorAvaliacao = new ProfessorAvaliacao();
		$professorAvaliacao->load(1);
		
		$avaliacao = new Avaliacao();
		$avaliacao->load($professorAvaliacao->getAvaliacaoId());
		
		$nivelAvaliacao = new NivelAvaliacao();
		
		$avaliacaoNivel = new AvaliacaoNivel();
		$avaliacaoNivel->setAvaliacaoId($avaliacao->getId());
		$avaliacaoNivel->setDataNivelamento(date('Y-m-d H:i:s'));
		
		$avaliacaoDesvioPadrao = $funcao->timeToSec($avaliacao->getDesvioPadraoResoluao());
		$nivel = $this->classeModalAvaliacao($avaliacaoCM,$avaliacaoDesvioPadrao);
		
		if(!$avaliacao->getNivel()->getId()){
			$avaliacaoNivel->setNivel($nivel);
			$avaliacaoNivel->insert();
			$avaliacao->setNivel($avaliacaoNivel);
			
			$nivelAvaliacao->setProfessorAvaliacaoId($professorAvaliacao->getId());
			$nivelAvaliacao->setNivel($avaliacaoNivel->getNivel());
			$nivelAvaliacao->setDataNivelamento($avaliacaoNivel->getDataNivelamento());
			$nivelAvaliacao->setPor('S');
			$nivelAvaliacao->insert();
		}else{
			if($avaliacao->getNivel()->getNivel() != $nivel){
				$tmpNivel = $nivel;
				
				$sucesso 	= $nivelAvaliacao->fetchAll("`avaliacao_id` = '".$avaliacao->getId()."' AND `por` = 'S'","data_nivelamento");
				$fracasso 	= $nivelAvaliacao->fetchAll("`avaliacao_id` = '".$avaliacao->getId()."' AND `por` <> 'S'","data_nivelamento");
				
				$baseSucesso 	= array();
				$baseFracasso 	= array();
				
				foreach($sucesso as $linha)
					$baseSucesso[] = $linha->nivel;
					
				foreach($fracasso as $linha)
					$baseFracasso[] = $linha->nivel;
				if(sizeof($sucesso) > sizeof($fracasso))
					$tmpNivel = $baseSucesso[(sizeof($baseSucesso)-1)];
				else
					$tmpNivel = $this->moda($baseFracasso);
					
				print $tmpNivel = (int)(($nivel+$tmpNivel)/2);
			}
		}
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","finalizarAvaliacao/index.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	private function classeModalAvaliacao($avaliacaoCM = array(),$value){
		foreach($avaliacaoCM as $key => $linha){
			if($linha['classe']['min'] <= $value && $linha['classe']['max'] > $value)
				return $linha['nivel'];
		}
		return $avaliacaoCM[(sizeof($avaliacaoCM)-1)]['nivel'];
	}
	private function moda($baseFracasso){
		$tmp = array();
		foreach($baseFracasso as $linha){
			$tmp[$linha]++;
		}
		$pos 	= 0;
		$value 	= 0;
		foreach($tmp as $key => $linha){
			if($value<$linha){
				$pos 	= $key;
				$value 	= $linha;
			}else if($value==$linha)
				$pos = (int)(($key+$pos)/2);
		}
		return $pos;
	}
}