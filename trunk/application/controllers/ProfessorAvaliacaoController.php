<?php
/*
 * Controle de ProfessorAvaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class ProfessorAvaliacaoController extends Zend_Controller_Action{
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
		$this->ProfessorAvaliacaoAction();
	}
	public function professoravaliacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$professor_avaliacao = new ProfessorAvaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$professor 	= new Professor();
			$professor 	= $professor->fetchAll('1','');
			$view->assign("professor",$professor);

			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);
			switch($get->action){
				case 'edit':
					$professor_avaliacao->load($get->id);
					break;
				case 'delete':
					$professor_avaliacao->load($get->id);
					$professor_avaliacao->delete();

					$this->_redirect("professoravaliacao/professoravaliacao");
					die();
			}
			$view->assign("professor_avaliacao",$professor_avaliacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","professoravaliacao/professoravaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$professor_avaliacao->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));
			$professor_avaliacao->setProfessorPessoaEscolaMatricula($funcao->to_sql($post->professor_pessoa_escola_matricula));
			$professor_avaliacao->setProfessorPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->professor_pessoa_escola_pessoa_fisica_pessoa_id));
			$professor_avaliacao->setDataCadastro($funcao->to_sql($post->data_cadastro));
			$professor_avaliacao->setDateCreate($funcao->to_sql($post->date_create));
			$professor_avaliacao->setDateUpdate($funcao->to_sql($post->date_update));
			$professor_avaliacao->setDateDelete($funcao->to_sql($post->date_delete));

			if(empty($post->id)){
				// CREATE

				if($professor_avaliacao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('ProfessorAvaliacao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir ProfessorAvaliacao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$professor_avaliacao->setId($post->id);
				$professor_avaliacao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('ProfessorAvaliacao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'professor_avaliacao',$display_datagrid);
		}
	}
}