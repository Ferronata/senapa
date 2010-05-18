<?php
/*
 * Controle de QuestaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class QuestaoAlunoController extends Zend_Controller_Action{
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
		$this->QuestaoAlunoAction();
	}
	public function questaoalunoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$questao_aluno = new QuestaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$questao 	= new Questao();
			$questao 	= $questao->fetchAll('1','');
			$view->assign("questao",$questao);

			$aluno 	= new Aluno();
			$aluno 	= $aluno->fetchAll('1','');
			$view->assign("aluno",$aluno);
			switch($get->action){
				case 'edit':
					$questao_aluno->load($get->id);
					break;
				case 'delete':
					$questao_aluno->load($get->id);
					$questao_aluno->delete();

					$this->_redirect("questaoaluno/questaoaluno");
					die();
			}
			$view->assign("questao_aluno",$questao_aluno);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","questaoaluno/questaoaluno.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$questao_aluno->setAlunoPessoaEscolaMatricula($funcao->to_sql($post->aluno_pessoa_escola_matricula));
			$questao_aluno->setAlunoPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->aluno_pessoa_escola_pessoa_fisica_pessoa_id));
			$questao_aluno->setQuestaoId($funcao->to_sql($post->questao_id));
			$questao_aluno->setInicio($funcao->to_sql($post->inicio));
			$questao_aluno->setTempoResolucao($funcao->to_sql($post->tempo_resolucao));
			$questao_aluno->setResposta($funcao->to_sql($post->resposta));

			if(empty($post->id)){
				// CREATE

				if($questao_aluno->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('QuestaoAluno inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir QuestaoAluno'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$questao_aluno->setId($post->id);
				$questao_aluno->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('QuestaoAluno modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'questao_aluno',$display_datagrid);
		}
	}
}