<?php
/*
 * Controle de ProfessorDisciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class ProfessorDisciplinaController extends Zend_Controller_Action{
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
		$this->ProfessorDisciplinaAction();
	}
	public function professordisciplinaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$professor_disciplina = new ProfessorDisciplina();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$professor 	= new Professor();
			$professor 	= $professor->fetchAll('1','');
			$view->assign("professor",$professor);

			$disciplina 	= new Disciplina();
			$disciplina 	= $disciplina->fetchAll('1','nome');
			$view->assign("disciplina",$disciplina);
			switch($get->action){
				case 'edit':
					$professor_disciplina->load($get->id);
					break;
				case 'delete':
					$professor_disciplina->load($get->id);
					$professor_disciplina->delete();

					$this->_redirect("professordisciplina/professordisciplina");
					die();
			}
			$view->assign("professor_disciplina",$professor_disciplina);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","professordisciplina/professordisciplina.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$professor_disciplina->setDisciplinaId($funcao->to_sql($post->disciplina_id));
			$professor_disciplina->setProfessorPessoaEscolaMatricula($funcao->to_sql($post->professor_pessoa_escola_matricula));
			$professor_disciplina->setProfessorPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->professor_pessoa_escola_pessoa_fisica_pessoa_id));

			if(empty($post->id)){
				// CREATE

				if($professor_disciplina->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('ProfessorDisciplina inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir ProfessorDisciplina'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$professor_disciplina->setId($post->id);
				$professor_disciplina->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('ProfessorDisciplina modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'professor_disciplina',$display_datagrid);
		}
	}
}