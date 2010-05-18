<?php
/*
 * Controle de PessoaFisica
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PessoaFisicaController extends Zend_Controller_Action{
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
		$this->PessoaFisicaAction();
	}
	public function pessoafisicaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$pessoa_fisica = new PessoaFisica();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$pessoa 	= new Pessoa();
			$pessoa 	= $pessoa->fetchAll('1','nome');
			$view->assign("pessoa",$pessoa);
			switch($get->action){
				case 'edit':
					$pessoa_fisica->load($get->pessoa_id);
					break;
				case 'delete':
					$pessoa_fisica->load($get->pessoa_id);
					$pessoa_fisica->delete();

					$this->_redirect("pessoafisica/pessoafisica");
					die();
			}
			$view->assign("pessoa_fisica",$pessoa_fisica);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","pessoafisica/pessoafisica.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_id)){
			// SALVA E ATUALIZA REGISTRO
			$pessoa_fisica->setCpf($funcao->to_sql($post->cpf));
			$pessoa_fisica->setDataNascimento($funcao->to_date($post->data_nascimento));

			if(empty($post->pessoa_id)){
				// CREATE

				if($pessoa_fisica->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaFisica inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir PessoaFisica'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$pessoa_fisica->setPessoaId($post->pessoa_id);
				$pessoa_fisica->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaFisica modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'pessoa_fisica',$display_datagrid);
		}
	}
}