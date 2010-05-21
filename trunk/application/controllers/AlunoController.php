<?php
/*
 * Controle de Aluno
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AlunoController extends Zend_Controller_Action{
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
		$this->AlunoAction();
	}
	public function alunoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$aluno = new Aluno();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			switch($get->action){
				case 'edit':
					$aluno->load($get->pessoa_escola_matricula);
					break;
				case 'delete':
					$aluno->load($get->pessoa_escola_matricula);
					$aluno->delete();

					$this->_redirect("aluno/aluno");
					die();
			}
			$view->assign("object",$aluno);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","aluno/aluno.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_escola_pessoa_fisica_pessoa_id)){
			// SALVA E ATUALIZA REGISTRO
			
			$aluno->setNome($funcao->to_sql($post->nome));
			$aluno->setEmail($funcao->to_sql($post->email));
			$aluno->setSite($funcao->to_sql($post->site));
			
			$aluno->setCpf($funcao->to_sql($post->cpf));
			$aluno->setDataNascimento($funcao->to_date($post->data_nascimento));
			$aluno->setPapelId(4);
			
			$aluno->setMatricula($funcao->to_sql($post->pessoa_escola_matricula));			
			$aluno->setPessoaEscolaMatricula($funcao->to_sql($post->pessoa_escola_matricula));
			$aluno->setSenha($funcao->md5_encrypt($post->senha,MD5_TEXT));
			
			$aluno->setAreaInterece($funcao->to_sql($post->area_interece));

			if(empty($post->pessoa_escola_pessoa_fisica_pessoa_id)){
				// CREATE

				if($aluno->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Aluno inserido com sucesso'), 'url' => 'aluno');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Aluno'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$aluno->setPessoaEscolaPessoaFisicaPessoaId($post->pessoa_escola_pessoa_fisica_pessoa_id);
				$aluno->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Aluno modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$this->datagrid($view, 'aluno',$display_datagrid);
		}
	}
}