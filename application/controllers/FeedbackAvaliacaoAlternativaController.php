<?php
/*
 * Controle de FeedbackAvaliacaoAlternativa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class FeedbackAvaliacaoAlternativaController extends Zend_Controller_Action{
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
		$session = Zend_Registry::get('session');
		$funcao = new FuncoesProjeto();
		if(!$funcao->acesso($session)){
			$view->output("negado.tpl");
			die();
		}
	}

	public function indexAction(){
		$this->FeedbackAvaliacaoAlternativaAction();
	}
	public function feedbackavaliacaoalternativaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$feedback_avaliacao_alternativa = new FeedbackAvaliacaoAlternativa();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$feedbackavaliacao 	= new Feedbackavaliacao();
			$feedbackavaliacao 	= $feedbackavaliacao->fetchAll('1','');
			$view->assign("feedbackavaliacao",$feedbackavaliacao);
			switch($get->action){
				case 'edit':
					$feedback_avaliacao_alternativa->load($get->id);
					break;
				case 'delete':
					$feedback_avaliacao_alternativa->load($get->id);
					$feedback_avaliacao_alternativa->delete();

					$this->_redirect("feedbackavaliacaoalternativa/feedbackavaliacaoalternativa");
					die();
			}
			$view->assign("feedback_avaliacao_alternativa",$feedback_avaliacao_alternativa);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","feedbackavaliacaoalternativa/feedbackavaliacaoalternativa.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$feedback_avaliacao_alternativa->setFeedbackavaliacaoId($funcao->to_sql($post->feedbackAvaliacao_id));
			$feedback_avaliacao_alternativa->setDescricao($funcao->to_sql($post->descricao));
			$feedback_avaliacao_alternativa->setStatus($funcao->to_sql($post->status));
			$feedback_avaliacao_alternativa->setDateCreate($funcao->to_sql($post->date_create));
			$feedback_avaliacao_alternativa->setDateUpdate($funcao->to_sql($post->date_update));
			$feedback_avaliacao_alternativa->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($feedback_avaliacao_alternativa->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('FeedbackAvaliacaoAlternativa inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir FeedbackAvaliacaoAlternativa'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$feedback_avaliacao_alternativa->setId($post->id);
				$feedback_avaliacao_alternativa->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('FeedbackAvaliacaoAlternativa modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'feedback_avaliacao_alternativa',$display_datagrid);
		}
	}
}