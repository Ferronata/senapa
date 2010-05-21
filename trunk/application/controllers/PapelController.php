<?php
/*
 * Controle de Papel
 * Data de Cricação - 20/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PapelController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}
	public function datagrid($view, $table, $display = array()){
		//Exemplo => $datagrid = new Datagrid('com_endereco', array('id'=>'ID', 'logradouro'=>'Rua'));
		$datagrid = new Datagrid($table,$display);
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
		$this->PapelAction();
	}
	public function papelAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$papel = new Papel();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$papel->load($get->id);
					break;
				case 'delete':
					$papel->load($get->id);
					$papel->delete();

					$this->_redirect("papel/papel");
					die();
			}
			$view->assign("papel",$papel);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","papel/papel.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$papel->setNome($funcao->to_sql($post->nome));
			$papel->setStatus2($funcao->to_sql($post->status_2));

			if(empty($post->id)){
				// CREATE

				if($papel->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Papel inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Papel'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$papel->setId($post->id);
				$papel->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Papel modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'papel',$display_datagrid);
		}
	}
}