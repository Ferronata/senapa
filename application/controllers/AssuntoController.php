<?php
/*
 * Controle de Assunto
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AssuntoController extends Zend_Controller_Action{
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
		$this->AssuntoAction();
	}
	public function assuntoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$assunto = new Assunto();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$disciplina 	= new Disciplina();
			$disciplinas 	= $disciplina->fetchAll("`date_delete` IS NULL","nome");
			$view->assign("disciplinas",$disciplinas);
			
			switch($get->action){
				case 'edit':
					$assunto->load($get->id);
					break;
				case 'delete':
					$assunto->load($get->id);
					$assunto->delete();

					$this->_redirect("assunto/assunto");
					die();
			}
			$view->assign("object",$assunto);
			$view->assign("listaDisciplina",$assunto->getDisciplinas());

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","assunto/assunto.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$assunto->setNome($funcao->to_sql($post->nome));
			
			if(isset($post->lista_disciplina)){
				foreach($post->lista_disciplina as $linha){
					$disciplina = new Disciplina();
					$disciplina->load($linha);
					
					$assunto->getDisciplinas()->addDisciplina($disciplina);
				}
			}

			if(empty($post->id)){
				// CREATE

				if($assunto->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Assunto inserido com sucesso'), 'url' => 'assunto');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Assunto'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$assunto->setId($post->id);
				$assunto->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Assunto modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$funcao->datagrid($view, 'assunto',$display_datagrid,"","Gerenciamento de Assunto");
		}
	}
}