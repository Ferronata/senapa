<?php
/*
 * Controle de UsabilidadeQuestao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class UsabilidadeQuestaoController extends Zend_Controller_Action{
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
		$this->UsabilidadeQuestaoAction();
	}
	public function usabilidadequestaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$usabilidade_questao = new UsabilidadeQuestao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$questao_alternativa 	= new QuestaoAlternativa();
			$questao_alternativa 	= $questao_alternativa->fetchAll('1','');
			$view->assign("questao_alternativa",$questao_alternativa);

			$professor 	= new Professor();
			$professor 	= $professor->fetchAll('1','');
			$view->assign("professor",$professor);

			$avaliacao 	= new Avaliacao();
			$avaliacao 	= $avaliacao->fetchAll('1','nome');
			$view->assign("avaliacao",$avaliacao);
			switch($get->action){
				case 'edit':
					$usabilidade_questao->load($get->id);
					break;
				case 'delete':
					$usabilidade_questao->load($get->id);
					$usabilidade_questao->delete();

					$this->_redirect("usabilidadequestao/usabilidadequestao");
					die();
			}
			$view->assign("usabilidade_questao",$usabilidade_questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","usabilidadequestao/usabilidadequestao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			// SALVA E ATUALIZA REGISTRO
			$usabilidade_questao->setAvaliacaoId($funcao->to_sql($post->avaliacao_id));
			$usabilidade_questao->setProfessorPessoaEscolaMatricula($funcao->to_sql($post->professor_pessoa_escola_matricula));
			$usabilidade_questao->setProfessorPessoaEscolaPessoaFisicaPessoaId($funcao->to_sql($post->professor_pessoa_escola_pessoa_fisica_pessoa_id));
			$usabilidade_questao->setQuestaoAlternativaId($funcao->to_sql($post->questao_alternativa_id));
			$usabilidade_questao->setDataEscolha($funcao->to_sql($post->data_escolha));

			if(empty($post->id)){
				// CREATE

				if($usabilidade_questao->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('UsabilidadeQuestao inserido com sucesso'), 'url' => '?');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir UsabilidadeQuestao'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$usabilidade_questao->setId($post->id);
				$usabilidade_questao->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('UsabilidadeQuestao modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'usabilidade_questao',$display_datagrid);
		}
	}
}