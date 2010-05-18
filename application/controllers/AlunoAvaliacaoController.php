<?php
/*
 * Controle de AlunoAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AlunoAvaliacaoController extends Zend_Controller_Action{
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
		$this->AlunoAvaliacaoAction();
	}
	public function alunoavaliacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$aluno_avaliacao = new AlunoAvaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$aluno 	= new Aluno();
			$aluno 	= $aluno->fetchAll('1','');
			$view->assign("aluno",$aluno);

			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);
			switch($get->action){
				case 'edit':
					$aluno_avaliacao->load($get->id);
					break;
				case 'delete':
					$aluno_avaliacao->load($get->id);
					$aluno_avaliacao->delete();

					$this->_redirect("alunoavaliacao/alunoavaliacao");
					die();
			}
			$view->assign("aluno_avaliacao",$aluno_avaliacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","alunoavaliacao/alunoavaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$aluno_avaliacao->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));
			$aluno_avaliacao->setAlunoPessoaEscolaMatricula($funcao->to_sql($post->aluno_pessoa_escola_matricula));
			$aluno_avaliacao->setAlunoPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->aluno_pessoa_escola_pessoa_fisica_pessoa_id));
			$aluno_avaliacao->setDataAcesso($funcao->to_sql($post->data_acesso));
			$aluno_avaliacao->setDateCreate($funcao->to_sql($post->date_create));
			$aluno_avaliacao->setDateUpdate($funcao->to_sql($post->date_update));
			$aluno_avaliacao->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($aluno_avaliacao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('AlunoAvaliacao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir AlunoAvaliacao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$aluno_avaliacao->setId($post->id);
				$aluno_avaliacao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('AlunoAvaliacao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'aluno_avaliacao',$display_datagrid);
		}
	}
}