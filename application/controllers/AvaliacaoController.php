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
		$this->AvaliacaoAction();
	}
	public function avaliacaoAction(){
		$view = Zend_Registry::get('view');

		$this->acesso($view);

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
			
			foreach($result as $linha){
				$tmp = new NivelQuestao();
				$tmp->lastRegister($linha['questao_id']);
				if($tmp->find($niveis, $tmp) < 0)
					$niveis[] = $tmp;
			}
			$tmp = new NivelQuestao();
			$niveis = $tmp->ordena($niveis);
			
			$view->assign("niveis",$niveis);
			
			$avaliacao_situacao 	= new AvaliacaoSituacao();
			$avaliacao_situacao 	= $avaliacao_situacao->fetchAll('1','nome');
			$view->assign("avaliacao_situacao",$avaliacao_situacao);
			switch($get->action){
				case 'edit':
					$avaliacao->load($get->id);
					break;
				case 'delete':
					$avaliacao->load($get->id);
					$avaliacao->delete();

					$this->_redirect("avaliacao/avaliacao");
					die();
			}
			$view->assign("object",$avaliacao);

			$view->assign("header","html/default/header.tpl");
			$view->assign("body","avaliacao/avaliacao.tpl");
			$view->assign("footer","html/default/footer.tpl");
			$view->output("index.tpl");
		}elseif(isset($post->id)){
			try{
				// SALVA E ATUALIZA REGISTRO
				$avaliacao->setAvaliacaoSituacaoId($funcao->to_sql($post->avaliacao_situacao_id));
				$avaliacao->setNome($funcao->to_sql($post->nome));
				$avaliacao->setDataInicio($funcao->to_sql($post->data_inicio));
				$avaliacao->setHoraIniccio($funcao->to_sql($post->hora_iniccio));
				$avaliacao->setDataFim($funcao->to_sql($post->data_fim));
				$avaliacao->setHoraFim($funcao->to_sql($post->hora_fim));
				$avaliacao->setTempoMinimoProva($funcao->to_sql($post->tempo_minimo_prova));
				$avaliacao->setTempoMaximoProva($funcao->to_sql($post->tempo_maximo_prova));
				$avaliacao->setStatus($funcao->to_sql($post->status));
				$avaliacao->setDateCreate($funcao->to_sql($post->date_create));
				$avaliacao->setDateUpdate($funcao->to_sql($post->date_update));
				$avaliacao->setDateDelete($funcao->to_sql($post->date_delete));
				
				if($post->lista_questoes){
					$lista = $post->lista_questoes;
					foreach($lista as $linha){
						$questao = new Questao();
						$questao->load($linha);
						
						$avaliacao->getListaQuestoes()->addQuestao($questao);
					}
				}
	
				if(empty($post->id)){
					// CREATE

					if($avaliacao->insert())
						$retorno = array('msg' => 'ok', 'display' => htmlentities('Avaliacao inserido com sucesso'), 'url' => '?');
					else
						$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir Avaliacao'));
	
					die($funcao->array2json($retorno));
				}else{
					// UPDATE
					$avaliacao->setId($post->id);
					$avaliacao->update();
					$retorno = array('msg' => 'ok', 'display' => htmlentities('Avaliacao modificado com sucesso'));
					die($funcao->array2json($retorno));
				}
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - INSERT/UPDATE => '.$e))));}
		}else{
			// DATAGRID
			$this->datagrid($view, 'avaliacao',$display_datagrid);
		}
	}
}