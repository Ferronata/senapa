<?php
/*
 * Controle de PessoaEscola
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PessoaEscolaController extends Zend_Controller_Action{
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
		$this->PessoaEscolaAction();
	}
	public function pessoaescolaAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');

		$this->acesso($view);

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		
		$usuario = $session->usuario;
		$pessoa_escola = new PessoaEscola();
		$pessoa_escola->load($usuario->getPessoaId());
		
		
		$view->assign("object",$pessoa_escola);
		$view->assign("listaDisciplina",$pessoa_escola->getDisciplinas());
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","pessoaEscola/index.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}