<?php
/*
 * Controle de Questao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class QuestaoController extends Zend_Controller_Action{
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
		$this->QuestaoAction();
	}
	public function questaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

		$questao = new Questao();

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
					$questao->load($get->id);
					
					$tmpAssunto = new Assunto();
					$tmpAssunto->load($questao->getAssuntoQuestao()->getAssuntoId());
					
					$assuntos = $tmpAssunto->fetchAll("`date_delete` IS NULL AND `id` IN (SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$questao->getDisciplina()->getId()."')","nome");
					
					$view->assign("assuntos",$assuntos);
					
					break;
				case 'delete':
					$questao->load($get->id);
					$questao->delete();

					$this->_redirect("questao/questao");
					die();
			}
			
			$alternativas = $questao->getAlternativas();
			
			$view->assign("disciplina",$questao->getDisciplina());
			$view->assign("alternativas",$alternativas);
			$view->assign("assuntoQuestao",$questao->getAssuntoQuestao());
			$view->assign("nivelQuestao",$questao->getNivelQuestao());
					
			$view->assign("object",$questao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","questao/questao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			try{
				// SALVA E ATUALIZA REGISTRO
				$questao->setDescricao($funcao->to_sql($post->descricao));
				$questao->setDescricaoResposta($funcao->to_sql($post->descricao_resposta));
				
				$assuntoQuestao = new AssuntoQuestao();
				$assuntoQuestao->setAssuntoId($post->Assunto);
				
				$questao->setAssuntoQuestao($assuntoQuestao);
				
				$questao->setAlternativas(new ListaAlternativa());
				
				if(!empty($post->nivel)){
					$questao->getNivelQuestao()->setNivel($post->nivel);
					$questao->getNivelQuestao()->setDataNivelamento(date("Y-m-d H:i:s"));
				}
				if(isset($post->lista_alternativa_id)){
					$lista = $post->lista_alternativa_id;
					
					$questao->setResposta(0);
					if($post->lista_radio>=0)
						$questao->setResposta($post->lista_radio);
						
					foreach($lista as $linha){
						$alternativa = new QuestaoAlternativa();
						$alternativa->load($linha);
						
						$questao->getAlternativas()->addAlternativa($alternativa);
					}
				}
				if(isset($post->lista_alternativa_descricao)){
					$lista = $post->lista_alternativa_descricao;
					$resp = ($post->lista_radio<0)?($post->lista_radio*(-1)):""; 
					foreach($lista as $key => $linha){
						$alternativa = new QuestaoAlternativa();
						$alternativa->setDescricao($linha);
						if(($key+1) == $resp)
							$alternativa->setResposta(true);
						
						$questao->getAlternativas()->addAlternativa($alternativa);
					}
				}
	
				if(empty($post->id)){
					// CREATE
	
					if($questao->insert())
						$retorno = array('msg' => 'ok', 'display' => htmlentities('Questao inserido com sucesso'), 'url' => 'questao');
					else
						$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Questao'));
	
					die($funcao->array2json($retorno));
				}else{
					// UPDATE
					$questao->setId($post->id);
					$questao->update();
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Questao modificado com sucesso'));
					die($funcao->array2json($retorno));
				}
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - INSERT/UPDATE => '.$e))));}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'descricao'			=>	'Questão', 
				'questao_alternativa' 	=> array(
									'subconsulta' => array('this'=>'id', 'other'=>'resposta'),
									'data' => array('descricao'=>'Resposta')
								),
				'nivel_questao' 	=> array(
									'subconsulta' => array('this'=>'questao_id', 'other'=>'id'),
									'complement' => 'ORDER BY `data_nivelamento` DESC',
									'data' => array('nivel'=>'Nível Atual')
								),
				'descricao_resposta'	=>	'Explicação da Resposta'
			);
			$where = "A.`date_delete` IS NULL";
			
			$funcao->datagrid($view, 'questao',$display_datagrid,$where,"Gerenciamento de Questão");
		}
	}
}