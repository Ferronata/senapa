<?php
/*
 * Controle de DisciplinaAssunto
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class DisciplinaAssuntoController extends Zend_Controller_Action{
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
		$this->DisciplinaAssuntoAction();
	}
	public function disciplinaassuntoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$disciplina_assunto = new DisciplinaAssunto();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$assunto 	= new Assunto();
			$assunto 	= $assunto->fetchAll('1','nome');
			$view->assign("assunto",$assunto);

			$disciplina 	= new Disciplina();
			$disciplina 	= $disciplina->fetchAll('1','nome');
			$view->assign("disciplina",$disciplina);
			switch($get->action){
				case 'edit':
					$disciplina_assunto->load($get->id);
					break;
				case 'delete':
					$disciplina_assunto->load($get->id);
					$disciplina_assunto->delete();

					$this->_redirect("disciplinaassunto/disciplinaassunto");
					die();
			}
			$view->assign("disciplina_assunto",$disciplina_assunto);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","disciplinaassunto/disciplinaassunto.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$disciplina_assunto->setDisciplinaId($funcao->to_sql($post->disciplina_id));
			$disciplina_assunto->setAssuntoId($funcao->to_sql($post->assunto_id));
			$disciplina_assunto->setDataAtribuicao($funcao->to_sql($post->data_atribuicao));

			if(empty($post->id)){
				// CREATE

				if($disciplina_assunto->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('DisciplinaAssunto inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir DisciplinaAssunto'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$disciplina_assunto->setId($post->id);
				$disciplina_assunto->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('DisciplinaAssunto modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'disciplina_assunto',$display_datagrid);
		}
	}
}