<?php
/*
 * Controle da parte de funções => Admin
 * Data de Cricação - 05/03/2010
 * @author Léo Popik => Classgen 1.0
 * @package sgaPhp
 * @subpackage sgaPhp.application.controllers
 * @version 1.0
 */
class FunctionController extends Zend_Controller_Action{
	private $OBJECTS = array();
	private $OBJECTS_FK = array();
	private $OBJECTS_FK_RETURN = array();
	
	
public function init(){
		include_once("Project/include.php");
	}
	public function datagrid($view, $table, $display = array(), $where = ""){
		//Exemplo => $datagrid = new Datagrid('com_endereco', array('id'=>'ID', 'logradouro'=>'Rua'));
		$datagrid = new Datagrid($table, $where, $display);
		$view->assign("datagrid",$datagrid);

		$view->assign("body","html/admin/datagrid.tpl");
		$view->assign("header","html/admin/header.tpl");
		$view->assign("footer","html/admin/footer.tpl");
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
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$funcao 	= new FuncoesProjeto();

		$usuarios = new Usuario();
		$usuarios = $usuarios->fetchAll("`usuario` = '123' AND `status`");
		
		if(sizeof($usuarios)){
			$usuario = $usuarios[0];
			if($funcao->md5_decrypt($usuario->senha) === 'lpbamor'){
				$session->usuario 	= $usuario;
				$session->papel_id 	= $usuario->papel_id;
					
				$papeis	= new Papel();
				$papeis	= $papeis->fetchAll("id = '".$usuario->papel_id."'");
				$papel 	= $papeis[0];
				
				$empresa = new Empresa();
				$empresa = $empresa->fetchRow("`id` = '".$papel->empresa_id."'");
				$session->empresa_id = $empresa->id;
				
				$menu_categoria_itens = new MenuCategoriaItem();
				$menu_categoria_itens = $menu_categoria_itens->fetchAll("papel_id = '".$papel->id."'");
				
				$categorias = array();
				foreach($menu_categoria_itens as $linha){
					$categoria = new MenuCategoria();
					$categoria = $categoria->fetchRow("id = '".$linha->menu_categoria_id."'");
					if(!in_array($categoria,$categorias))
						$categorias[] = $categoria;
				}
				
				foreach($categorias as $categoria){
					$menus = array();
					
					$menu_categoria_itens = new MenuCategoriaItem();
					$menu_categoria_itens = $menu_categoria_itens->fetchAll("papel_id = '".$papel->id."' AND menu_categoria_id = '".$categoria->id."'");
					foreach($menu_categoria_itens as $item){
						$menu = new MenuItem();
						$menu = $menu->fetchRow("id = '".$item->menu_item_id."'");
						
						if($menu->status){
							$submenu = new MenuItem();
							
							$submenu = $submenu->fetchAll("menu_item_id = '".$item->menu_item_id."'","ordem");
							
							$array = array();
							foreach($submenu as $itemMenu){
								//if($itemMenu->status)
									$array[] = $itemMenu;
							}
							if(sizeof($array))
								$menus[] = array($menu,$array);
						}
					}
					$key = array_search($categoria,$categorias);
					if(sizeof($menus))
						$categorias[$key] = array($categoria,$menus);
					else
						unset($categorias[$key]);
				}
				$view->assign("categorias",$categorias);
			}
		}
		
		
 		$view->assign("header","html/admin/header.tpl");
		$view->assign("body","admin/index.tpl");
		$view->assign("footer","html/admin/footer.tpl");
		$view->output("index.tpl");
	}
	
	
	public function renderAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($post->Object)){
			$return = array(array("html" => "Nenhum Registro", "value" => 0));
			try{
				
				$relation_name 	= strtolower($post->RelationName);
				$relation_value = (int)$post->RelationValue;
				
				$order = (!empty($post->Order))?$post->Order:"nome";
				$params	= (isset($post->Params))?strtolower($post->Params):"nome";
				
				$object = new $post->Object ();
				$status = "";
				
				$object = $object->fetchAll("`".$relation_name."_id` = '".$relation_value."'",$order);
				
				if(sizeof($object))
					$return = array(array("html" => "Selecione", "value" => 0));
				foreach($object as $key => $values)
					$return[] = array("html" => $values->$params, "value" => $values->id);						
				
				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json($return));}
		}
		
		if(!empty($get->Object)){
			try{
				
				$relation_name 	= strtolower($get->RelationName);
				$relation_value = (int)$get->RelationValue;
				
				$order 	= (!empty($get->Order))?$get->Order:"nome";
				$params	= (isset($get->Params))?strtolower($get->Params):"nome";
				
				$object = new $get->Object ();
				$object = $object->fetchAll("`".$relation_name."_id` = '".$relation_value."'",$order);
				print "`".$relation_name."_id` = '".$relation_value."'".$order;
				$return = array(array("html" => "Selecione", "value" => 0));
				try{
					foreach($object as $key => $values)
						$return[] = array("html" => $values->$params, "value" => $values->id);
				}catch(Exception $erro){}
				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		
		$view->output("function/index.tpl");
	}
	
	public function renderdisciplinaassuntoAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($post->RelationValue)){
			try{
				
				$relation_value = (int)$post->RelationValue;
				
				$object = new Assunto();
				$object = $object->fetchAll("`date_delete` IS NULL AND `id` IN (SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$relation_value."')","nome");

				$return = array(array("html" => "Selecione", "value" => 0));
				try{
					foreach($object as $key => $values)
						$return[] = array("html" => $values->nome, "value" => $values->id);
				}catch(Exception $erro){}
				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		
		$view->output("function/index.tpl");
	}
	
	public function rendercheckdisciplinaassuntoAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($post->RelationValue) || !empty($get->RelationValue)){
			try{
				
				$avaliacao = new Avaliacao();
				$object = new Assunto();
				$return = array();
				
				if(isset($get->RelationValue)){
					$relation_value = (int)$get->RelationValue;
					$findTo = (int)$get->tpPesqusia;
				}else{
					$relation_value = (int)$post->RelationValue;
					$findTo = (int)$post->FindTo;
				}
				switch($findTo){
					case 'questions':
					case $object->ENUM('QUESTAO'):
						$object = $object->fetchAll("`date_delete` IS NULL AND `id` IN (SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$relation_value."')","nome");
		
						try{
							foreach($object as $key => $values)
								$return[] = array("html" => $values->nome, "value" => $values->id);
						}catch(Exception $erro){}
						break;
					case 'avaliations':
					case $object->ENUM('AVALIACAO'):
						$niveis = array();
						if(isset($get->lista_niveis))
							$niveis = $get->lista_niveis;
						elseif(isset($post->lista_niveis))
							$niveis = $post->lista_niveis;

						if(sizeof($niveis)){
							$niveis[sizeof($niveis)] = $niveis[0];
							$niveis[0] = NULL;
						}
						
						$listaAvaliacao = $avaliacao->fetchAll("`date_delete` IS NULL","nome");
						$idsAv = " ";
						foreach($listaAvaliacao as $linha){
							$tmpAvaliacao = new Avaliacao();
							$tmpAvaliacao->load($linha->id);
							if($tmpAvaliacao->getDisciplina()->getId()){
								try{
									$tmpObject = $object->fetchAll("`date_delete` IS NULL AND `id` IN (SELECT `assunto_id` FROM `disciplina_assunto` WHERE `disciplina_id` = '".$tmpAvaliacao->getDisciplina()->getId()."')","nome");

									if($tmpObject && array_search($tmpAvaliacao->getNivel()->getNivel(),$niveis))
										$return[] = array("html" => $tmpAvaliacao->getDisciplina()->getNome()." - ".$tmpAvaliacao->getNome(), "value" => $tmpAvaliacao->getId());
								}catch(Exception $erro){}
							}
						}
						
						break;
				}
				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		
		$view->output("function/index.tpl");
	}
	public function findArray($needle,$array){
		foreach($array as $key => $linha){
			if($needle == $linha)
				return $key;
		return -1;
		}
	}
	public function renderavaliacaoalunoAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($get->RelationValue) || !empty($post->RelationValue)){
			try{
				if(!empty($get->RelationValue))
					$id = $get->RelationValue;
				else
					$id = $post->RelationValue;
			
					
				$pessoa_escola = new PessoaEscola();
				$pessoa_escola->load($id);
				
				$aluno = new Aluno();
				$aluno->load($pessoa_escola->getMatricula());
				
				$avaliacoes = $aluno->getAvaliacoes();
				
				$return = array();
				foreach($avaliacoes as $linha){
					$avaliacaoAluno = new AvaliacaoAluno();
					$tmp = $avaliacaoAluno->fetchRow("`avaliacao_id` = '".$linha->getId()."' AND `aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$id."' ");
					if(!$tmp || !$tmp->data_fim)
						$return[] = array("html" => $linha->toString());
				}
				
				die($funcao->array2json($return));
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		$view->output("function/index.tpl");
	}
	public function renderhistoricoavaliacaoalunoAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($get->RelationValue) || !empty($post->RelationValue)){
			try{
				if(!empty($get->RelationValue))
					$id = $get->RelationValue;
				else
					$id = $post->RelationValue;
			
					
				$pessoa_escola = new PessoaEscola();
				$pessoa_escola->load($id);
				
				$aluno = new Aluno();
				$aluno->load($pessoa_escola->getMatricula());
				
				$avaliacoes = $aluno->getAvaliacoes();
				
				$return = array();
				foreach($avaliacoes as $linha){
					$avaliacaoAluno = new AvaliacaoAluno();
					$tmp = $avaliacaoAluno->fetchRow("`avaliacao_id` = '".$linha->getId()."' AND `aluno_pessoa_escola_pessoa_fisica_pessoa_id` = '".$id."' ");
					if($tmp && $tmp->data_fim)
						$return[] = array("html" => $linha->toString());
				}
				
				die($funcao->array2json($return));
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		$view->output("function/index.tpl");
	}
	
	// Metodo usado para efetuar a busca por questões para montar avaliação
	public function findquestionsAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($post->tpPesqusia)){
			try{
//				tpPesqusia=1
//				lista_niveis=5
//				lista_niveis=6
//				Disciplina=1
//				lista_assuntos=1
//				lista_assuntos=2
				$tpPesqusia 	= $post->tpPesqusia;
				$disciplina		= $post->Disciplina;
				$lista_niveis	= $post->lista_niveis;
				$lista_assuntos	= $post->lista_assuntos;
				
				$object = new DefaultObject();
				
				$questoes = new ListaQuestao();
				
				switch($tpPesqusia){
					case $object->ENUM('QUESTAO'):
						$questao = new Questao();
						$where = 
						"
						`date_delete` IS NULL AND 
						`id` IN (SELECT `questao_id` FROM `assunto_questao` WHERE `assunto_id` IN (".implode($lista_assuntos,",")."))
						";
						
						$lista = $questao->fetchAll($where);
						
						foreach($lista as $linha){
							$tmpQuestao = new Questao();
							$tmpQuestao->load($linha->id);
							
							if($questoes->findNivel($tmpQuestao,$lista_niveis) >= 0 )
								$questoes->addQuestao($tmpQuestao);
						}
						
						break;
					case $object->ENUM('AVALIACAO'):
						break;
				}
				
				$str = "";
				$return = array();
				try{
					foreach($questoes->getListaQuestao() as $key => $values){
						$alternativas = $values->getAlternativas()->getAlternativas();
						$lista = array();
						foreach($alternativas as $alternativa){
							$lista[] = array("id" => $alternativa->getId(), "questao_id" => $alternativa->getQuestaoId(), "descricao" => $alternativa->getDescricao());
						}
						$return[] = array("id" => $values->getId(),"resume" => $values->getDescricao(), "html" => $values->getDescricao(), "resposta" => $values->getResposta(), "descricao_resposta" => $values->getDescricaoResposta(), "alternativas" => $lista);
//						$return[] = array("id" => $values->getId(),"resume" => $values->getDescricao(), "html" => $values->getDescricao(), "resposta" => $values->getResposta());
					}
					
				}catch(Exception $erro){}
				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}else
			die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));
		
		$view->output("function/index.tpl");
	}
	
	
	public function listrenderAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		
		if(!empty($post->ObjectName)){
			try{
				
				$relation_name 	= strtolower($post->RelationName);
				$relation_value = (int)$post->RelationValue;
				
				$objects 	= $post->ObjectName;
				$orders 	= $post->ObjectOrder;
				$return		= array();
				
				for($i = 0; $i<sizeof($objects); $i++){
				
					$order 	= (!empty($orders[$i]))?$orders[$i]:"nome";
					$param	= (isset($params[$i]))?strtolower($params[$i]):$order;
					
					$object = new $objects[$i] ();
					$object = $object->fetchAll("`".$relation_name."_id` = '".$relation_value."'",$order);
					$return[] = array("id" => $objects[$i],"html" => "Selecione", "value" => 0);
					try{
						foreach($object as $key => $values){
							if(isset($values->status)){
								if($values->status)
									$return[] = array("id" => $objects[$i],"html" => $values->$param, "value" => $values->id);
							}else
								$return[] = array("id" => $objects[$i],"html" => $values->$param, "value" => $values->id);
						}
					}catch(Exception $erro){}
				}

				die($funcao->array2json($return));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		
		if(!empty($get->ObjectName)){
			try{
				
				$relation_name 	= strtolower($get->RelationName);
				$relation_value = (int)$get->RelationValue;
				
				$objects 	= $get->ObjectName;
				$orders 	= $get->ObjectOrder;
				$return		= array();
				
				for($i = 0; $i<sizeof($objects); $i++){
					$tmp_return		= array();
					
					$order 	= (!empty($orders[$i]))?$orders[$i]:"nome";
					$param	= (isset($params[$i]))?strtolower($params[$i]):$order;
					
					$object = new $objects[$i] ();
					$object = $object->fetchAll("`".$relation_name."_id` = '".$relation_value."'",$order);
					$tmp_return[] = array("id" => $objects[$i],"html" => "Selecione", "value" => 0);
					try{
						foreach($object as $key => $values){
							if($values->status)
								$tmp_return[] = array("id" => $objects[$i],"html" => $values->$param, "value" => $values->id);
						}
					}catch(Exception $erro){}
				}
				foreach($tmp_return as $linha)
					$return[] = $funcao->array2json($linha);
				die($return);
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		
		$view->output("function/index.tpl");
	}
	
	public function renderpessoaAction(){
		$view 		= Zend_Registry::get("view");
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");
		
		$type = "post";
		
		
		
		if(!empty($$type->Value) && !empty($$type->Column)){
			$column = $$type->Column;
			$value 	= $$type->Value;
			
			$return = array();
			
			switch($column){
				case 'cpf':
					if(strlen($value)==14){
						$return = $this->pessoa_fisica($column, $value."%");
					}
					break;
				default:
					
			}
		}
			
		$view->output("function/index.tpl");
	}
	
	public function pessoa_fisica($column, $value){
		$view 		= Zend_Registry::get("view");
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		
		$funcao = new FuncoesProjeto();
		
		$pessoa 	= new Pessoa();
		$pessoa_fisica = new PessoaFisica();
		
		$telefone 	= new Telefone();
		$telefoneTipo = new TelefoneTipo();
		
		$endereco 	= new Endereco();
		$o_uf 		= new Uf();
		$o_cidade 	= new Cidade();
		$o_bairro 	= new Bairro();
		$o_logradouro = new Logradouro();
		
		$logradouros = array();
		$bairros	 = array();
		$cidades	 = array();
		
		$return 	= array();
		
		$telefones 	= array();
		try{
			//$pessoa_fisica = $pessoa_fisica->fetchRow("`".$column."` LIKE '".$value."' AND `empresa_id` = '".$session->empresa_id."'");
			$pessoa_fisica = $pessoa_fisica->fetchRow("`".$column."` LIKE '".$value."' AND `empresa_id` = '1'");						
			$pessoa = $pessoa->fetchRow("`id` = '".$pessoa_fisica->pessoa_id."'");
			
			$a_pessoa_fisica = 
				array(
					'id'=>$pessoa_fisica->id,
					'pessoa_id'=>$pessoa_fisica->pessoa_id,
					'empresa_id'=>$pessoa_fisica->empresa_id,
					'cpf'=>$pessoa_fisica->cpf,
					'empresa_id'=>$pessoa_fisica->empresa_id,
					'dt_nascimento'=>$pessoa_fisica->dt_nascimento
				);
			
			$a_pessoa = 
				array(
					'id'=>$pessoa->id,
					'nome'=>$pessoa->nome,
					'email'=>$pessoa->email,
					'site'=>$pessoa->site							
				);
				
			$return['pessoa_fisica'] = $a_pessoa_fisica;
			$return['pessoa'] = $a_pessoa;
			
			//print_r($funcao->array2json($return));
			die($funcao->array2json($return));
				
			$telefone = $telefone->fetchAll("`pessoa_id` = '".$pessoa->id."'");
			foreach($telefone as $linha){
				$tipo = $telefoneTipo->fetchRow("`id` = '".$linha->telefone_tipo_id."'");
				$telefones[] = array('tipo' => $tipo,'numero' => $linha->numero);
			}
			
			$ufs = $o_uf->fetchAll("`status`", "`sigla`");
			
			$endereco = $endereco->fetchRow("`pessoa_id` = '".$pessoa->id."'");
			
			try{
				
				$logradouro = $o_logradouro->fetchRow("`id` = '".$endereco->logradouro_id."'");
				$bairro = $o_bairro->fetchRow("`id` = '".$logradouro->bairro_id."'");
				$cidade = $o_cidade->fetchRow("`id` = '".$bairro->cidade_id."'");
				$uf 	= $o_uf->fetchRow("`id` = '".$cidade->uf_id."'");
				
				$logradouros = $o_logradouro->fetchAll("`bairro_id` = '".$bairro->id."'","`nome`");
				$bairros 	= $o_bairro->fetchAll("`cidade_id` = '".$cidade->id."'","`nome`");
				$cidades 	= $o_cidade->fetchAll("`uf_id` = '".$uf->id."'","`nome`");
				
			}catch(Exception $err){die($funcao->array2json(array('Erro 1')));}
			
		}catch(Exception $e){die($funcao->array2json(array('Erro 2')));}
	}
	
	
	public function selectobjectAction(){
		$view 		= Zend_Registry::get("view");
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");
		
		$value 		= $get->Value;
		$table 		= $get->VlTable;
		$column		= $get->VlColumn;
		$id			= $get->Id;
		$return		= $get->VlColumn;
		$tableView	= $table;
		
		if(!empty($get->TableView))
			$tableView = $get->TableView;
		
		if(!empty($get->Return))
			$return		= $get->Return;
		
		$values = array();
		$titulo = array();
		try{
			
			$query 	= "SHOW COLUMNS FROM `".$table."`";
			$cols 	= $db->fetchAll($query);
			$t1 = array();
			foreach($cols as $col){
				if($col['Key'] != 'PRI' && $col['Key'] != 'MUL')
					$t1[] = $col['Field'];
			}
			$query 	= "SHOW COLUMNS FROM `".$tableView."`";
			$cols 	= $db->fetchAll($query);
			$t2 = array();
			foreach($cols as $col){
				if($col['Key'] != 'PRI' && $col['Key'] != 'MUL')
					$t2[] = $col['Field'];
			}
			
			
			$class = new Classgen("",$table);
			$nm = $class->get_file_name();
			$meuObjeto = new $nm();
			$meuObjeto = $meuObjeto->fetchAll("`".$column."` LIKE '".$value."%' AND `".$column."` <> '108.674.547-76'");
			
			if($tableView != $table){
				foreach($meuObjeto as $key => $linha){
					$class = new Classgen("",$tableView);
					$nm = $class->get_file_name();
					
					$tmp_o = new $nm();
					$tmp_o = $tmp_o->fetchRow("`id` = '".$meuObjeto[$key]['pessoa_id']."'");
					
					$linha_tmp = array();					
					foreach($t1 as $t)
						$linha_tmp[] = $linha->$t;
					foreach($t2 as $t)
						$linha_tmp[] = $tmp_o->$t;
					
					$values[] = $linha_tmp;
				}
			}
			$titulo = $t1;
			foreach($t2 as $t)
				$titulo[] = $t;
			
		}catch(Exception $e){
			//array(array("html" => "", "value" => "", "id" => $id));
			print $e;
		}
		$view->assign("titulo",$titulo);
		$view->assign("size",sizeof($titulo));
		$view->assign("values",$values);		
		
		$view->assign("header","html/admin/header.tpl");
		$view->assign("body","function/select.tpl");
		$view->assign("footer","html/admin/footer.tpl");
		$view->output("index.tpl");
	}
	public function renderobjectAction(){
		$view 		= Zend_Registry::get("view");
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		$post 		= Zend_Registry::get("post");
		$get 		= Zend_Registry::get("get");

		$funcao = new FuncoesProjeto();
		if(!empty($get->VlTable)){
			try{

				$objects = array();
				
				$value 		= $get->Value;
				$table 		= $get->VlTable;
				$column		= $get->VlColumn;
				
				$tables		= $get->Table;
				
				$class = new Classgen("",$table);
				$nm = $class->get_file_name();
				$meuObjeto = new $nm();
				$meuObjeto = $meuObjeto->fetchRow("`".$column."` = '".$value."'");
				
				if($meuObjeto){

					$this->OBJECTS[] = array('name' => $nm, 'value' => $meuObjeto);
					$this->getObject($table);
				}
				
				foreach($tables as $table){
					$class = new Classgen("",$table);
					$nm = $class->get_file_name();
					
					$this->getFKobject($table);
					foreach($this->OBJECTS_FK as $key => $filho){
						$pos = $this->className_in_array($filho['name'],$this->OBJECTS);
						if($pos >= 0){
							try{
								$pai = new $this->OBJECTS[$pos]['name']();
								$pai_name = $pai->info('name');
								$pai = $pai->fetchRow("`id` = '".$this->OBJECTS[$pos]['value']['id']."'");
								
								$filho = new $nm();
								$filho = $filho->fetchAll("`".$pai_name."_id` = '".$pai->id."'");
								
								$this->OBJECTS_FK_RETURN[] = array('name'=>$nm,'value'=>$filho);
							}catch(Exception $e){}
						}
					}
				}
				// PERCORRER E RECUPERAR OUTROS FORENGE KEY
				foreach($this->OBJECTS_FK_RETURN as $key => $linha){
					foreach($linha['value'] as $key_value => $linha_value){
						$pai = new $linha['name']();
						$pai = $pai->fetchRow("`id` = '".$linha_value['id']."'");
						
						$filhos = array();
						foreach($this->OBJECTS_FK as $filho){
							$tmp_filho = new $filho['name']();
							$tb = $tmp_filho->info('name').'_id';
							$tmp_filho = $tmp_filho->fetchRow("`id` = '".$pai->$tb."'");
							$filhos[] = array('name'=>$filho['name'],'value'=>$tmp_filho);
						}
						$this->OBJECTS_FK_RETURN[$key_value]['children'] = $filhos;
					}
				}
				foreach($this->OBJECTS as $linha)
					print $linha['name']."<p />";
				print "<hr />";
				
				foreach($this->OBJECTS_FK as $linha)
					print $linha['name']."<p />";
				print "<hr />";
				
				foreach($this->OBJECTS_FK_RETURN as $linha){
					print $linha['name']."<p />";
					foreach($linha['children'] as $tmp)
						print "-------".$tmp['name']."<p />";
				}print "<hr />";
				//die($funcao->array2json(array('msg' => 'ok', 'display' => print_r($objects))));
				
			}catch(Exception $e){die($funcao->array2json(array('msg' => 'erro', 'display' => htmlentities('Problemas na renderização'))));}
		}
		$view->output("function/index.tpl");
	}
	
	private function getObject($table){	
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		
		$query 	= "SHOW COLUMNS FROM `".$table."`";
		$cols 	= $db->fetchAll($query);
		$pri = array();
		foreach($cols as $col){
			if($col['Key'] == 'PRI')
				$pri[] = $col;
		}
		if(sizeof($pri)){
			foreach($pri as $linha){
				try{
					
					$nm = trim(str_replace("_id","",$linha['Field']));
					
					$class = new Classgen("",$nm);					 
					$nm = $class->get_file_name();
					
					try{						
						$object = new $nm();
						$object = $object->fetchRow("`id` = '".$this->OBJECTS[0]['value'][$linha['Field']]."'");
						
						if($this->className_in_array($nm,$this->OBJECTS)<0 && $object->id)
							$this->OBJECTS[] 	= array('name' => $nm, 'value' => $object);
						
						$this->getObject(trim(str_replace("_id","",$linha['Field'])));
						
					}catch(Exception $err){}
				}catch(Exception $e){}
			}
		}
	}
	private function getFKobject($table){
		$db 		= Zend_Registry::get("db");
		$session 	= Zend_Registry::get("session");
		
		$query 	= "SHOW COLUMNS FROM `".$table."`";
		$cols 	= $db->fetchAll($query);
		$fk = array();
		foreach($cols as $col){
			if($col['Key'] == 'MUL')
				$fk[] = $col;
		}
		if(sizeof($fk)){
			foreach($fk as $linha){
				try{
					
					$nm = trim(str_replace("_id","",$linha['Field']));
					
					$class = new Classgen("",$nm);					 
					$nm = $class->get_file_name();
					
					try{						
						$object = new $nm();
						$object = $object->fetchRow("`id` IN (SELECT `".$linha['Field']."` FROM `".$table."`)");
						
						//if($this->className_in_array($nm,$this->OBJECTS)<0)
						$this->OBJECTS_FK[] 	= array('name' => $nm, 'value' => $object);
						
						$this->getfkobject(trim(str_replace("_id","",$linha['Field'])));
						
					}catch(Exception $err){}
				}catch(Exception $e){}
			}
		}
	}
	private function className_in_array($className = "",$objects){
		$i = 0;
		$obj = new $className();
		foreach($objects as $object){
			$tmp = new $object['name']();
			if($obj->info('name') == $tmp->info('name'))
				return $i;
			$i++;
		}
		return -1;
	}
}