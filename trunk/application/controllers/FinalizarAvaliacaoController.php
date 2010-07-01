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
		$session= Zend_Registry::get('session');
		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');
		
		$usuario 	= $session->usuario;
		$professor 	= new Professor();
		$tmp = $professor->fetchAll("`pessoa_escola_pessoa_fisica_pessoa_id` IN (SELECT `id` FROM `pessoa` WHERE `date_delete` IS NULL)");
		
		$professores = array();
		foreach($tmp as $linha){
			$tmpProf = new Professor();
			$tmpProf->load($linha->pessoa_escola_matricula);
			$professores[] = $tmpProf;
		}
		$view->assign("professores",$professores);
		
		$this->acesso($view);
		
		$funcao = new FuncoesProjeto();
		
		if(!empty($get->id) || !empty($post->id)){
			$id = "";
			if(!empty($get->id))
				$id = $get->id;
			else
				$id = $post->id;
			$professorAvaliacao = new ProfessorAvaliacao();
			$professorAvaliacao->load($id);
					
			$avaliacao = $this->machine($professorAvaliacao);
				
			switch($post->action){
				case 'end':
					
					$inputNivel = $post->nivelAvaliacao;
					if($avaliacao->getNivelProposto()->getNivel() != $inputNivel){
						$avaliacao->getNivelProposto()->setPor('P');
						$avaliacao->getNivelProposto()->setNivel($inputNivel);
						$avaliacao->getNivelProposto()->setDataNivelamento(date("Y-m-d H:i:s"));
					}
					try{
						if($avaliacao->getNivel()->getNivel() != $inputNivel)
							$avaliacao->getNivelProposto()->insert();
					}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro ao gravar nivelamento da avaliação'))));};
					
					$niveis = $post->nivelQuestao;
					foreach($avaliacao->getListaQuestoes()->getListaQuestao() as $linha){
						$inputNivel = $niveis[$linha->getId()];
						
						if($linha->getNivelProposto()->getNivel() != $inputNivel){
							$linha->getNivelProposto()->setPor('P');
							$linha->getNivelProposto()->setNivel($inputNivel);
							$linha->getNivelProposto()->setDataNivelamento(date("Y-m-d H:i:s"));
						}
						try{
							if($linha->getNivelQuestao()->getNivel() != $inputNivel)
								$linha->getNivelProposto()->insert();
						}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro ao gravar nivelamento das questões'))));};
					}
					try{
						$avaliacao->setAvaliacaoSituacaoId($avaliacao->ENUM('A_S_VALIDA'));
						$avaliacao->update();
					}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro ao atualizar status da avaliação'))));};
					
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Avaliação nivelada e finalizada com sucesso'));
					print "<script>window.close;</script>";
					die();
				break;
			}
			$view->assign("professorAvaliacao", $professorAvaliacao);
			$view->assign("avaliacao", $avaliacao);
			$view->assign("usuario", $usuario);
//			$view->assign("tmp", $tmp);		
			
			$view->assign("body","finalizaravaliacao/finalizaravaliacao.tpl");
		}else
			$view->assign("body","finalizaravaliacao/index.tpl");

		$view->assign("usuario",$usuario);
		$view->assign("header","html/default/header.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	private function defaultConfigDataBase($largura,$classeModal){
		$tmp1 = array();
		$tmp2 = array();
		$objCM = array();
		
		foreach($classeModal->lista->classe as $key => $linha){
			$tmp = explode("-",$linha);
			$tmp1[] = array('min' => ($largura*(int)$tmp[0]),'max' => ($largura*(int)$tmp[1]));
		}
			
		foreach($classeModal->lista->nivel as $key => $linha)
			$tmp2[] = $linha;
		
		for($i=0;$i < sizeof($tmp1);$i++)
			$objCM[] = array('classe' => array('min' => $tmp1[$i]['min'],'max' => $tmp1[$i]['max']),'nivel' => $tmp2[$i]);
		return $objCM;
	}
	private function machine($professorAvaliacao){
		$view 	= Zend_Registry::get('view');
		$funcao = new FuncoesProjeto();
		
		$classeModalConfig 		= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','config');
		$classeModalAvaliacao 	= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','avaliacao');
		$classeModalQuestao 	= new Zend_Config_Ini('./application/configs/frequencia_moda.ini','questao');

		$avaliacaoCM 	= $this->defaultConfigDataBase($classeModalConfig->aLargura,$classeModalAvaliacao);
		$questaoCM 		= $this->defaultConfigDataBase($classeModalConfig->qLargura,$classeModalQuestao);		

		$avaliacao = new Avaliacao();
		$avaliacao->load($professorAvaliacao->getAvaliacaoId());
		
		$avaliacaoDesvioPadrao = $funcao->timeToSec($avaliacao->getDesvioPadraoResoluao());
		$nivel = $this->classeModal($avaliacaoCM,$avaliacaoDesvioPadrao);
		
		/* NIVELAMENTO DA AVALIACAO */
		$nivelAvaliacao = new NivelAvaliacao();
		$nivelAvaliacao->setNivel($nivel);
		$nivelAvaliacao->setProfessorAvaliacaoId($professorAvaliacao->getId());
		$nivelAvaliacao->setAvaliacaoId($avaliacao->getId());
		$nivelAvaliacao->setDataNivelamento(date('Y-m-d H:i:s'));
		$nivelAvaliacao->setPor('S');
		
		if(!$avaliacao->getNivel()->getId()){		
			$nivelAvaliacao->insert();
			
			$avaliacao->setNivel($nivelAvaliacao);
		}else{
			if($avaliacao->getNivel()->getNivel() != $nivel){
				$tmpNivel = $nivel;
				
				$sucesso 	= $nivelAvaliacao->fetchAll("`avaliacao_id` = '".$avaliacao->getId()."' AND `por` = 'S'","data_nivelamento");
				$fracasso 	= $nivelAvaliacao->fetchAll("`avaliacao_id` = '".$avaliacao->getId()."' AND (`por` <> 'S' OR `por` IS NULL)","data_nivelamento");
				
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

				if(!empty($tmpNivel))
					$nivel = (int)(($nivel+$tmpNivel)/2);
				
				if(empty($nivel)){
					$questao = new Questao();
					$nivel 	= $questao->getDesvioPadraoResoluao();
				}
				$nivelAvaliacao->setNivel($nivel);
			}
		}
		$avaliacao->setNivelProposto($nivelAvaliacao);
		/* FIM AVALIACAO */
		
		/* NIVELAMENTO DE QUESTOES */
		foreach($avaliacao->getListaQuestoes()->getListaQuestao() as $questao){
			$qBase 	= $questao->getBaseDados();
			$moda	= $this->moda($qBase);
			$nivel 	= $this->classeModal($questaoCM,$moda);
			if(empty($nivel))
				$nivel = ($classeModalConfig->nivel->max/2);
			
			$nivelQuestao = new NivelQuestao();
			$nivelQuestao->setNivel($nivel);
			$nivelQuestao->setQuestaoId($questao->getId());
			$nivelQuestao->setDataNivelamento(date("Y-m-d H:i:s"));
			$nivelQuestao->setPor('S');
/**/
			if(!$questao->getNivelQuestao()->getId()){
				$nivelQuestao->insert();
				$questao->setNivelQuestao($nivelQuestao);
			}else{
				if($questao->getNivelQuestao()->getNivel() != $nivel){
/**/
					$tmpNivel 	= $nivel;
					
					$sucesso 	= $nivelQuestao->fetchAll("`questao_id` = '".$questao->getId()."' AND `por` = 'S'","data_nivelamento");
					$fracasso 	= $nivelQuestao->fetchAll("`questao_id` = '".$questao->getId()."' AND (`por` <> 'S' OR `por` IS NULL)","data_nivelamento");
					
					$baseSucesso 	= array();
					$baseFracasso 	= array();
					
					foreach($sucesso as $linha)
						$baseSucesso[] = $linha->nivel;
						
					foreach($fracasso as $linha){
						$baseFracasso[] = $linha->nivel;
					}
					if(sizeof($sucesso) > sizeof($fracasso))
						$tmpNivel = $baseSucesso[(sizeof($baseSucesso)-1)];
					else
						$tmpNivel = $this->moda($baseFracasso);
					
					if(!empty($tmpNivel))
						$nivel = (int)(($nivel+$tmpNivel)/2);
					
					$nivelQuestao->setNivel($nivel);
/**/
				}
			}
			$questao->setNivelProposto($nivelQuestao);
/**/
		}	
		/* FIM QUESTOES */
		
		return $avaliacao;
	}
	private function classeModal($classeModal = array(),$value){
		if(empty($value))
			return 0;
		foreach($classeModal as $key => $linha){
			if($linha['classe']['min'] <= $value && $linha['classe']['max'] > $value)
				return $linha['nivel'];
		}
		return $classeModal[(sizeof($classeModal)-1)]['nivel'];
	}
	private function moda($base){
		$tmp = array();
		foreach($base as $linha){
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