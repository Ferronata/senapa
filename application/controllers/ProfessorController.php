<?php
/*
 * Controle de Professor
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class ProfessorController extends Zend_Controller_Action{
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
		$this->ProfessorAction();
	}
	public function professorAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$professor = new Professor();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$pessoa_escola 	= new PessoaEscola();
			$pessoa_escola 	= $pessoa_escola->fetchAll('1','');
			$view->assign("pessoa_escola",$pessoa_escola);
			switch($get->action){
				case 'edit':
					$professor->load($get->pessoa_escola_matricula);
					break;
				case 'delete':
					$professor->load($get->pessoa_escola_matricula);
					$professor->delete();

					$this->_redirect("professor/professor");
					die();
			}
			$view->assign("professor",$professor);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","professor/professor.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_escola_matricula)){
			// SALVA E ATUALIZA REGISTRO
			$professor->setFormacao($funcao->to_sql($post->formacao));
			$professor->setAreaAtuacao($funcao->to_sql($post->area_atuacao));

			if(empty($post->pessoa_escola_matricula)){
				// CREATE

				if($professor->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Professor inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Professor'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$professor->setPessoaEscolaMatricula($post->pessoa_escola_matricula);
				$professor->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Professor modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'professor',$display_datagrid);
		}
	}
}