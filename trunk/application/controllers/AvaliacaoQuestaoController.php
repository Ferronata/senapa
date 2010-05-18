<?php
/*
 * Controle de AvaliacaoQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoQuestaoController extends Zend_Controller_Action{
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
		$this->AvaliacaoQuestaoAction();
	}
	public function avaliacaoquestaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$avaliacao_questao = new AvaliacaoQuestao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);

			$questao 	= new Questao();
			$questao 	= $questao->fetchAll('1','');
			$view->assign("questao",$questao);
			switch($get->action){
				case 'edit':
					$avaliacao_questao->load($get->id);
					break;
				case 'delete':
					$avaliacao_questao->load($get->id);
					$avaliacao_questao->delete();

					$this->_redirect("avaliacaoquestao/avaliacaoquestao");
					die();
			}
			$view->assign("avaliacao_questao",$avaliacao_questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacaoquestao/avaliacaoquestao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$avaliacao_questao->setQuestaoId($funcao->to_sql($post->questao_id));
			$avaliacao_questao->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));

			if(empty($post->id)){
				// CREATE

				if($avaliacao_questao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoQuestao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AvaliacaoQuestao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$avaliacao_questao->setId($post->id);
				$avaliacao_questao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoQuestao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'avaliacao_questao',$display_datagrid);
		}
	}
}