<?php
/*
 * Controle de Disciplina
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class DisciplinaController extends Zend_Controller_Action{
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
		$this->DisciplinaAction();
	}
	public function disciplinaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$disciplina = new Disciplina();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){			switch($get->action){
				case 'edit':
					$disciplina->load($get->id);
					break;
				case 'delete':
					$disciplina->load($get->id);
					$disciplina->delete();

					$this->_redirect("disciplina/disciplina");
					die();
			}
			$view->assign("disciplina",$disciplina);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","disciplina/disciplina.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$disciplina->setCodigo($funcao->to_sql($post->codigo));
			$disciplina->setNome($funcao->to_sql($post->nome));
			$disciplina->setDateCreate($funcao->to_sql($post->date_create));
			$disciplina->setDateUpdate($funcao->to_sql($post->date_update));
			$disciplina->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($disciplina->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Disciplina inserida com sucesso'), 'url' => 'disciplina');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir disciplina'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$disciplina->setId($post->id);
				$disciplina->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Disciplina modificada com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'codigo'		=>	'C�digo',
				'nome'			=>	'Assunto', 
				'date_create'	=>	'Data de Cria��o',
				'date_update'	=>	'Ultima Atualiza��o'
			);
			$where = "`date_delete` IS NULL";
			
			$funcao->datagrid($view, 'disciplina',$display_datagrid,$where,"Gerenciamento de Disciplina");
		}
	}
}