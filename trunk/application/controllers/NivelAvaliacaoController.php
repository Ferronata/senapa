<?php
/*
 * Controle de NivelAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class NivelAvaliacaoController extends Zend_Controller_Action{
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
		$this->NivelAvaliacaoAction();
	}
	public function nivelavaliacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$nivel_avaliacao = new NivelAvaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$professor_avaliacao 	= new ProfessorAvaliacao();
			$professor_avaliacao 	= $professor_avaliacao->fetchAll('1','');
			$view->assign("professor_avaliacao",$professor_avaliacao);
			switch($get->action){
				case 'edit':
					$nivel_avaliacao->load($get->nivel);
					break;
				case 'delete':
					$nivel_avaliacao->load($get->nivel);
					$nivel_avaliacao->delete();

					$this->_redirect("nivelavaliacao/nivelavaliacao");
					die();
			}
			$view->assign("nivel_avaliacao",$nivel_avaliacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","nivelavaliacao/nivelavaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->nivel)){
			// SALVA E ATUALIZA REGISTRO
			$nivel_avaliacao->setProfessorAvaliacaoId($funcao->to_sql($post->professor_avaliacao_id));
			$nivel_avaliacao->setDataNivelamento($funcao->to_sql($post->data_nivelamento));

			if(empty($post->nivel)){
				// CREATE

				if($nivel_avaliacao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('NivelAvaliacao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir NivelAvaliacao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$nivel_avaliacao->setNivel($post->nivel);
				$nivel_avaliacao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('NivelAvaliacao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'nivel_avaliacao',$display_datagrid);
		}
	}
}