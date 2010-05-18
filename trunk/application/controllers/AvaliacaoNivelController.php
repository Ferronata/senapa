<?php
/*
 * Controle de AvaliacaoNivel
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoNivelController extends Zend_Controller_Action{
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
		$this->AvaliacaoNivelAction();
	}
	public function avaliacaonivelAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$avaliacao_nivel = new AvaliacaoNivel();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);
			switch($get->action){
				case 'edit':
					$avaliacao_nivel->load($get->id);
					break;
				case 'delete':
					$avaliacao_nivel->load($get->id);
					$avaliacao_nivel->delete();

					$this->_redirect("avaliacaonivel/avaliacaonivel");
					die();
			}
			$view->assign("avaliacao_nivel",$avaliacao_nivel);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacaonivel/avaliacaonivel.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$avaliacao_nivel->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));
			$avaliacao_nivel->setNivel($funcao->to_sql($post->nivel));
			$avaliacao_nivel->setDataNivelamento($funcao->to_sql($post->data_nivelamento));

			if(empty($post->id)){
				// CREATE

				if($avaliacao_nivel->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoNivel inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AvaliacaoNivel'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$avaliacao_nivel->setId($post->id);
				$avaliacao_nivel->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoNivel modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'avaliacao_nivel',$display_datagrid);
		}
	}
}