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
		$this->alunoavaliacaoAction();
	}
	public function alunoavaliacaoAction(){
		$view = Zend_Registry::get('view');
		$session = Zend_Registry::get('session');
		
		$pessoa_escola = new PessoaEscola();
		
		// ALUNO
		$pessoa_escola->load(12);

		$session->usuario = $pessoa_escola;
		
		$usuario = $session->usuario;

		$this->acesso($view);

		$aluno_avaliacao = new AlunoAvaliacao();

		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');

		$funcao 	= new FuncoesProjeto();
		
		//$session->avaliacao = NULL;
		if(empty($session->avaliacao)){
			
			$avaliacao = new Avaliacao();
			$avaliacao->load(1);

			$disciplina = new Disciplina();
			if(sizeof($avaliacao->getListaQuestoes()->getListaQuestao())){
				$tmp = $avaliacao->getListaQuestoes()->getListaQuestao();
				$disciplina = $tmp[0]->getDisciplina();
			}
			
			$session->avaliacao 	= $avaliacao;
			$session->disciplina 	= $disciplina;
			
			$session->time			= "00:00:00";
			
			$session->inicio	 	= true;
			$session->questaoAtual 	= NULL;
			
			$this->sessionQuestion();
		}
		
		$view->assign("session",$session);
		$view->assign("time",$session->time);
		$view->assign("avaliacao",$session->avaliacao);
		$view->assign("disciplina",$session->disciplina);
		$view->assign("questoes",$session->avaliacao->getListaQuestoes()->getListaQuestao());
		$view->assign("questaoAtual",$session->questaoAtual);
		
		if(isset($get->action)){

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
		}
	}
	function sessionQuestion(){
		$session = Zend_Registry::get('session');
		
		if(empty($session->listaAlunoResolveQuestao))
				$session->listaAlunoResolveQuestao = new ListaAlunoResolveQuestao();
		
		$cont = 1;
		if(!empty($session->questaoAtual))
			$cont = $session->questaoAtual['numero']+1;
		if($cont <= sizeof($session->listaAlunoResolveQuestao->getListaAlunoResolveQuestao())){
			$questoes = $session->avaliacao->getListaQuestoes()->getListaQuestao();			
			$questao = $questoes[($cont-1)];
			
			$session->alunoResolveQuestao = new AlunoResolveQuestao();
			$session->alunoResolveQuestao->setPessoaId($session->usuario->getId());
			$session->alunoResolveQuestao->setAvaliacaoId($session->avaliacao->getId());
			$session->alunoResolveQuestao->setDisciplinaId($session->disciplina->getId());
			$session->alunoResolveQuestao->setQuestaoId($questao->getId());
			$session->alunoResolveQuestao->setInicio(date('H:i:s'));
			$session->alunoResolveQuestao->insert();
			
			$session->questaoAtual 	= array('numero' => $cont,'questao' => $questao,'alunoResolveQuestaoId' => $session->alunoResolveQuestao->getId());
				
			$session->listaAlunoResolveQuestao->add($session->alunoResolveQuestao);
		}
	}
	public function timeAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		$post 	= Zend_Registry::get('post');
		$get 	= Zend_Registry::get('get');
		
		if(!isset($session->time))
			$session->time = "00:00:00";
		else{
			$time = $session->time;
			$hh = (int) substr($time,0,2);
			$mm = (int) substr($time,3,2);
			$ss = (int) substr($time,6,2);
			
			$ss += 1;
			if($ss == 60){
		    	$ss = 0;
		    	$mm += 1;
		    }
		    if($mm == 60){
		        $mm = 0;
		        $hh += 1;
		    }
		
		    $h = $hh;
		    $m = $mm;
		    $s = $ss;
		
		    if($h < 10)
		        $h = "0".$h;
		    if($m < 10)
		        $m = "0".$m;
		    if($s < 10)
		        $s = "0".$s;
		   
		    $session->time = $h.":".$m.":".$s;
		}
		$view->assign("time",$session->time);
		$view->output("time.tpl");
	}
	public function nextAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		$post 	= Zend_Registry::get('post');
		try{
			$funcao 	= new FuncoesProjeto();
			
			$session->inicio = false;
			
			$resp = "";
			if(!empty($post->resposta))
				$resp = $post->resposta;
			
			$resp = $funcao->to_sql($resp);
			
			$questaoAtual = $session->questaoAtual;
			
			$id = $questaoAtual['alunoResolveQuestaoId'];
			
			$tmp = new AlunoResolveQuestao();
			$tmp->load($id);
			
			$id = $session->listaAlunoResolveQuestao->find($tmp);
			$value = $session->listaAlunoResolveQuestao->getListaAlunoResolveQuestao();
			if(!$value[$id]->getFim()){
				$value[$id]->setFim(date('H:i:s'));
				$tmp->setFim(date('H:i:s'));
			}
			$value[$id]->setRespostaId($resp);
			$tmp->setRespostaId($resp);

			$pp = $session->listaAlunoResolveQuestao->update($id,$value[$id]);
			
			//print $pp->toString();
			
			$tmp->update($array,"id = '".$tmp->getId()."'");
			$this->sessionQuestion();
			
			die($funcao->array2json(array('url' => 'alunoavaliacao')));
		}catch(Exception $e){die($funcao->array2json(array('msg' => 'error', 'display' => htmlentities('Erro fatal - UPDATE => '.$e))));}
	}
	public function backAction(){
		$session = Zend_Registry::get('session');
		$view 	= Zend_Registry::get('view');
		
		$view->assign("time",$session->time);
		$view->output("time.tpl");
	}
}