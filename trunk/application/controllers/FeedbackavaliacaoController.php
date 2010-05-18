<?php
/*
 * Controle de Feedbackavaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class FeedbackavaliacaoController extends Zend_Controller_Action{
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
		$this->FeedbackavaliacaoAction();
	}
	public function feedbackavaliacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$feedbackavaliacao = new Feedbackavaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$feedbackavaliacao->load($get->id);
					break;
				case 'delete':
					$feedbackavaliacao->load($get->id);
					$feedbackavaliacao->delete();

					$this->_redirect("feedbackavaliacao/feedbackavaliacao");
					die();
			}
			$view->assign("feedbackavaliacao",$feedbackavaliacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","feedbackavaliacao/feedbackavaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$feedbackavaliacao->setDescricao($funcao->to_sql($post->descricao));
			$feedbackavaliacao->setDateCreate($funcao->to_sql($post->date_create));
			$feedbackavaliacao->setDateUpdate($funcao->to_sql($post->date_update));
			$feedbackavaliacao->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($feedbackavaliacao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Feedbackavaliacao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Feedbackavaliacao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$feedbackavaliacao->setId($post->id);
				$feedbackavaliacao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Feedbackavaliacao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'feedbackavaliacao',$display_datagrid);
		}
	}
}