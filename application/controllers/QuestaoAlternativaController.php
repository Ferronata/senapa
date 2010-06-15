<?php
/*
 * Controle de QuestaoAlternativa
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class QuestaoAlternativaController extends Zend_Controller_Action{
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
		$this->QuestaoAlternativaAction();
	}
	public function questaoalternativaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$questao_alternativa = new QuestaoAlternativa();

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
					$questao_alternativa->load($get->id);
					break;
				case 'delete':
					$questao_alternativa->load($get->id);
					$questao_alternativa->delete();

					$this->_redirect("questaoalternativa/questaoalternativa");
					die();
			}
			$view->assign("questao_alternativa",$questao_alternativa);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","questaoalternativa/questaoalternativa.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$questao_alternativa->setQuestaoId($funcao->to_sql($post->questao_id));
			$questao_alternativa->setDescricao($funcao->to_sql($post->descricao));
			$questao_alternativa->setDateCreate($funcao->to_sql($post->date_create));
			$questao_alternativa->setDateUpdate($funcao->to_sql($post->date_update));
			$questao_alternativa->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($questao_alternativa->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('QuestaoAlternativa inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir QuestaoAlternativa'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$questao_alternativa->setId($post->id);
				$questao_alternativa->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('QuestaoAlternativa modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'questao_alternativa',$display_datagrid);
		}
	}
}