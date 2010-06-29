<?php
/*
 * Controle de AvaliacaoSituacao
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoSituacaoController extends Zend_Controller_Action{
	public function init(){
		include_once("Project/include.php");
	}

	public function acesso($view){
		$session = Zend_Registry::get('session');
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso($session)){
			$view->output("negado.tpl");
			die();
		}
	}

	public function indexAction(){
		$this->AvaliacaoSituacaoAction();
	}
	public function avaliacaosituacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$avaliacao_situacao = new AvaliacaoSituacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$avaliacao_situacao->load($get->id);
					break;
				case 'delete':
					$avaliacao_situacao->load($get->id);
					$avaliacao_situacao->delete();

					$this->_redirect("avaliacaosituacao/avaliacaosituacao");
					die();
			}
			$view->assign("avaliacao_situacao",$avaliacao_situacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacaosituacao/avaliacaosituacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$avaliacao_situacao->setNome($funcao->to_sql($post->nome));
			$avaliacao_situacao->setStatus($funcao->to_sql($post->status));

			if(empty($post->id)){
				// CREATE

				if($avaliacao_situacao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Situa��o da avalia��o inserida com sucesso'), 'url' => 'avaliacaosituacao');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir situa��o da avalia��o'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$avaliacao_situacao->setId($post->id);
				$avaliacao_situacao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Situa��o da avalia��o modificada com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'nome'		=> 'Situa��o',
				'status'	=> 'Ativo',
				'date_create'=> 'Data de Cria��o',
				'date_update'=> 'Ultima Atualiza��o'
			);
			$where = "`date_delete` IS NULL";
			
			$funcao->datagrid($view, 'avaliacao_situacao',$display_datagrid,$where,"Situa��o da Avalia��o");
		}
	}
}