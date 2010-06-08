<?php
/*
 * Controle de PessoaJuridica
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PessoaJuridicaController extends Zend_Controller_Action{
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
		$this->PessoaJuridicaAction();
	}
	public function pessoajuridicaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$pessoa_juridica = new PessoaJuridica();

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
					$pessoa_juridica->load($get->pessoa_id);
					break;
				case 'delete':
					$pessoa_juridica->load($get->pessoa_id);
					$pessoa_juridica->delete();

					$this->_redirect("pessoajuridica/pessoajuridica");
					die();
			}
			$view->assign("pessoa_juridica",$pessoa_juridica);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","pessoajuridica/pessoajuridica.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_id)){
			// SALVA E ATUALIZA REGISTRO
			
			$pessoa_juridica->setNome($funcao->to_sql($post->nome));
			$pessoa_juridica->setEmail($funcao->to_sql($post->email));
			$pessoa_juridica->setSite($funcao->to_sql($post->site));
					
			$pessoa_juridica->setCnpj($funcao->to_sql($post->cnpj));
			$pessoa_juridica->setNomeFantasia($funcao->to_sql($post->nome_fantasia));
			$pessoa_juridica->setInscricaoEstadual($funcao->to_sql($post->inscricao_estadual));
			$pessoa_juridica->setInscricaoMunicipal($funcao->to_sql($post->inscricao_municipal));

			if(empty($post->pessoa_id)){
				// CREATE

				if($pessoa_juridica->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaJuridica inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir PessoaJuridica'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$pessoa_juridica->setPessoaId($post->pessoa_id);
				$pessoa_juridica->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaJuridica modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$funcao->datagrid($view, 'pessoa_juridica',$display_datagrid,"","Gerenciamento de Instituição");
		}
	}
}