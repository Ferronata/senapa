<?php
/*
 * Controle de FeedbackAvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class FeedbackAvaliacaoAlunoController extends Zend_Controller_Action{
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
		if(!$funcao->acesso()){
			$view->output("negado.tpl");
			die();
		}
	}
	public function indexAction(){
		$this->FeedbackAvaliacaoAlunoAction();
	}
	public function feedbackavaliacaoalunoAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');

		$this->acesso($view);

		$feedback_avaliacao_aluno = new FeedbackAvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();
		
		$usuario = $session->usuario;
		
		$id = (int)$session->atual['avaliacaoId'];
		$avaliacao = new Avaliacao();
		$avaliacao->load($id);
			
		$avaliacaoAluno = new AvaliacaoAluno();
	
		$listAvaliacao 	= $avaliacaoAluno->fetchRow("`aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."'");
		
		$avaliacaoAluno->setAlunoPessoaEscolaPessoaFisicaPessoaId($usuario->getPessoaId());
		$avaliacaoAluno->setAvaliacaoId($avaliacao->getId());
					
		if($listAvaliacao){
			$avaliacaoAluno->load($listAvaliacao->id);
			
			if($avaliacaoAluno->getDataFim()){
				$feedbackAvaliacaoAluno = new FeedbackAvaliacaoAluno();
				$tmp = $feedbackAvaliacaoAluno->fetchRow("`avaliacao_aluno_id` = '".$avaliacaoAluno->getId()."'");
				
				if($tmp)
					FeedbackAvaliacaoAlunoController::resultadoAction();
				else{
					$feedbackAvaliacao = new Feedbackavaliacao();
					$list = $feedbackAvaliacao->fetchAll("`date_delete` IS NULL");
					
					$perguntas = array();
					
					foreach($list as $linha){
						$tmp = new Feedbackavaliacao();
						$tmp->load($linha->id);
						$perguntas[] = $tmp;
					}
					
					$view->assign("perguntas",$perguntas);
					
					$view->assign("header","html/default/header.tpl");
					$view->assign("body","feedbackavaliacaoaluno/index.tpl");
					$view->assign("footer","html/default/footer.tpl");
					$view->output("index.tpl");
				}
			}
		}
	}
	public function respostaAction(){
		$view 		= Zend_Registry::get('view');
		$session 	= Zend_Registry::get('session');

		$this->acesso($view);

		$feedback_avaliacao_aluno = new FeedbackAvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		
		if(empty($post->id))
			$this->negado();
		else{
			try{
				$id = (int)$session->atual['avaliacaoId'];
				$avaliacao = new Avaliacao();
				$avaliacao->load($id);
					
				$ids = $post->id;
				
				foreach($ids as $linha){
					$feedbackAvaliacao = new Feedbackavaliacao();
					$feedbackAvaliacao->load($linha);
					$tmpPost = "alternativa".$linha;
					$tmpResp = $post->$tmpPost;
					if(!empty($tmpResp)){
						$feedbackAvaliacaoAluno = new FeedbackAvaliacaoAluno();
						$feedbackAvaliacaoAluno->setFeedbackAvaliacaoAlternativaId($tmpResp);
						$feedbackAvaliacaoAluno->setAvaliacaoAlunoId($avaliacao->getId());
						$feedbackAvaliacaoAluno->insert();
					}
				}
				die($funcao->array2json(array('url' => 'resultado')));
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal => '.$str.$e))));}
		}
	}
	public function resultadoAction(){
		$view 		= Zend_Registry::get('view');
		$session 	= Zend_Registry::get('session');

		$this->acesso($view);

		$feedback_avaliacao_aluno = new FeedbackAvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		
		$usuario = $session->usuario;		
		$id = (int)$session->atual['avaliacaoId'];
		
		$avaliacao = new Avaliacao();
		$avaliacao->load($id);
		$disciplina = new Disciplina();
		
		$questoes 	= $avaliacao->getListaQuestoes()->getListaQuestao();
		
		if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
			$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
			$disciplina = $tmp[0]->getDisciplina();
		}
		
		$listaQuestao = array();
		$soma 		= 0;
		$acertos	= 0;
		$nulas		= 0;
		foreach($questoes as $linha){
			if($linha->getResposta())
				$soma ++;
			else
				$nulas ++;
			
			$alunoResolveQuestao = new AlunoResolveQuestao();
			$tmp = $alunoResolveQuestao->fetchRow("`pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."' AND `questao_id` = '".$linha->getId()."'");
			$alunoResolveQuestao->load($tmp->id);
			
			$questao_alternativa = new QuestaoAlternativa();
			$questao_alternativa->load($linha->getResposta());
			
			$questaoAlternativaAluno = new QuestaoAlternativa();
			$questaoAlternativaAluno->load($alunoResolveQuestao->getRespostaId());
			
			if($linha->getResposta() && $questao_alternativa->getId() == $questaoAlternativaAluno->getId())
				$acertos ++;
			
			if($alunoResolveQuestao->getId())
				$listaQuestao[] = array('questao'=>$linha,'alunoResolveQuestao' => $alunoResolveQuestao,'resposta' => $questao_alternativa,'respostaAluno' => $questaoAlternativaAluno);
		}
		
		$avaliacaoAluno = new AvaliacaoAluno();
		$tmp = $avaliacaoAluno->fetchRow("`aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."'");
		if($tmp)
			$avaliacaoAluno->load($tmp->id);
			
		$inicio 	= $avaliacaoAluno->getDataInicio();
		$dtIni 		= trim(substr($inicio,0,10));
		$hrIni 		= trim(substr($inicio,10));

		$final 		= $avaliacaoAluno->getDataFim();
		$dtFim 		= trim(substr($final,0,10));
		$hrFim 		= trim(substr($final,10));
		
		$dayIni = mktime(0,0,0,substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));		
		$dayFim = mktime(0,0,0,substr($dtFim,5,2),substr($dtFim,8,2),substr($dtFim,0,4));

		$day = mktime(0,0,0,substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
		$dt1 = mktime(substr($hrIni,0,2),substr($hrIni,3,2),substr($hrIni,6,2),substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
		$dt2 = mktime(substr($hrFim,0,2),substr($hrFim,3,2),substr($hrFim,6,2),substr($dtIni,5,2),substr($dtIni,8,2),substr($dtIni,0,4));
		
		$tempo = $day+($dt2-$dt1);
		$tempo = date('H:i:s',$tempo);
			
		$view->assign("soma",$soma);
		$view->assign("acertos",$acertos);
		$view->assign("nulas",$nulas);
		
		$view->assign("avaliacaoAluno",$avaliacaoAluno);
		$view->assign("tempo",$tempo);
		$view->assign("usuario",$usuario);
		$view->assign("avaliacao",$avaliacao);
		$view->assign("disciplina",$disciplina);
		$view->assign("listaQuestao",$listaQuestao);
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","feedbackavaliacaoaluno/resultado.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}