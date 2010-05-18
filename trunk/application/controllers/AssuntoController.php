<?php
/*
 * Controle de Assunto
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AssuntoController extends Zend_Controller_Action{
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
		$this->AssuntoAction();
	}
	public function assuntoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$assunto = new Assunto();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$assunto->load($get->id);
					break;
				case 'delete':
					$assunto->load($get->id);
					$assunto->delete();

					$this->_redirect("assunto/assunto");
					die();
			}
			$view->assign("assunto",$assunto);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","assunto/assunto.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$assunto->setNome($funcao->to_sql($post->nome));
			$assunto->setDateCreate($funcao->to_sql($post->date_create));
			$assunto->setDateUpdate($funcao->to_sql($post->date_update));
			$assunto->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($assunto->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Assunto inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Assunto'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$assunto->setId($post->id);
				$assunto->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Assunto modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'assunto',$display_datagrid);
		}
	}
}