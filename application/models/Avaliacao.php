<?php
/**
 * Modelo da classe Avaliacao
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos => Classgen 1.0
 * @package senapa
 * @subpackage senapa.application.models
 * @version 1.0
 */

require_once 'DAO.php';
require_once 'ListaQuestao.php';

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

	public function insert(){
		$this->setAvaliacaoSituacaoId(3);
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
		}
		
		return $id;
	}
	public function update(){
		$array = array
			(
			//'avaliacao_situacao_id' => $this->getAvaliacaoSituacaoId(),
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
				if($questao)
					$this->getListaQuestoes()->addQuestao($questao);
			}
		}
		return $object;
	}
	public function delete(){
		return parent::delete("id = '".$this->getId()."'");
	}
}
