<?php
/*
 * Controle de AssuntoQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AssuntoQuestaoController extends Zend_Controller_Action{
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
		$this->AssuntoQuestaoAction();
	}
	public function assuntoquestaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$assunto_questao = new AssuntoQuestao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$assunto 	= new Assunto();
			$assunto 	= $assunto->fetchAll('1','nome');
			$view->assign("assunto",$assunto);

			$questao 	= new Questao();
			$questao 	= $questao->fetchAll('1','');
			$view->assign("questao",$questao);
			switch($get->action){
				case 'edit':
					$assunto_questao->load($get->id);
					break;
				case 'delete':
					$assunto_questao->load($get->id);
					$assunto_questao->delete();

					$this->_redirect("assuntoquestao/assuntoquestao");
					die();
			}
			$view->assign("assunto_questao",$assunto_questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","assuntoquestao/assuntoquestao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$assunto_questao->setQuestaoId($funcao->to_sql($post->questao_id));
			$assunto_questao->setAssuntoId($funcao->to_sql($post->assunto_id));

			if(empty($post->id)){
				// CREATE

				if($assunto_questao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AssuntoQuestao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AssuntoQuestao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$assunto_questao->setId($post->id);
				$assunto_questao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AssuntoQuestao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'assunto_questao',$display_datagrid);
		}
	}
}