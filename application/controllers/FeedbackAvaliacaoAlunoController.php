<?php
/*
 * Controle de FeedbackAvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class FeedbackAvaliacaoAlunoController extends Zend_Controller_Action{
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
		$this->FeedbackAvaliacaoAlunoAction();
	}
	public function feedbackavaliacaoalunoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$feedback_avaliacao_aluno = new FeedbackAvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$aluno_avaliacao 	= new AlunoAvaliacao();
			$aluno_avaliacao 	= $aluno_avaliacao->fetchAll('1','');
			$view->assign("aluno_avaliacao",$aluno_avaliacao);

			$feedback_avaliacao_alternativa 	= new FeedbackAvaliacaoAlternativa();
			$feedback_avaliacao_alternativa 	= $feedback_avaliacao_alternativa->fetchAll('1','');
			$view->assign("feedback_avaliacao_alternativa",$feedback_avaliacao_alternativa);
			switch($get->action){
				case 'edit':
					$feedback_avaliacao_aluno->load($get->id);
					break;
				case 'delete':
					$feedback_avaliacao_aluno->load($get->id);
					$feedback_avaliacao_aluno->delete();

					$this->_redirect("feedbackavaliacaoaluno/feedbackavaliacaoaluno");
					die();
			}
			$view->assign("feedback_avaliacao_aluno",$feedback_avaliacao_aluno);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","feedbackavaliacaoaluno/feedbackavaliacaoaluno.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$feedback_avaliacao_aluno->setFeedbackAvaliacaoAlternativaId($funcao->to_sql($post->feedback_avaliacao_alternativa_id));
			$feedback_avaliacao_aluno->setAlunoAvaliacaoId($funcao->to_sql($post->aluno_avaliacao_id));

			if(empty($post->id)){
				// CREATE

				if($feedback_avaliacao_aluno->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('FeedbackAvaliacaoAluno inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir FeedbackAvaliacaoAluno'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$feedback_avaliacao_aluno->setId($post->id);
				$feedback_avaliacao_aluno->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('FeedbackAvaliacaoAluno modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'feedback_avaliacao_aluno',$display_datagrid);
		}
	}
}