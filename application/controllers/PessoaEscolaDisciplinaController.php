<?php
/*
 * Controle de PessoaEscolaDisciplina
 * Data de Cricação - 23/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class PessoaEscolaDisciplinaController extends Zend_Controller_Action{
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
		$this->PessoaEscolaDisciplinaAction();
	}
	public function pessoaescoladisciplinaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$pessoa_escola_disciplina = new PessoaEscolaDisciplina();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$disciplina 	= new Disciplina();
			$disciplina 	= $disciplina->fetchAll('1','nome');
			$view->assign("disciplina",$disciplina);

			$pessoa_escola 	= new PessoaEscola();
			$pessoa_escola 	= $pessoa_escola->fetchAll('1','');
			$view->assign("pessoa_escola",$pessoa_escola);
			switch($get->action){
				case 'edit':
					$pessoa_escola_disciplina->load($get->id);
					break;
				case 'delete':
					$pessoa_escola_disciplina->load($get->id);
					$pessoa_escola_disciplina->delete();

					$this->_redirect("pessoaescoladisciplina/pessoaescoladisciplina");
					die();
			}
			$view->assign("pessoa_escola_disciplina",$pessoa_escola_disciplina);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","pessoaescoladisciplina/pessoaescoladisciplina.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$pessoa_escola_disciplina->setPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->pessoa_escola_pessoa_fisica_pessoa_id));
			$pessoa_escola_disciplina->setPessoaEscolaMatricula($funcao->to_sql($post->pessoa_escola_matricula));
			$pessoa_escola_disciplina->setDisciplinaId($funcao->to_sql($post->disciplina_id));

			if(empty($post->id)){
				// CREATE

				if($pessoa_escola_disciplina->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaEscolaDisciplina inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir PessoaEscolaDisciplina'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$pessoa_escola_disciplina->setId($post->id);
				$pessoa_escola_disciplina->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('PessoaEscolaDisciplina modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'pessoa_escola_disciplina',$display_datagrid);
		}
	}
}