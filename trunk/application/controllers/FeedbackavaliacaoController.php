<?php
/*
 * Controle de Feedbackavaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class FeedbackAvaliacaoController extends Zend_Controller_Action{
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

		if(isset($get->action)){			
			switch($get->action){
				case 'edit':
					$feedbackavaliacao->load($get->id);
					break;
				case 'delete':
					$feedbackavaliacao->load($get->id);
					$feedbackavaliacao->delete();

					$this->_redirect("feedbackAvaliacao/feedbackAvaliacao");
					die();
			}
			
			$alternativas = $feedbackavaliacao->getAlternativas();
			
			$view->assign("object",$feedbackavaliacao);
			$view->assign("alternativas",$alternativas);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","feedbackavaliacao/feedbackavaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$feedbackavaliacao->setDescricao($funcao->to_sql($post->descricao));
			
			if(isset($post->lista_alternativa_id)){
				$lista = $post->lista_alternativa_id;			
				foreach($lista as $linha){
					$alternativa = new FeedbackAvaliacaoAlternativa();
					$alternativa->load($linha);
					
					$feedbackavaliacao->getAlternativas()->addAlternativa($alternativa);
				}
			}
			if(isset($post->lista_alternativaDescricao)){
				$lista = $post->lista_alternativaDescricao; 
				foreach($lista as $linha){
					$alternativa = new FeedbackAvaliacaoAlternativa();
					$alternativa->setDescricao($linha);
					$alternativa->setStatus(true);
										
					$feedbackavaliacao->getAlternativas()->addAlternativa($alternativa);
				}
			}

			if(empty($post->id)){
				// CREATE
				try{
					if($feedbackavaliacao->insert())
						$retorno = array('msg' => 'ok', 'display' => htmlentities('Feedbackavaliacao inserido com sucesso'), 'url' => 'feedbackAvaliacao');
					else
						$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Feedbackavaliacao'));
	
					die($funcao->array2json($retorno));
				}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - INSERT => '.$e))));}
			}else{
				// UPDATE
				try{
					$feedbackavaliacao->setId($post->id);
					$feedbackavaliacao->update();
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Feedbackavaliacao modificado com sucesso'));
					die($funcao->array2json($retorno));
				}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - UPDATE => '.$e))));}
			}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'descricao'		=>	'Pergunta', 
				'date_create'	=>	'Data de Criação',
				'date_update'	=>	'Ultima Atualização'
			);
			$where = "`date_delete` IS NULL";
			
			$funcao->datagrid($view, 'feedbackavaliacao',$display_datagrid,$where,"Gerenciamento de Feedback");
		}
	}
}