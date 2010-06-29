<?php
/**
 * Modelo da classe Avaliacao
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

require_once 'DAO.php';
require_once 'ListaQuestao.php';
require_once 'FuncoesProjeto.php';

class Avaliacao extends DAO {
	protected $_name = 'avaliacao';
	private $id;
	private $avaliacaoSituacaoId;
	private $nome;
	private $dataInicio;
	private $horaIniccio;
	private $dataFim;
	private $horaFim;
	private $tempoMinimoProva;
	private $tempoMaximoProva;
	private $status;
	
	private $listaQuestoes;
	private $professor;
	private $professorAvaliacao;
	private $disciplina;
	private $nivel;
	private $nivelProposto;

	public function getId(){return $this->id;}
	public function setId($var){$this->id = $var;}

	public function getAvaliacaoSituacaoId(){return $this->avaliacaoSituacaoId;}
	public function setAvaliacaoSituacaoId($var){$this->avaliacaoSituacaoId = $var;}

	public function getNome(){return $this->nome;}
	public function setNome($var){$this->nome = $var;}

	public function getDataInicio(){return $this->dataInicio;}
	public function setDataInicio($var){$this->dataInicio = $var;}

	public function getHoraIniccio(){return $this->horaIniccio;}
	public function setHoraIniccio($var){$this->horaIniccio = $var;}

	public function getDataFim(){return $this->dataFim;}
	public function setDataFim($var){$this->dataFim = $var;}

	public function getHoraFim(){return $this->horaFim;}
	public function setHoraFim($var){$this->horaFim = $var;}

	public function getTempoMinimoProva(){return $this->tempoMinimoProva;}
	public function setTempoMinimoProva($var){$this->tempoMinimoProva = $var;}

	public function getTempoMaximoProva(){return $this->tempoMaximoProva;}
	public function setTempoMaximoProva($var){$this->tempoMaximoProva = $var;}

	public function getStatus(){return $this->status;}
	public function setStatus($var){$this->status = $var;}
	
	public function getDisciplina(){return $this->disciplina;}
	public function setDisciplina($var){$this->disciplina = $var;}
	
	public function getNivel(){
		if(empty($this->nivel))
			$this->setNivel(new NivelAvaliacao());
		return $this->nivel;
	}
	public function setNivel($var){
		if(empty($var))
			$var = new NivelAvaliacao();
		$this->nivel = $var;
	}
	public function getNivelProposto(){
		if(empty($this->nivelProposto))
			$this->setNivelProposto(new NivelAvaliacao());
		return $this->nivelProposto;
	}
	public function setNivelProposto($var){
		if(empty($var))
			$var = new NivelAvaliacao();
		$this->nivelProposto = $var;
	}
	
	public function getListaQuestoes(){
		if(empty($this->listaQuestoes))
			$this->setListaQuestoes(new ListaQuestao());
		return $this->listaQuestoes;
	}
	public function setListaQuestoes($var){
		if(empty($var))
			$var = new ListaQuestao();
		$this->listaQuestoes = $var;
	}
	
	public function getProfessor(){
		if(empty($this->professor))
			$this->setProfessor(new Professor());
		return $this->professor;
	}
	public function setProfessor($var){
		if(empty($var))
			$var = new Professor();
		$this->professor = $var;
	}
	public function getProfessorAvaliacao(){
		if(empty($this->professorAvaliacao))
			$this->setProfessorAvaliacao(new ProfessorAvaliacao());
		return $this->professorAvaliacao;
	}
	public function setProfessorAvaliacao($var){
		if(empty($var))
			$var = new ProfessorAvaliacao();
		$this->professorAvaliacao = $var;
	}

	public function insert(){
		$situacao = $this->ENUM('A_S_ANDAMENTO');

		$this->setAvaliacaoSituacaoId($situacao['id']);
		$array = array
			(
			'avaliacao_situacao_id' => $this->getAvaliacaoSituacaoId(),
			'nome' => $this->getNome(),
			'data_inicio' => $this->getDataInicio(),
			'hora_iniccio' => $this->getHoraIniccio(),
			'data_fim' => $this->getDataFim(),
			'hora_fim' => $this->getHoraFim(),
			'tempo_minimo_prova' => $this->getTempoMinimoProva(),
			'tempo_maximo_prova' => $this->getTempoMaximoProva(),
			'status' => $this->getStatus()
			);
		$id = parent::insert($array);
		
		if($id){
			$avaliacao_questao = new AvaliacaoQuestao();
			foreach($this->getListaQuestoes()->getListaQuestao() as $linha){
				$avaliacao_questao->setQuestaoId($linha->getId());
				$avaliacao_questao->setAvaliacaoId($id);
				
				$avaliacao_questao->insert();
			}
			if($this->getProfessor()->getId()){
				$professor_avaliacao = new ProfessorAvaliacao();
				$this->getProfessorAvaliacao()->setAvaliacaoId($id);
				$this->getProfessorAvaliacao()->setProfessorPessoaEscolaMatricula($this->getProfessor()->getMatricula());
				$this->getProfessorAvaliacao()->setProfessorPessoaEscolaPessoaFisicaPessoaId($this->getProfessor()->getPessoaEscolaPessoaFisicaPessoaId());
				
				$this->getProfessorAvaliacao()->insert();
			}
		}
		
		return $id;
	}
	public function update(){
		$array = array
			(
			'nome' => $this->getNome(),
			'data_inicio' => $this->getDataInicio(),
			'hora_iniccio' => $this->getHoraIniccio(),
			'data_fim' => $this->getDataFim(),
			'hora_fim' => $this->getHoraFim(),
			'tempo_minimo_prova' => $this->getTempoMinimoProva(),
			'tempo_maximo_prova' => $this->getTempoMaximoProva(),
			'status' => $this->getStatus()
			);
		$return = parent::update($array,"id = '".$this->getId()."'");
		
		$avaliacao_questao = new AvaliacaoQuestao();
		$avaliacao_questao->getAdapter()->delete('avaliacao_questao',"avaliacao_id = '".$this->getId()."'");
		
		foreach($this->getListaQuestoes()->getListaQuestao() as $linha){
			$id = $avaliacao_questao->getAdapter()->fetchOne("SELECT MAX(id) FROM `avaliacao_questao`");
			$avaliacao_questao->setId((++$id));
			$avaliacao_questao->setQuestaoId($linha->getId());
			$avaliacao_questao->setAvaliacaoId($this->getId());
			
			$avaliacao_questao->insert();
		}
		
				
		if($this->getProfessor()->getId()){		
			if($this->getProfessor()->getPessoaEscolaPessoaFisicaPessoaId() != $this->getProfessorAvaliacao()->getProfessorPessoaEscolaPessoaFisicaPessoaId()){
				if($this->getProfessorAvaliacao()->getProfessorPessoaEscolaPessoaFisicaPessoaId())
					$this->getProfessorAvaliacao()->delete();
				
				$this->getProfessorAvaliacao()->setAvaliacaoId($this->getId());
				$this->getProfessorAvaliacao()->setProfessorPessoaEscolaMatricula($this->getProfessor()->getMatricula());
				$this->getProfessorAvaliacao()->setProfessorPessoaEscolaPessoaFisicaPessoaId($this->getProfessor()->getPessoaEscolaPessoaFisicaPessoaId());
				
				$this->getProfessorAvaliacao()->insert();
			}
		}else if($this->getProfessorAvaliacao()->getProfessorPessoaEscolaPessoaFisicaPessoaId())
			$this->getProfessorAvaliacao()->delete();
		
		return $return;
	}
	public function load($id = ""){
		$object = parent::fetchRow("id = '".$id."'");
		if($object){
			$this->setId($object->id);
			$this->setAvaliacaoSituacaoId($object->avaliacao_situacao_id);
			$this->setNome($object->nome);
			$this->setDataInicio($object->data_inicio);
			$this->setHoraIniccio($object->hora_iniccio);
			$this->setDataFim($object->data_fim);
			$this->setHoraFim($object->hora_fim);
			$this->setTempoMinimoProva($object->tempo_minimo_prova);
			$this->setTempoMaximoProva($object->tempo_maximo_prova);
			$this->setStatus($object->status);
			$this->setDateCreate($object->date_create);
			$this->setDateUpdate($object->date_update);
			$this->setDateDelete($object->date_delete);
			
			$lista = new AvaliacaoQuestao();
			$lista = $lista->fetchAll("avaliacao_id = '".$this->getId()."'");
			
			foreach($lista as $linha){
				$questao = new Questao();
				$questao->load($linha->id);
				//print $linha->id.",";
				if($questao)
					$this->getListaQuestoes()->addQuestao($questao);
			}
			if(sizeof($this->getListaQuestoes()->getListaQuestao())){
				$tmp = $this->getListaQuestoes()->getListaQuestao();
				//print "<br>".$tmp[0]->getDisciplina()->getId();
				$this->setDisciplina($tmp[0]->getDisciplina());
			}
			$tmp = $this->getNivel()->fetchRow("`avaliacao_id` = '".$this->getId()."'","data_nivelamento DESC");
			if($tmp->id)
				$this->getNivel()->load($tmp->id);
			
			$tmp = new ProfessorAvaliacao();
			$tmp = $tmp->fetchRow("`avaliacao_id` = '".$this->getId()."' AND date_delete IS NULL");
			
			if($tmp->id){
				$this->getProfessorAvaliacao()->load($tmp->id);
				$this->getProfessor()->load($this->getProfessorAvaliacao()->getProfessorPessoaEscolaMatricula());
			}
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
	public function toString(){
		$funcao = new FuncoesProjeto();
		
		$disciplinas = $this->getListaQuestoes()->getListaQuestao();
		
		$str   = '<div class="divAvaliacao">';
		$str  .= '	<div class="divTitleAvaliacao">';
		$str  .= '		<div>';
		$str  .= '			<h1 class="h1Avaliacao">Disciplina - '.((sizeof($disciplinas))?$this->getDisciplina()->getNome():"Não cadastrada").'</h1>';
		$str  .= '			<h2 class="h2Avaliacao">'.$this->getNome().'</h2>';
		$str  .= '		</div>';
		$str  .= '	</div>';
		$str  .= '	<table border="0" width="100%">';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Disponibilização:</td>';
		$str  .= '			<td>'.$funcao->to_date($this->getDataInicio(),false).' a partir de '.$this->getHoraIniccio().' horas</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Finalização:</td>';
		$str  .= '			<td>'.$funcao->to_date($this->getDataFim(),false).' às '.$this->getHoraFim().' horas</td>';
		$str  .= '	</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Duração Mínima:</td>';
		$str  .= '			<td>'.$this->getTempoMinimoProva().' hora(s)</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Duração Máxima:</td>';
		$str  .= '			<td>'.$this->getTempoMaximoProva().' hora(s)</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Nº Questões:</td>';
		$str  .= '			<td>'.sizeof($this->getListaQuestoes()->getListaQuestao()).'</td>';
		$str  .= '		</tr>';
		
		$session = Zend_Registry::get('session');
		if(isset($session->usuario)){
			$usuario = $session->usuario;
			if($usuario->getPapelId() == $usuario->ENUM('P_ALUNO')){
				$str  .= '		<tr class="dg_footer">';
				$avaliacaoAluno = new AvaliacaoAluno();
				$tmp = $avaliacaoAluno->fetchRow("`avaliacao_id` = '".$this->getId()."' AND `aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' ");
				if($tmp->data_fim)
					$str  .= '			<td colspan="2" class="avaliacaoController"><a href="javascript: openPopup(\'historicoAluno?id='.$this->getId().'\',\'Avaliacao\')" class="iniciarAvaliacao" title="Visualizar Avaliação">Visualizar</a></td>';
				else
					$str  .= '			<td colspan="2" class="avaliacaoController"><a href="javascript: openPopup(\'alunoAvaliacao?id='.$this->getId().'\',\'Avaliacao\')" class="iniciarAvaliacao" title="Iniciar Avaliação">Iniciar</a></td>';
				$str  .= '		</tr>';
			}
		}
		
		$str  .= '	</table>';
		$str  .= '</div>';
		
		return $str;
	}
	public function toStringFinalizarAvaliacao(){
		$funcao = new FuncoesProjeto();
		
		$disciplinas = $this->getListaQuestoes()->getListaQuestao();
		
		$str   = '<div class="divAvaliacao">';
		$str  .= '	<div class="divTitleAvaliacao">';
		$str  .= '		<div>';
		$str  .= '			<h1 class="h1Avaliacao">Disciplina - '.((sizeof($disciplinas))?$this->getDisciplina()->getNome():"Não cadastrada").'</h1>';
		$str  .= '			<h2 class="h2Avaliacao">'.$this->getNome().'</h2>';
		$str  .= '		</div>';
		$str  .= '	</div>';
		$str  .= '	<table border="0" width="100%">';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Disponibilização:</td>';
		$str  .= '			<td>'.$funcao->to_date($this->getDataInicio(),false).' a partir de '.$this->getHoraIniccio().' horas</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Finalização:</td>';
		$str  .= '			<td>'.$funcao->to_date($this->getDataFim(),false).' às '.$this->getHoraFim().' horas</td>';
		$str  .= '	</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Duração Mínima:</td>';
		$str  .= '			<td>'.$this->getTempoMinimoProva().' hora(s)</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Duração Máxima:</td>';
		$str  .= '			<td>'.$this->getTempoMaximoProva().' hora(s)</td>';
		$str  .= '		</tr>';
		$str  .= '		<tr>';
		$str  .= '			<td class="tdLabel">Nº Questões:</td>';
		$str  .= '			<td>'.sizeof($this->getListaQuestoes()->getListaQuestao()).'</td>';
		$str  .= '		</tr>';
		
		$session = Zend_Registry::get('session');
		if(isset($session->usuario)){
			$usuario = $session->usuario;
			if($usuario->getPapelId() == $usuario->ENUM('P_PROFESSOR')){
				$str  .= '		<tr class="dg_footer">';
				$avaliacaoAluno = new AvaliacaoAluno();
				$tmp = $avaliacaoAluno->fetchRow("`avaliacao_id` = '".$this->getId()."' AND `aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$usuario->getPessoaId()."' ");
				if($tmp->data_fim)
					$str  .= '			<td colspan="2" class="avaliacaoController"><a href="javascript: openPopup(\'finalizaravaliacao?id='.$this->getId().'\',\'Avaliacao\')" class="iniciarAvaliacao" title="Visualizar Avaliação">Visualizar</a></td>';
				else
					$str  .= '			<td colspan="2" class="avaliacaoController"><a href="javascript: openPopup(\'finalizaravaliacao?id='.$this->getId().'\',\'Avaliacao\')" class="iniciarAvaliacao" title="Iniciar Avaliação">Iniciar</a></td>';
				$str  .= '		</tr>';
			}
		}
		
		$str  .= '	</table>';
		$str  .= '</div>';
		
		return $str;
	}
	public function clonarAvaliacao($id){
		$realId = $this->getId();
		
		$return = false;
		
		$this->load($id);
		if($this->getId()){
			$this->setId(NULL);
			$return = $this->insert();
		}
		if($realId)
			$this->load($realId);
		return $return;
	}
	private function getBaseDados($id = "",$pessoas_id = array()){
		$function = new FuncoesProjeto();
		
		$id = trim($id);
		
		if(empty($id))
			$id = $this->getId();
		
		$pessoas = "";
		if(sizeof($pessoas_id)){
			$pessoas = implode(",",$pessoas_id);
			$pessoas = " `pessoa_id` IN (".trim($pessoas_id).") AND ";
		}
		
		$query = 
		"
			SELECT 
				HOUR	(`inicio`) AS ini_h,
				MINUTE	(`inicio`) AS ini_i,
				SECOND	(`inicio`) AS ini_s,
				MONTH	(`inicio`) AS ini_m,
				DAY		(`inicio`) AS ini_d,
				YEAR	(`inicio`) AS ini_y,
				
				HOUR	(`fim`) AS fim_h,
				MINUTE	(`fim`) AS fim_i,
				SECOND	(`fim`) AS fim_s,
				MONTH	(`fim`) AS fim_m,
				DAY		(`fim`) AS fim_d,
				YEAR	(`fim`) AS fim_y
			FROM
				`aluno_resolve_questao`
			WHERE
				`avaliacao_id` = '".$id."' AND 
				`fim` IS NOT NULL AND 
				(`fim`-`inicio`) >= 0
		";
		
		$db = $this->getAdapter();
		
		$res = $db->fetchAll($query);
		$base = array(); //BASE DE DADOS
		foreach($res as $linha){
			$day = mktime(0,0,0,$linha['ini_m'],$linha['ini_d'],$linha['ini_y']); // COMPLEMENTA A DIFERENÇA ENTRE A DIFERENÇA DOS DIAS
			$dt1 = mktime($linha['ini_h'],$linha['ini_i'],$linha['ini_s'],$linha['ini_m'],$linha['ini_d'],$linha['ini_y']); // UNIX_TIMESTAMP DA DATA INICIAL
			$dt2 = mktime($linha['fim_h'],$linha['fim_i'],$linha['fim_s'],$linha['fim_m'],$linha['fim_d'],$linha['fim_y']);
			
			// CONVERTE UNIX TIMESTAMP EM STRING HH:MM:SS
			$tempo = date('H:i:s',($day+($dt2 - $dt1)));

			// CONVERTE STRING HORAS EM SEGUNDOS
			$total = $function->timeToSec($tempo);

			$base[] = $total;
		}
		return $base;
	}
	public function getMediaAritimetica($id = "",$pessoas_id = array()){
		$function = new FuncoesProjeto();
		
		$base = $this->getBaseDados($id,$pessoas_id);
		$mediaAritimetica = $function->mediaAritimetica($base);
		return date("H:i:s",mktime(0,0,$mediaAritimetica,0,0,0));
	}
	public function getDesvioPadraoResoluao($id = "",$pessoas_id = array()){
		$function = new FuncoesProjeto();
		
		$base = $this->getBaseDados($id,$pessoas_id);
		$desvio_padrao = $function->desvio_padrao($base);
		return date("H:i:s",mktime(0,0,$desvio_padrao,0,0,0));
	}
}
