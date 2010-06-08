<?php
/*
 * Controle de AvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoAlunoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}
	public function acesso($view){
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso()){
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
		
		$pessoa_escola = new PessoaEscola();

		// SUPER ADMIN
		$pessoa_escola->load(1);
		
		// PROFESSOR
		//$pessoa_escola->load(11);
		
		// ALUNO
		//$pessoa_escola->load(12);

		$session->usuario = $pessoa_escola;		

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
		
		$usuario = $session->usuario;
		$view->assign("usuario",$usuario);

		$view->assign("header","html/default/header.tpl");
		$view->assign("body","avaliacaoaluno/index.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}