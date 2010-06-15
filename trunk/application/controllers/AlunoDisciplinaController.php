<?php
/*
 * Controle de AlunoDisciplina
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AlunoDisciplinaController extends Zend_Controller_Action{
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
		$this->AlunoDisciplinaAction();
	}
	public function alunodisciplinaAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$aluno_disciplina = new AlunoDisciplina();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$disciplina 	= new Disciplina();
			$disciplina 	= $disciplina->fetchAll('1','nome');
			$view->assign("disciplina",$disciplina);

			$aluno 	= new Aluno();
			$aluno 	= $aluno->fetchAll('1','');
			$view->assign("aluno",$aluno);
			switch($get->action){
				case 'edit':
					$aluno_disciplina->load($get->id);
					break;
				case 'delete':
					$aluno_disciplina->load($get->id);
					$aluno_disciplina->delete();

					$this->_redirect("alunodisciplina/alunodisciplina");
					die();
			}
			$view->assign("aluno_disciplina",$aluno_disciplina);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","alunodisciplina/alunodisciplina.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$aluno_disciplina->setDisciplinaId($funcao->to_sql($post->disciplina_id));
			$aluno_disciplina->setAlunoPessoaEscolaMatricula($funcao->to_sql($post->aluno_pessoa_escola_matricula));
			$aluno_disciplina->setAlunoPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->aluno_pessoa_escola_pessoa_fisica_pessoa_id));

			if(empty($post->id)){
				// CREATE

				if($aluno_disciplina->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AlunoDisciplina inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AlunoDisciplina'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$aluno_disciplina->setId($post->id);
				$aluno_disciplina->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AlunoDisciplina modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'aluno_disciplina',$display_datagrid);
		}
	}
}