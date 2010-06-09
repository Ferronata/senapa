<?php
/*
 * Controle da parte administrativa => Admin
 * Data de Crica��o - 05/03/2010
 * @author L�o Popik => Classgen 1.0
 * @package photograf
 * @subpackage photograf.application.controllers
 * @version 1.0
 */
class AdminController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}
	public function datagrid($view, $table, $display = array(), $where = ""){
		//Exemplo => $datagrid = new Datagrid('com_endereco', array('id'=>'ID', 'logradouro'=>'Rua'));
		$datagrid = new Datagrid($table, $where, $display);
		$view->assign("datagrid",$datagrid);

		$view->assign("body","html/default/datagrid.tpl");
		$view->assign("header","html/default/header.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	public function acesso($view){
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso()){
			$view->output("negado.tpl");
			die();
		}
	}

	public function indexAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$funcao 	= new FuncoesProjeto();
		
		$pessoa_escola = new PessoaEscola();

		// SUPER ADMIN
		$pessoa_escola->load(1);
		
		// PROFESSOR
		//$pessoa_escola->load(11);
		
		// ALUNO
		//$pessoa_escola->load(12);

		$session->usuario = $pessoa_escola;
		
		// ADMIN
		$menuAdmInst = array
			(
			array('nome' => 'Institui��o','url' => 'javascript: openPage(\'pessoajuridica\');'),
			array('nome' => 'Situa��es de Avalia��o','url' => 'javascript: openPage(\'avaliacaosituacao\');')
			);
			
		$menuAdmCoor = array
			(
			array('nome' => 'Disciplina','url' => 'javascript: openPage(\'disciplina\');')
			);
		$menuAdmSecr = array
			(
			array('nome' => 'Professor','url' 	=> 'javascript: openPage(\'professor\');'),
			array('nome' => 'Aluno','url' 		=> 'javascript: openPage(\'aluno\');')
			);
			
		$dataAdmin = array
			(
			array('nome' => 'Institui��o','data' 	=> $menuAdmInst),
			array('nome' => 'Coordena��o','data' 	=> $menuAdmCoor),
			array('nome' => 'Secretaria','data' 	=> $menuAdmSecr)
			);
		// FIM ADMIN
		
		// PROFESSOR
		$menuProfAdmin = array
			(
			array('nome' => 'Assunto','url' 	=> 'javascript: openPage(\'assunto\');'),
			array('nome' => 'Quest�es','url' 	=> 'javascript: openPage(\'questao\');')
			);
			
		$menuProfAvali = array
			(
			array('nome' => 'Avaliacao','url' => 'javascript: openPage(\'avaliacao\');')
			);
			
		$dataProf = array
			(
			array('nome' => 'Administra��o','data' 	=> $menuProfAdmin),
			array('nome' => 'Avalia��o','data' 		=> $menuProfAvali)
			);
		// FIM PROFESSOR
		
			// ALUNO
		$menuAlunoAdmin = array
			(
			array('nome' => 'Avalia��es','url' 	=> 'javascript: openPage(\'avaliacaoAluno\');'),
			array('nome' => 'Hist�rico','url' 	=> 'javascript: openPage(\'historicoAluno\');')
			);
			
		$dataAluno = array
			(
			array('nome' => 'Administra��o','data' => $menuAlunoAdmin)
			);
		// FIM ALUNO
		$array = array();
		switch($pessoa_escola->getPapelId()){
			case $pessoa_escola->ENUM('P_S_ADMIN'):
			case $pessoa_escola->ENUM('P_ADMIN'):
				$array = array
					(
						array('nome' => 'Administrativo','data' => $dataAdmin),
						array('nome' => 'Professor','data' 		=> $dataProf),
						array('nome' => 'Aluno','data' 			=> $dataAluno)
					);
				break;
			case $pessoa_escola->ENUM('P_PROFESSOR'):
				$array = array
					(
						array('nome' => 'Professor','data' 		=> $dataProf)
					);
				break;
			case $pessoa_escola->ENUM('P_ALUNO'):
				$array = array
					(
						array('nome' => 'Aluno','data' 			=> $dataAluno)
					);
				break;
		}
		
		$saudacao = (date("H")<12)?"Bom dia ":(date("H")<18)?"Boa tarde ":"Boa noite ";
		$saudacao .= $pessoa_escola->getNome();
			
		$view->assign("categorias",$array);		
		$view->assign("pessoa_fisica",$pessoa_escola);
		$view->assign("saudacao",$saudacao);
 		$view->assign("header","html/default/header.tpl");
		$view->assign("body","admin/index.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}