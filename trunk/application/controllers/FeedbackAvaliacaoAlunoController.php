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

		$this->acesso($view);

		$feedback_avaliacao_aluno = new FeedbackAvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();
		
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
				$ids = $post->id;
				
				$id = (int)$session->atual['avaliacaoId'];
				$avaliacao = new Avaliacao();
				$avaliacao->load($id);
						
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
				die($funcao->array2json(array('msg' => 'ok', 'display' => htmlentities('Feedback concluído com sucesso'),'url' => '/senapa/feedbackAvaliacaoAluno/resultado')));
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
		
		foreach($questoes as $linha){
			$alunoResolveQuestao = new AlunoResolveQuestao();
			$tmp = $alunoResolveQuestao->fetchRow("`pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."' AND `questao_id` = '".$linha->getId()."'");
			$alunoResolveQuestao->load($tmp->id);
			
			$questao_alternativa = new QuestaoAlternativa();
			$questao_alternativa->load($linha->getResposta());
			
			$questaoAlternativaAluno = new QuestaoAlternativa();
			$questaoAlternativaAluno->load($alunoResolveQuestao->getRespostaId());
			
			if($alunoResolveQuestao->getId())
				$listaQuestao[] = array('questao'=>$linha,'alunoResolveQuestao' => $alunoResolveQuestao,'resposta' => $questao_alternativa->getDescricao(),'respostaAluno' => $questaoAlternativaAluno->getDescricao());
		}
		
		$avaliacaoAluno = new AvaliacaoAluno();
		$tmp = $avaliacaoAluno->fetchRow("`aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' AND `avaliacao_id` = '".$avaliacao->getId()."'");
		if($tmp)
			$avaliacaoAluno->load($tmp->id);
			
		$view->assign("avaliacaoAluno",$avaliacaoAluno);
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