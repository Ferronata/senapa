<?php
/*
 * Controle de Professor
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class ProfessorController extends Zend_Controller_Action{
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
		$this->ProfessorAction();
	}
	public function professorAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$professor = new Professor();
		
		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();
		
		if(isset($get->action)){
			$disciplina 	= new Disciplina();
			$disciplinas 	= $disciplina->fetchAll("`date_delete` IS NULL","nome");
			$view->assign("disciplinas",$disciplinas);
			
			switch($get->action){
				case 'edit':
					$professor->loadId($get->pessoa_escola_pessoa_fisica_pessoa_id);
					break;
				case 'delete':
					$professor->loadId($get->pessoa_escola_pessoa_fisica_pessoa_id);
					$professor->delete();

					$this->_redirect("professor");
					die();
			}
			$view->assign("object",$professor);
			$view->assign("listaDisciplina",$professor->getDisciplinas());

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","professor/professor.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->pessoa_escola_pessoa_fisica_pessoa_id)){
			// SALVA E ATUALIZA REGISTRO
			
			$professor->setNome($funcao->to_sql($post->nome));
			$professor->setEmail($funcao->to_sql($post->email));
			$professor->setSite($funcao->to_sql($post->site));
			
			$professor->setCpf($funcao->to_sql($post->cpf));
			$professor->setDataNascimento($funcao->to_date($post->data_nascimento));
			$professor->setPapelId(3);
			
			$professor->setMatricula($funcao->to_sql($post->pessoa_escola_matricula));			
			$professor->setPessoaEscolaMatricula($funcao->to_sql($post->pessoa_escola_matricula));
			$professor->setSenha($funcao->md5_encrypt($post->senha,MD5_TEXT));

			$professor->setFormacao($funcao->to_sql($post->formacao));
			$professor->setAreaAtuacao($funcao->to_sql($post->area_atuacao));
			
			if(isset($post->lista_disciplina)){
				foreach($post->lista_disciplina as $linha){
					$disciplina = new Disciplina();
					$disciplina->load($linha);
					
					$professor->getDisciplinas()->addDisciplina($disciplina);
				}
			}

			if(empty($post->pessoa_escola_pessoa_fisica_pessoa_id)){
				// CREATE
				
				if($professor->insert())
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Professor inserido com sucesso'), 'url' => 'professor');
				else
					$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir professor'));

				die($funcao->array2json($retorno));
			}else{
				// UPDATE
				$professor->setPessoaEscolaPessoaFisicaPessoaId($post->pessoa_escola_pessoa_fisica_pessoa_id);
				$professor->update();
				$retorno = array('msg' => 'ok', 'display' => htmlentities('Professor modificado com sucesso'));
				die($funcao->array2json($retorno));
			}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'pessoa_escola_matricula'	=>	'Matrícula',
				'pessoa' => array(
								'sigla' => 'B',
								'relacionamento' => array('this'=>'id', 'other'=>'pessoa_escola_pessoa_fisica_pessoa_id'),
								'data' => array('nome'=>'Nome','email'=>'E-mail')
							), 
				'pessoa_fisica' => array(
								'sigla' => 'C',
								'relacionamento' => array('this'=>'pessoa_id', 'other'=>'pessoa_escola_pessoa_fisica_pessoa_id'),
								'data' => array('data_nascimento'=>'Data de Nascimento')
							),
				'formacao'	=>	'Formação',
				'area_atuacao'	=>	'Área de Atuação'
			);
			$where = "";
			
			$funcao->datagrid($view, 'professor',$display_datagrid,$where,"Gerenciamento de Professor");
		}
	}
}