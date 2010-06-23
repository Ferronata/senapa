<?php

class IndexController extends Zend_Controller_Action
{

	public function init(){
		include_once("Project/include.php");
		Zend_Loader::loadClass('AdminController');
	}
	public function negado(){
		$view = Zend_Registry::get('view');
		$view->output("negado.tpl");
		die();
	}
    public function indexAction(){
    	$view 		= Zend_Registry::get('view');
    	$session 	= Zend_Registry::get('session');
    	$post	 	= Zend_Registry::get('post');

    	if(!empty($session->usuario))
    		AdminController::indexAction();
    	else if(!empty($post->action)){
	    	switch($post->action){
    			case 'login':
    				IndexController::validaloginAction();
    				break;
    			default:
    				$this->negado();
    		}
    	}else
    		IndexController::loginAction();
    }
    public function validaloginAction(){
    	$view	 	= Zend_Registry::get('view');
    	$session 	= Zend_Registry::get('session');
    	$post	 	= Zend_Registry::get('post');
    	$funcao 	= new FuncoesProjeto();
    	
    	if(!empty($post->senapaUser)){
    		$user = $post->senapaUser;
    		$pass = $post->senapaPassword;
    		
    		$pessoa_escola = new PessoaEscola();
    		$db = $pessoa_escola->getAdapter();
    		
    		$array = array('matricula' => $user);
    		$res = $db->fetchRow("SELECT * FROM pessoa_escola WHERE matricula = :matricula",$array);
			
    		if(!$res || trim($funcao->md5_decrypt($res['senha'],MD5_TEXT)) != trim($pass)){
    			
    			$view->assign("msg","Usuário e/ou senha inválida.");
    			$view->assign("header","html/default/header.tpl");
				$view->assign("body","html/default/login.tpl");
				$view->assign("footer","html/default/footer.tpl");
				$view->output("index.tpl");
    		}else{
    			$pessoa_escola->load($res['pessoa_fisica_pessoa_id']);
    			if($pessoa_escola->getId()){
    				$session->usuario = $pessoa_escola;
    				IndexController::indexAction();
    			}
    			$this->negado();
    		}
    	}else
    		$this->negado();
    	
    }
    public function classgenAction(){
    	$view 	= Zend_Registry::get('view');
    	$db 	= Zend_Registry::get('db');
    	$config = Zend_Registry::get('config');
    	$view->assign("db_name","Tables_in_".$config->db->config->dbname);
    	
    	$tabelas = $db->fetchAll("SHOW TABLES");
    	
    	$view->assign("tabelas",$tabelas);
    	$msg = "";
    	
    	$post = Zend_Registry::get('post');
    	if(!empty($post->tables)){
    		$msg .= "<h4>Arquivos Criados</h4>";
    		$msg .= "<table>";
    		$tables = $post->tables;
	    	foreach($tables as $table){
				$class = new Classgen(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR ,$table);
				$pasta = strtolower($class->default_name($class->table_name));
				
				if(empty($post->viewTable)){
					$class->create();
				
					$msg .= "<tr><td>".$table."</td>";
					if(
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR . $pasta . SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
					)
						$msg .= "<td style=\"color:navy\">Criado</td><td><a class=\"view\" href=\"".BASE_URL."/".$pasta."/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
					else
						$msg .= "<td style=\"color:red\" colspan=\"2\">Não Criado</td>";
					$msg .= "</tr>";
				}else{
					$msg .= "<tr><td>".$table."</td>";
					if(
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR . $pasta . SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
					)
						$msg .= "<td style=\"color:navy\">Existe</td><td><a class=\"view\" href=\"".BASE_URL."/".$pasta."/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
					else
						$msg .= "<td style=\"color:red\" colspan=\"2\">Não Existe</td>";
					$msg .= "</tr>";
				}
			}
			$msg .= "</table>";
    	}elseif(!empty($post->tabelas)){
    		$class = new Classgen(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR ,$post->tabelas);
    		$pasta = strtolower($class->default_name($class->table_name));
    		
    		$class->create();
    		
    		$msg .= "<h4>Arquivo Criado</h4>";
    		$msg .= "<table><tr><td>".$post->tabelas."</td>";
    		
    		if(
				is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
				is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR . $pasta . SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
			)
				$msg .= "<td style=\"color:navy\">Criado</td><td><a class=\"view\" href=\"".BASE_URL."/".$pasta."/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
			else
				$msg .= "<td style=\"color:red\" colspan=\"2\">Não Criado</td>";
			$msg .= "</tr></table>";
    	}
    	
    	$view->assign("msg",$msg);
    	$view->assign("header","html/header.tpl");
    	$view->assign("body","classgen/index.tpl");
    	$view->assign("footer","html/footer.tpl");
    	$view->output("index.tpl");
    }
	public function loginAction(){
		$view 		= Zend_Registry::get("view");
		$session 	= Zend_Registry::get("session");
		$funcao 	= new FuncoesProjeto();
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","html/default/login.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	public function sairAction(){
		Zend_Session::destroy();
		
		$view = Zend_Registry::get("view");
		
		$view->assign("header","html/default/header.tpl");
		$view->assign("body","html/default/login.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	public function datagridAction(){
		$view 		= Zend_Registry::get("view");
		
		$columns = array
		(
			//'pessoa_escola_pessoa_fisica_pessoa_id' => 'ID',
			'pessoa' 		=> array(
										'sigla' => 'B',
										'relacionamento' => array('this'=>'id', 'other'=>'pessoa_escola_pessoa_fisica_pessoa_id'),
										'data' => array('nome'=>'Nome')
									),
			'pessoa_fisica' => array(
								'sigla' => 'C',
								'relacionamento' => array('this'=>'pessoa_id', 'other'=>'pessoa_escola_pessoa_fisica_pessoa_id'),
								'data' => array('data_nascimento'=>'Data de Nascimento')
							),
			//'pessoa_escola'		=> array('conteudo' => array('where'=>'id', 'filho'=>'pessoa_escola_pessoa_fisica_pessoa_id'),'nome' => 'Nome'),
			'pessoa_escola_matricula' => 'Matrícula',
			'area_interece' => 'Área de Interece'
		);
		/*
		$columns = array(
				'descricao'	=>	'Questão', 
				//'resposta'	=>	'Resposta',
				'questao_alternativa' 	=> array(
									'subconsulta' => array('this'=>'id', 'other'=>'resposta'),
									'data' => array('descricao'=>'Resposta')
								),
				'descricao_resposta'	=>	'Explicação da Resposta'
			);
		$where = "`date_delete` IS NULL";
		*/	
		$datagrid = new Datagrid("TESTE", 'aluno',$where, $columns, "B.nome");
		//$datagrid = new Datagrid("TESTE", 'aluno',"", $columns, "B.nome DESC");
		//$datagrid = new Datagrid("TESTE", 'aluno',"", $columns);
		//$datagrid = new Datagrid("TESTE", 'aluno');
		//$datagrid->defaultLays();
		
		$view->assign("datagrid",$datagrid);

		$view->assign("header","html/default/header.tpl");
		$view->assign("body","html/default/datagrid.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
}

