<?php
/*
 * Controle de Pessoa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PessoaController extends Zend_Controller_Action{
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
		$this->PessoaAction();
	}
	public function pessoaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$pessoa = new Pessoa();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$pessoa->load($get->id);
					break;
				case 'delete':
					$pessoa->load($get->id);
					$pessoa->delete();

					$this->_redirect("pessoa/pessoa");
					die();
			}
			$view->assign("pessoa",$pessoa);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","pessoa/pessoa.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$pessoa->setNome($funcao->to_sql($post->nome));
			$pessoa->setEmail($funcao->to_sql($post->email));
			$pessoa->setSite($funcao->to_sql($post->site));
			
			if(empty($post->id)){
				// CREATE
				if($pessoa->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Pessoa inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Pessoa'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$pessoa->setId($post->id);
				
				$pessoa->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Pessoa modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'pessoa',$display_datagrid);
		}
	}
}