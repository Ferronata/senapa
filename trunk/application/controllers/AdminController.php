<?php
/*
 * Controle da parte administrativa => Admin
 * Data de Cricação - 05/03/2010
 * @author Léo Popik => Classgen 1.0
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

		$view->assign("body","html/admin/datagrid.tpl");
		$view->assign("header","html/admin/header.tpl");
		$view->assign("footer","html/admin/footer.tpl");
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
		
		$menu = array
			(
			array('nome' => 'Pessoa','url' => 'javascript: openPage(\'pessoa\');'),
			array('nome' => 'Pessoa Física','url' => 'javascript: openPage(\'pessoafisica\');'),
			array('nome' => 'Pessoa Escola','url' => 'javascript: openPage(\'pessoaescola\');')
			);
		$data = array
			(
			array('nome' => 'RH','data' => $menu)
			);
		
		$array = array
			(
				array('nome' => 'Super','data' => $data)
			);		
		
		
		$view->assign("categorias",$array);		
 		$view->assign("header","html/admin/header.tpl");
		$view->assign("body","admin/index.tpl");
		$view->assign("footer","html/admin/footer.tpl");
		$view->output("index.tpl");
	}
}