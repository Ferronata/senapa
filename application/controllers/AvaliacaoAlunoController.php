<?php
/*
 * Controle de AvaliacaoAluno
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoAlunoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
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
		$this->AvaliacaoAlunoAction();
	}
	public function avaliacaoalunoAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');

		$usuario = $session->usuario;
		$view->assign("usuario",$usuario);

		$this->acesso($view);

		$avaliacao_aluno = new AvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();
		
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
		$view->assign("body","avaliacaoaluno/index.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}