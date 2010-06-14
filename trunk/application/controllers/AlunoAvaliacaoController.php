<?php
/*
 * Controle de AlunoAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AlunoAvaliacaoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}
	public function negado(){
		$view = Zend_Registry::get('view');
		$view->output("negado.tpl");
		die();
	}
	public function acesso($view){
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso())
			$this->negado();
	}

	public function indexAction(){
		$this->alunoavaliacaoAction();
	}
	public function alunoavaliacaoAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');
		
		$pessoa_escola = new PessoaEscola();
		
		// ALUNO
		$pessoa_escola->load(12);

		$session->usuario = $pessoa_escola;
		
		$usuario = $session->usuario;

		$this->acesso($view);

		$aluno_avaliacao = new AlunoAvaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		
		$avaliacao 	= new Avaliacao();
		$disciplina = new Disciplina();
		$alunoResolveQuestao = new AlunoResolveQuestao();
		$respostaId = 0;
		
		if(!empty($session->atual) && empty($post->action)){
			
			$id = (int)$session->atual['avaliacaoId'];
			
			$avaliacao->load($id);

			if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
				$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
				$disciplina = $tmp[0]->getDisciplina();
			}
			
			$aux = $session->atual['numero'];
			
			$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
			$questao	= $questoes[$aux-1];
			
			$alunoResolveQuestao->load($session->atual['alunoResolveQuestaoId']);
			$respostaId = $alunoResolveQuestao->getRespostaId();
			
			$session->atual	= array('numero' => $aux,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
			
			
		}elseif(!empty($get->id) && (int)$get->id && empty($post->action)){
			$id = (int)$get->id;
			
			$avaliacao->load($id);

			if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
				$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
				$disciplina = $tmp[0]->getDisciplina();
			}
			
			
			$avaliacaoAluno = new AvaliacaoAluno();
			
			$listAvaliacao 	= $avaliacaoAluno->fetchRow("`aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."'");
			
			$avaliacaoAluno->setAlunoPessoaEscolaPessoaFisicaPessoaId($usuario->getPessoaId());
			$avaliacaoAluno->setAvaliacaoId($avaliacao->getId());
						
			if(!$listAvaliacao){
				
				$avaliacaoAluno->setAlunoPessoaEscolaMatricula($usuario->getMatricula());
				$avaliacaoAluno->setDataInicio(date('Y-m-d H:i:s'));
				$avaliacaoAluno->insert();
				$session->avaliacaoAluno = $avaliacaoAluno->getId();		
				
				$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
				$questao	= $questoes[0];
				
				$alunoResolveQuestao = $this->createQuestion($avaliacao,$disciplina,$questao);
				
				$session->lista = new ListaAlunoResolveQuestao();
				$session->lista->add($alunoResolveQuestao);
				
				$session->atual	 = array('numero' => 1,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
				
				$session->time			= "00:00:00";
				$session->iniciar	 	= false;
			}else{
				
				$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
				$questao	= $questoes[0];
				
				
				$alunoResolveQuestao = new AlunoResolveQuestao();
				
				$list = $alunoResolveQuestao->fetchAll("`pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."'","id");
				$alunoResolveQuestao->load($list[0]->id);
				
				$session->lista = new ListaAlunoResolveQuestao();
				foreach($list as $linha){
					$tmp = new AlunoResolveQuestao();
					$tmp->load($linha->id);
					$session->lista->add($tmp);
				}
							
				$inicio 	= $list[0]->inicio;
				$dtIni 		= trim(substr($inicio,0,10));
				$hrIni 		= trim(substr($inicio,10));
		
				$final 		= $list[sizeof($list)-1]->fim;
				$dtFim 		= trim(substr($final,0,10));
				$hrFim 		= trim(substr($final,10));
				
				$dayIni = mktime(0,0,0,substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));		
				$dayFim = mktime(0,0,0,substr($dtFim,5,2),substr($dtFim,8,2),substr($dtFim,0,4));

				$day = mktime(0,0,0,substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
				$dt1 = mktime(substr($hrIni,0,2),substr($hrIni,3,2),substr($hrIni,6,2),substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
				$dt2 = mktime(substr($hrFim,0,2),substr($hrFim,3,2),substr($hrFim,6,2),substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
				
				$tempo = $day+($dt2-$dt1);
				$tempo = date('H:i:s',$tempo);
				
				$session->atual	 = array('numero' => 1,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
				
				$session->time			= $tempo;
				$session->iniciar	 	= true;
			}
		}elseif(!empty($post->action)){
			$session->iniciar = true;

			switch($post->action){
				case 'next':
					try{
						$id = (int)$session->atual['avaliacaoId'];
				
						$avaliacao->load($id);
			
						if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
							$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
							$disciplina = $tmp[0]->getDisciplina();
						}
						
						$aux = $session->atual['numero']+1;
						
						$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
						$questao	= $questoes[$aux-1];
						
						$alunoResolveQuestao->load($session->atual['alunoResolveQuestaoId']);
						if($alunoResolveQuestao->getReinicio()){
							$now = date('Y-m-d H:i:s');
							$dif = $now - $alunoResolveQuestao->getReinicio();
							
							$tempo = $alunoResolveQuestao->getFim() + $dif;
							$alunoResolveQuestao->setFim($tempo);
						}else
							$alunoResolveQuestao->setFim(date('Y-m-d H:i:s'));
							
						$alunoResolveQuestao->setRespostaId($funcao->to_sql($post->resposta));					
						$alunoResolveQuestao->update();
						
						$pos = $session->lista->findByQuestion($questao);
						if($pos<0){
							$alunoResolveQuestao = $this->createQuestion($avaliacao,$disciplina,$questao);
							$session->lista->add($alunoResolveQuestao);
						}else{
							$tmp = $session->lista->getListaAlunoResolveQuestao();
							$alunoResolveQuestao->load($tmp[$pos]->getId());
							if($alunoResolveQuestao->getFim())
								$alunoResolveQuestao->setReinicio(date('Y-m-d H:i:s'));
							$respostaId = $alunoResolveQuestao->getRespostaId();
						}
						
						$session->atual	 = array('numero' => $aux,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
						die($funcao->array2json(array('url' => 'alunoavaliacao')));
					}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal => '.$e))));}
					break;
				case 'back':
					try{
						$id = (int)$session->atual['avaliacaoId'];
				
						$avaliacao->load($id);
			
						if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
							$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
							$disciplina = $tmp[0]->getDisciplina();
						}
						
						$aux = $session->atual['numero']-1;
						
						$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
						$questao	= $questoes[$aux-1];
						
						$alunoResolveQuestao->load($session->atual['alunoResolveQuestaoId']);
						if($alunoResolveQuestao->getReinicio()){
							$now = date('Y-m-d H:i:s');
							$dif = $now - $alunoResolveQuestao->getReinicio();
							
							$tempo = $alunoResolveQuestao->getFim() + $dif;
							$alunoResolveQuestao->setFim($tempo);
						}else
							$alunoResolveQuestao->setFim(date('Y-m-d H:i:s'));
							
						$alunoResolveQuestao->setRespostaId($funcao->to_sql($post->resposta));					
						$alunoResolveQuestao->update();
						
						$pos = $session->lista->findByQuestion($questao);
						if($pos >= 0){
							$tmp = $session->lista->getListaAlunoResolveQuestao();
							$alunoResolveQuestao->load($tmp[$pos]->getId());
							if($alunoResolveQuestao->getFim())
								$alunoResolveQuestao->setReinicio(date('Y-m-d H:i:s'));
							$respostaId = $alunoResolveQuestao->getRespostaId();
						}
						
						$session->atual	 = array('numero' => $aux,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
						die($funcao->array2json(array('url' => 'alunoavaliacao')));
					}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal => '.$e))));}
					break;
				case 'finish':
					$str = "";
					try{
						$id = (int)$session->atual['avaliacaoId'];
						
						$avaliacao = new Avaliacao();
						$avaliacao->load($id);
			
						if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
							$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
							$disciplina = $tmp[0]->getDisciplina();
						}
						
						$aux = $session->atual['numero'];
						
						$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
						$questao	= $questoes[$aux-1];
						
						$alunoResolveQuestao = new AlunoResolveQuestao();
						$alunoResolveQuestao->load($session->atual['alunoResolveQuestaoId']);
						$alunoResolveQuestao->setFim(date('Y-m-d H:i:s'));
						$alunoResolveQuestao->setRespostaId($funcao->to_sql($post->resposta));					
						$alunoResolveQuestao->update();
						
						$pos = $session->lista->findByQuestion($questao);
						if($pos >= 0){
							$tmp = $session->lista->getListaAlunoResolveQuestao();
							$alunoResolveQuestao->load($tmp[$pos]->getId());
							if($alunoResolveQuestao->getFim())
								$alunoResolveQuestao->setReinicio(date('Y-m-d H:i:s'));
							$respostaId = $alunoResolveQuestao->getRespostaId();
						}
						
						//$session->atual	 = array('numero' => $aux,'avaliacaoId' => $avaliacao->getId(),'questao' => $questao,'alunoResolveQuestaoId' => $alunoResolveQuestao->getId());
						
						$avaliacaoAluno = new AvaliacaoAluno();
						$avaliacaoAluno->load($session->avaliacaoAluno);
						$avaliacaoAluno->setDataFim(date('Y-m-d H:i:s'));
						$avaliacaoAluno->update();
						
						die($funcao->array2json(array('url' => 'feedbackAvaliacaoAluno')));
					}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal => '.$str.$e))));}
					break;
				default:
					$view->output("negado.tpl");
					die();
					break;
			}
		}else{
			$this->negado();
		}
		
		$view->assign("session",$session);
		$view->assign("avaliacao",$avaliacao);
		$view->assign("disciplina",$disciplina);
		$view->assign("questoes",$questoes);
		$view->assign("questao",$questao);
		$view->assign("respostaId",$alunoResolveQuestao->getRespostaId());
		$view->assign("atual",$atual);
			
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","alunoavaliacao/alunoavaliacao.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	function createQuestion($avaliacao,$disciplina,$questao){
		$session = Zend_Registry::get('session');
		
		$alunoResolveQuestao = new AlunoResolveQuestao();
		$alunoResolveQuestao->setPessoaId($session->usuario->getId());
		$alunoResolveQuestao->setAvaliacaoId($avaliacao->getId());
		$alunoResolveQuestao->setDisciplinaId($disciplina->getId());
		$alunoResolveQuestao->setQuestaoId($questao->getId());
		$alunoResolveQuestao->setInicio(date('Y-m-d H:i:s'));
		$alunoResolveQuestao->insert();
		return $alunoResolveQuestao;
	}
	public function timeAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');
		
		if(!isset($session->time))
			$session->time = "00:00:00";
		else{
			$time = $session->time;
			$hh = (int) substr($time,0,2);
			$mm = (int) substr($time,3,2);
			$ss = (int) substr($time,6,2);
			
			$ss += 1;
			if($ss == 60){
		    	$ss = 0;
		    	$mm += 1;
		    }
		    if($mm == 60){
		        $mm = 0;
		        $hh += 1;
		    }
		
		    $h = $hh;
		    $m = $mm;
		    $s = $ss;
		
		    if($h < 10)
		        $h = "0".$h;
		    if($m < 10)
		        $m = "0".$m;
		    if($s < 10)
		        $s = "0".$s;
		   
		    $session->time = $h.":".$m.":".$s;
		}
		$view->assign("time",$session->time);
		$view->output("time.tpl");
	}
	public function nextAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		$post 	= Zend_Registry::get('post');
		try{
			$funcao 	= new FuncoesProjeto();
			
			$session->inicio = false;
			
			$resp = "";
			if(!empty($post->resposta))
				$resp = $post->resposta;
			
			$resp = $funcao->to_sql($resp);
			
			$questaoAtual = $session->questaoAtual;
			
			$id = $questaoAtual['alunoResolveQuestaoId'];
			
			$tmp = new AlunoResolveQuestao();
			$tmp->load($id);
			
			$id = $session->listaAlunoResolveQuestao->find($tmp);
			$value = $session->listaAlunoResolveQuestao->getListaAlunoResolveQuestao();
			if(!$value[$id]->getFim()){
				$value[$id]->setFim(date('H:i:s'));
				$tmp->setFim(date('H:i:s'));
			}
			$value[$id]->setRespostaId($resp);
			$tmp->setRespostaId($resp);

			$pp = $session->listaAlunoResolveQuestao->update($id,$value[$id]);
			
			//print $pp->toString();
			
			$tmp->update($array,"id = '".$tmp->getId()."'");
			$this->sessionQuestion();
			
			die($funcao->array2json(array('url' => 'alunoavaliacao')));
		}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - UPDATE => '.$e))));}
	}
	public function backAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		
		$view->assign("time",$session->time);
		$view->output("time.tpl");
	}
}