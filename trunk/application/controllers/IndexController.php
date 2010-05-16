<?php

class IndexController extends Zend_Controller_Action
{

	public function init(){
		include_once("Project/include.php");
	}
    public function indexAction(){
    	$view = Zend_Registry::get('view');
    	/*
    	$produto 	= new Produtos();
    	$produtos 	= $produto->fetchAll('promocao','nome');
    	
    	$view->assign("produtos",$produtos);
    	*/
    	$view->assign("header","html/header.tpl");
    	$view->assign("body","index/index.tpl");
    	$view->assign("footer","html/footer.tpl");
    	$view->output("index.tpl");
    	//$this->_response->setBody($view->render("default.phtml"));
    	//$this->_redirect("teste/popik");
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
				if(empty($post->viewTable)){
					$class->create();
				
					$msg .= "<tr><td>".$table."</td>";
					if(
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR .'admin'. SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
					)
						$msg .= "<td style=\"color:navy\">Criado</td><td><a class=\"view\" href=\"".BASE_URL."/admin/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
					else
						$msg .= "<td style=\"color:red\" colspan=\"2\">Não Criado</td>";
					$msg .= "</tr>";
				}else{
					$msg .= "<tr><td>".$table."</td>";
					if(
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
						is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR .'admin'. SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
					)
						$msg .= "<td style=\"color:navy\">Existe</td><td><a class=\"view\" href=\"".BASE_URL."/admin/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
					else
						$msg .= "<td style=\"color:red\" colspan=\"2\">Não Existe</td>";
					$msg .= "</tr>";
				}
			}
			$msg .= "</table>";
    	}elseif(!empty($post->tabelas)){
    		$class = new Classgen(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR ,$post->tabelas);
    		$class->create();
    		
    		$msg .= "<h4>Arquivo Criado</h4>";
    		$msg .= "<table><tr><td>".$post->tabelas."</td>";
    		
    		if(
				is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'models'. SYS_BAR .$class->get_file_name()).'.php' && 
				is_file(PROJECT_ROOT . SYS_BAR . 'application' . SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR .'admin'. SYS_BAR . strtolower($class->get_file_name()) .'.tpl')
			)
				$msg .= "<td style=\"color:navy\">Criado</td><td><a class=\"view\" href=\"".BASE_URL."/admin/". strtolower($class->get_file_name()) ."\" target=\"_blank\">View</a></td>";
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
}

