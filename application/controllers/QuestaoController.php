<?php
/*
 * Controle de Questao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class QuestaoController extends Zend_Controller_Action{
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
		$this->QuestaoAction();
	}
	public function questaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$questao = new Questao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$questao->load($get->id);
					break;
				case 'delete':
					$questao->load($get->id);
					$questao->delete();

					$this->_redirect("questao/questao");
					die();
			}
			$view->assign("questao",$questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","questao/questao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$questao->setDescricao($funcao->to_sql($post->descricao));
			$questao->setResposta($funcao->to_sql($post->resposta));
			$questao->setDescricaoResposta($funcao->to_sql($post->descricao_resposta));
			$questao->setDateCreate($funcao->to_sql($post->date_create));
			$questao->setDateUpdate($funcao->to_sql($post->date_update));
			$questao->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($questao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Questao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Questao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$questao->setId($post->id);
				$questao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Questao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'questao',$display_datagrid);
		}
	}
}