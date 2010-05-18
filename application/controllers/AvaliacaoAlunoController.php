<?php
/*
 * Controle de AvaliacaoAluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoAlunoController extends Zend_Controller_Action{
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
		$this->AvaliacaoAlunoAction();
	}
	public function avaliacaoalunoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$avaliacao_aluno = new AvaliacaoAluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);

			$aluno 	= new Aluno();
			$aluno 	= $aluno->fetchAll('1','');
			$view->assign("aluno",$aluno);
			switch($get->action){
				case 'edit':
					$avaliacao_aluno->load($get->id);
					break;
				case 'delete':
					$avaliacao_aluno->load($get->id);
					$avaliacao_aluno->delete();

					$this->_redirect("avaliacaoaluno/avaliacaoaluno");
					die();
			}
			$view->assign("avaliacao_aluno",$avaliacao_aluno);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacaoaluno/avaliacaoaluno.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$avaliacao_aluno->setAlunoPessoaEscolaMatricula($funcao->to_sql($post->aluno_pessoa_escola_matricula));
			$avaliacao_aluno->setAlunoPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->aluno_pessoa_escola_pessoa_fisica_pessoa_id));
			$avaliacao_aluno->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));
			$avaliacao_aluno->setDataInicio($funcao->to_sql($post->data_inicio));
			$avaliacao_aluno->setHoraInicio($funcao->to_sql($post->hora_inicio));
			$avaliacao_aluno->setHoraFim($funcao->to_sql($post->hora_fim));

			if(empty($post->id)){
				// CREATE

				if($avaliacao_aluno->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoAluno inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AvaliacaoAluno'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$avaliacao_aluno->setId($post->id);
				$avaliacao_aluno->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AvaliacaoAluno modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'avaliacao_aluno',$display_datagrid);
		}
	}
}