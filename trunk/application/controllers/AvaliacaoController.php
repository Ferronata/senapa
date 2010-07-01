<?php
/*
 * Controle de Avaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.controllers
 * @version 1.0
 */
class AvaliacaoController extends Zend_Controller_Action{
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
		$this->AvaliacaoAction();
	}
	public function avaliacaoAction(){
		$view 		= Zend_Registry::get('view');
		$session 	= Zend_Registry::get('session');
		
		$this->acesso($view);
		
		$usuario = $session->usuario;
		$view->assign("usuario",$usuario);
		
		$avaliacao = new Avaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		$display_datagrid = array();

		if(isset($get->action)){
			$disciplina 	= new Disciplina();
			$disciplinas 	= $disciplina->fetchAll("`date_delete` IS NULL","nome");
			$view->assign("disciplinas",$disciplinas);
			
			$db = $avaliacao->getAdapter();			
			$select = $db->select()->from("nivel_questao")->group('questao_id');			
			$result = $db->fetchAll($select);
			
			$niveis = array();
			
			$pessoa_fisica = new PessoaFisica();
			$qr = "papel_id = '".$pessoa_fisica->ENUM('P_PROFESSOR')."' AND `pessoa_id` IN (SELECT `id` FROM pessoa WHERE `date_delete` IS NULL)";
			$tmp = $pessoa_fisica->fetchAll($qr);
			$professores = array();

			foreach($tmp as $linha){
				$pessoa_fisica = new PessoaEscola();
				$pessoa_fisica->load($linha->pessoa_id);
				$professores[] = $pessoa_fisica;
			}
			$view->assign("professores",$professores);	
			
			foreach($result as $linha){
				$tmp = new NivelQuestao();
				$tmp->lastRegister($linha['questao_id']);
				if($tmp->find($niveis, $tmp) < 0)
					$niveis[] = $tmp;
			}
			$tmp = new NivelQuestao();
			$niveis = $tmp->ordena($niveis);
			
			$view->assign("niveis",$niveis);
			
			$assuntos = array();
			
			$avaliacao_situacao 	= new AvaliacaoSituacao();
			$avaliacao_situacao 	= $avaliacao_situacao->fetchAll('1','nome');
			$view->assign("avaliacao_situacao",$avaliacao_situacao);
			switch($get->action){
				case 'edit':
					$avaliacao->load($get->id);
					
					$tmp = new NivelQuestao();
					foreach($avaliacao->getListaQuestoes()->getListaQuestao() as $linha){
						$tmp->lastRegister($linha->getId());
						$pos = $tmp->find($niveis,$tmp);
						if($pos >= 0)
							$niveis[$pos]->setExiste(true);
					}
					
					if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
						$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
						$disciplina->load($tmp[0]->getId());
					}
					
					$assunto = new Assunto();
					$lista = $assunto->fetchAll("`id` IN (SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$disciplina->getId()."')");
					foreach($lista as $linha){
						$tmp = new Assunto();
						$tmp->load($linha->id);
						$assuntos[] = $tmp;
					}
					
					$lista = $assunto->fetchAll("`id` IN (SELECT `assunto_id` FROM `assunto_questao` WHERE `questao_id` IN (SELECT `questao_id` FROM `avaliacao_questao` WHERE `avaliacao_id` = '".$avaliacao->getId()."' ))");
					foreach($lista as $linha){
						$assunto->load($linha->id);
						$pos = $tmp->find($assuntos,$assunto);
						if($pos >= 0)
							$assuntos[$pos]->setExiste(true);
					}
					
					break;
				case 'delete':
					$avaliacao->load($get->id);
					$avaliacao->delete();

					$this->_redirect("avaliacao/avaliacao");
					die();
			}
			$view->assign("object",$avaliacao);

			$view->assign("professor",$avaliacao->getProfessor());
			$view->assign("disciplina",$disciplina);
			$view->assign("assuntos",$assuntos);
			$view->assign("listaQuestao",$avaliacao->getListaQuestoes());
			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacao/avaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			try{
				// SALVA E ATUALIZA REGISTRO
				$avaliacao->setAvaliacaoSituacaoId($funcao->to_sql($post->avaliacao_situacao_id));
				$avaliacao->setNome($funcao->to_sql($post->nome));
				$avaliacao->setDataInicio($funcao->to_date($post->data_inicio));
				$avaliacao->setHoraIniccio($funcao->to_sql($post->hora_iniccio));
				$avaliacao->setDataFim($funcao->to_date($post->data_fim));
				$avaliacao->setHoraFim($funcao->to_sql($post->hora_fim));
				$avaliacao->setTempoMinimoProva($funcao->to_sql($post->tempo_minimo_prova));
				$avaliacao->setTempoMaximoProva($funcao->to_sql($post->tempo_maximo_prova));
				$avaliacao->setStatus($funcao->to_sql($post->status));
				
				if($post->tpPesqusia == $avaliacao->ENUM('QUESTAO')){
					if($post->lista_questoes){
						$lista = $post->lista_questoes;
						foreach($lista as $linha){
							$questao = new Questao();
							$questao->load($linha);
							$avaliacao->getListaQuestoes()->addQuestao($questao);
						}
					}					
				}else if($post->tpPesqusia == $avaliacao->ENUM('AVALIACAO')){
					$idAvEsq = $post->avaliacaoEscolhidaId;
					$tmpAv = $avaliacao->clonarAvaliacao($idAvEsq);
					if($tmpAv->getNome())
						$avaliacao = $tmpAv;
					
				}
				
				$pessoa_escola = new PessoaEscola();
				$pessoa_escola->load($post->professor);
				
				$professor = new Professor();
				$professor->load($pessoa_escola->getMatricula());
				
				$avaliacao->setProfessor($professor);
					
				if(empty($post->id)){
					// CREATE

					if($avaliacao->insert())
						$retorno = array('msg' => 'ok', 'display' => htmlentities('Avaliação inserida com sucesso'), 'url' => 'avaliacao/avaliacao');
					else
						$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Avaliação'));
	
					die($funcao->array2json($retorno));
				}else{
					// UPDATE
					$avaliacao->setId($post->id);
					$avaliacao->update();
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Avaliação modificada com sucesso'));
					die($funcao->array2json($retorno));
				}
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - INSERT/UPDATE => '.$e))));}
		}else{
			// DATAGRID
			$display_datagrid = array(
				'nome'			=>	'Nome', 
				'data_inicio'	=>	'Data de Disponibilização',
				'hora_iniccio'	=>	'Hora de Início',
				'data_fim'		=>	'Data de Encerramento',
				'hora_fim'		=>	'Hora de Fim',
				'tempo_minimo_prova'	=>	'Tempo Mínimo',
				'tempo_maximo_prova'	=>	'Tempo Máximo',
				'status'		=>	'Disponibilidade'
			);
			$where = "`date_delete` IS NULL";
			if($usuario->getPapelId() == $usuario->ENUM('P_PROFESSOR'))
				$where .= " AND `id` IN (SELECT `avaliacao_id` FROM `professor_avaliacao` WHERE `professor_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."')";
			$funcao->datagrid($view,'avaliacao',$display_datagrid,$where,"Gerencimento de Avaliação");
		}
	}
}