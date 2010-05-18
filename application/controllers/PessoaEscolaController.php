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
		$this->PessoaEscolaAction();
	}
	public function pessoaescolaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$pessoa_escola = new PessoaEscola();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$pessoa_fisica 	= new PessoaFisica();
			$pessoa_fisica 	= $pessoa_fisica->fetchAll('1','');
			$view->assign("pessoa_fisica",$pessoa_fisica);
			switch($get->action){
				case 'edit':
					$pessoa_escola->load($get->pessoa_fisica_pessoa_id);
					break;
				case 'delete':
					$pessoa_escola->load($get->pessoa_fisica_pessoa_id);
					$pessoa_escola->delete();

					$this->_redirect("pessoaescola/pessoaescola");
					die();
			}
			$view->assign("pessoa_escola",$pessoa_escola);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","pessoaescola/pessoaescola.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_fisica_pessoa_id)){
			// SALVA E ATUALIZA REGISTRO

			if(empty($post->pessoa_fisica_pessoa_id)){
				// CREATE

				if($pessoa_escola->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaEscola inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir PessoaEscola'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$pessoa_escola->setPessoaFisicaPessoaId($post->pessoa_fisica_pessoa_id);
				$pessoa_escola->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaEscola modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'pessoa_escola',$display_datagrid);
		}
	}
}