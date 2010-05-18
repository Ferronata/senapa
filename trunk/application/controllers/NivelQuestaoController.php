<?php
/*
 * Controle de NivelQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class NivelQuestaoController extends Zend_Controller_Action{
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
		$this->NivelQuestaoAction();
	}
	public function nivelquestaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$nivel_questao = new NivelQuestao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$questao 	= new Questao();
			$questao 	= $questao->fetchAll('1','');
			$view->assign("questao",$questao);
			switch($get->action){
				case 'edit':
					$nivel_questao->load($get->id);
					break;
				case 'delete':
					$nivel_questao->load($get->id);
					$nivel_questao->delete();

					$this->_redirect("nivelquestao/nivelquestao");
					die();
			}
			$view->assign("nivel_questao",$nivel_questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","nivelquestao/nivelquestao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$nivel_questao->setQuestaoId($funcao->to_sql($post->questao_id));
			$nivel_questao->setNivel($funcao->to_sql($post->nivel));
			$nivel_questao->setDataNivelamento($funcao->to_sql($post->data_nivelamento));

			if(empty($post->id)){
				// CREATE

				if($nivel_questao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('NivelQuestao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir NivelQuestao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$nivel_questao->setId($post->id);
				$nivel_questao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('NivelQuestao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'nivel_questao',$display_datagrid);
		}
	}
}