<?php
/*
 * Controle de HistoricoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class HistoricoAlunoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
		Zend_Loader::loadClass('FeedbackAvaliacaoAlunoController');
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
		$this->alunoavaliacaoAction();
	}
	public function alunoavaliacaoAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');
		
		$pessoa_escola = new PessoaEscola();
		
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
		
		if(!empty($get->id)){
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
						
			if($listAvaliacao){
				
				$avaliacaoAluno->load($listAvaliacao->id);
				
				$session->atual	 = array('avaliacaoId' => $avaliacao->getId());
				
				FeedbackAvaliacaoAlunoController::resultadoAction();
			}
		}else{		
			$view->assign("usuario",$usuario);
	
			$avaliacao_aluno = new AvaliacaoAluno();
	
			$aluno = new Aluno();
			$tmp = $aluno->fetchAll("`pessoa_escola_pessoa_fisica_pessoa_id` IN (SELECT `id` FROM `pessoa` WHERE `date_delete` IS NULL)");
			
			$alunos = array();
			foreach($tmp as $linha){
				$tmpAluno = new Aluno();
				$tmpAluno->load($linha->pessoa_escola_matricula);
				$alunos[] = $tmpAluno;
			}
			$view->assign("alunos",$alunos);
			
			if($usuario->getPapelId() == $usuario->ENUM('P_ALUNO')){
				$aluno = new Aluno();
				$aluno->load($usuario->getMatricula());
				
				$avaliacoes = $aluno->getAvaliacoes();
				$view->assign("avaliacoes",$avaliacoes);
			}
	
			$view->assign("header","html/default/header.tpl");
			$view->assign("body","historicoAluno/index.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}
		/*
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');
		
		$pessoa_escola = new PessoaEscola();
		
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
		
		if(!empty($get->id)){
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
						
			if($listAvaliacao){
				
				$avaliacaoAluno->load($listAvaliacao->id);
				
				$session->atual	 = array('avaliacaoId' => $avaliacao->getId());
				
				FeedbackAvaliacaoAlunoController::resultadoAction();
			}
		}else
			$this->negado();
		*/
	}
}