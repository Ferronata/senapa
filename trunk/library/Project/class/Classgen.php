<?php

class Classgen  {
	private $path;
	private $file_name;
	public $table_name;
	private $key = "id";
	private $columns;
	private $restricts;
	private $classgen_versao = "1.0";
	
	public function __construct($path,$file_name){
		$this->table_name 	= $file_name;
		$this->path 		= $path;		
		$this->file_name	= $this->default_name($file_name);
		$this->load_table();
		$this->set_restrict();
	}
	private function load_table(){
		$db = Zend_Registry::get('db');
		
		$query 	= "SHOW COLUMNS FROM `".$this->table_name."`";
		$cols 	= $db->fetchAll($query);
		$colunas = array();
		foreach($cols as $coluna)
			$colunas[] = new Coluna($coluna['Field'], $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
		$this->columns = $colunas;
	}
	public function default_name($file_name){
		$file_name = strtoupper(substr($file_name,0,1)).strtolower(substr($file_name,1));
		$pos = strpos($file_name,"_");
		while($pos){
			$ini = substr($file_name,0,$pos);
			$fim = substr($file_name,$pos+1);
			$fim = strtoupper(substr($fim,0,1)).substr($fim,1);
			$file_name = $ini.$fim;
			$pos = strpos($file_name,"_",$pos+1);
		}
		return $file_name;
	}
	private function default_method_name($file_name){
		return $this->default_name($file_name);
	}
	private function default_var_name($file_name){
		
		$nm = $this->default_name($file_name);
		$ini = (empty($nm))?"":strtolower(substr($nm,0,1));

		return (empty($ini))?"":$ini.substr($nm,1);
	}
	public function create(){
		// CRIA MODELO
		$this->file_model();
		
		// CRIA VIEW
		$this->file_input();
		
		// CRIA CONTROLADOR
		$this->file_action();
	}
	private function file_model(){
		$file = $this->path.$this->file_name.".php";
		if(!is_file($file)){
			$str  = "<?php\n";
			$str .= "/**\n";
			$str .= " * Modelo da classe ".$this->file_name."\n";
			$str .= " * Data de Cricação - ".date("d/m/Y")."\n";
			$str .= " * @author Leonardo Popik e João Marcos => Classgen ".$this->classgen_versao."\n";
			$str .= " * @package senapa\n";
			$str .= " * @subpackage senapa.application.models\n";
			$str .= " * @version 1.0\n";
			$str .= " */\n\n";
			
			$str .= "class ".$this->file_name." extends Zend_Db_Table {\n";
			$str .= "	protected \$_name = '".$this->table_name."';\n";
			
			
			foreach($this->columns as $column){
				if($this->find_restrict($column->get_nome())<0)
					$str .= "	private \$".$this->default_var_name($column->get_nome()).";\n";
			}
			
			$str .= "\n";
			
			foreach($this->columns as $column){
				if($this->find_restrict($column->get_nome())<0){
					$str .= "	public function get".$this->default_method_name($column->get_nome())."(){return \$this->".$this->default_var_name($column->get_nome()).";}\n";
					$str .= "	public function set".$this->default_method_name($column->get_nome())."(\$var){\$this->".$this->default_var_name($column->get_nome())." = \$var;}\n\n";
				}
			}
			
			$data = "  ";
			
			foreach($this->columns as $column)
				$data .= "			'".$column->get_nome()."' => \$this->get".$this->default_method_name($column->get_nome())."(),\n";
			
			$data = trim(substr($data,0,-2));
				
			$str .= "	public function insert(){\n";
			$str .= "		\$array = array\n";
			$str .= "			(\n";
			$str .= "			".$data."\n";
			$str .= "			);\n";	
			$str .= "		return parent::insert(\$array);\n";
			$str .= "	}\n";
			
			$str .= "	public function update(){\n";
			$str .= "		\$array = array\n";
			$str .= "			(\n";
			$str .= "			".$data."\n";
			$str .= "			);\n";	
			$str .= "		return parent::update(\$array,\"".$this->key." = '\".\$this->get".$this->default_method_name($this->key)."().\"'\");\n";
			$str .= "	}\n";
			
			$str .= "	public function load(\$id = \"\"){\n";
			$str .= "		\$object = parent::fetchRow(\"".$this->key." = '\".\$id.\"'\");\n";
			$str .= "		if(\$object){\n";
			foreach($this->columns as $column)
				$str .= "			\$this->set".$this->default_method_name($column->get_nome())."(\$object->".$column->get_nome().");\n";	
			$str .= "		}\n";
			$str .= "		return parent::fetchRow(\"".$this->key." = '\".\$this->get".$this->default_method_name($this->key)."().\"'\");\n";
			$str .= "	}\n";
			
			$str .= "	public function delete(){\n";
			$str .= "		return parent::delete(\"".$this->key." = '\".\$this->get".$this->default_method_name($this->key)."().\"'\");\n";
			$str .= "	}\n";
					
			$str .= "}\n";
			
			$file = fopen($file,'w');
			@fwrite($file,$str);
			@fclose($file);
		}
	}
	private function file_action(){
	
		$file_path = PROJECT_ROOT. 'application'. SYS_BAR .'controllers'. SYS_BAR .$this->default_name($this->table_name).'Controller.php';
		if(is_file($file_path)){
			include_once($file_path);
			
			$metodo = strtolower(substr($this->file_name,0,1)).substr($this->file_name,1);
			
			if(!method_exists ($this->default_name($this->table_name)."Controller", $metodo."Action")){
				$file = fopen($file_path,'rb');
				$str = "";
				$i = 0;
				
				while(!feof($file))		
					$str .= fread($file,filesize($file_path));

				$str = trim($str);
				$str = trim(substr($str,0,-1));
				
				$str .= "	".$this->get_action()."\n}";
				
				@fclose($file);
				
				$file = fopen($file_path,'w');
				@fwrite($file,$str);
				@fclose($file);
			}//else{
			//	$str = "\n/*".$this->get_action()."\n*/";
			//	$file = fopen($file_path,'a');
			//	@fwrite($file,$str);
			//	@fclose($file);
			//}
		}else{
			$str  = "<?php\n";
			$str .= "/*\n";
			$str .= " * Controle de ".$this->default_name($this->table_name)."\n";
			$str .= " * Data de Cricação - ".date("d/m/Y")."\n";
			$str .= " * @author Leonardo Popik e João Marcos=> Classgen ".$this->classgen_versao."\n";
			$str .= " * @package senapa\n";
			$str .= " * @subpackage senapa.application.controllers\n";
			$str .= " * @version 1.0\n";
			$str .= " */\n";
			$str .= "class ".$this->default_name($this->table_name)."Controller extends Zend_Controller_Action{\n";
			
			$pasta = strtolower($this->default_name($this->table_name));
			
			$str .= "	public function init(){\n";
			$str .= "		include_once(\"Project/include.php\");\n";
			$str .= "	}\n";
			$str .= "	public function datagrid(\$view, \$table, \$display = array()){\n";
			$str .= "		//Exemplo => \$datagrid = new Datagrid('com_endereco', array('id'=>'ID', 'logradouro'=>'Rua'));\n";
			$str .= "		\$datagrid = new Datagrid(\$table,\$display);\n";
			$str .= "		\$view->assign(\"datagrid\",\$datagrid);\n\n";
			$str .= "		\$view->assign(\"body\",\"html/default/datagrid.tpl\");\n";
			$str .= "		\$view->assign(\"header\",\"html/default/header.tpl\");\n";
			$str .= "		\$view->assign(\"footer\",\"html/default/footer.tpl\");\n";
			$str .= "		\$view->output(\"index.tpl\");\n";
			$str .= "	}\n";
			$str .= "	public function acesso(\$view){\n";
			$str .= "		\$funcao = new FuncoesProjeto();\n";
			$str .= "		if(!\$funcao->acesso()){\n";
			$str .= "			\$view->output(\"negado.tpl\");\n";
			$str .= "			die();\n";
			$str .= "		}\n";
			$str .= "	}\n\n";
		    $str .= "	public function indexAction(){\n";
		    $str .= "		\$this->".$this->default_name($this->table_name)."Action();\n";
		    $str .= "	}";
			
		    $str .= $this->get_action();
		    
			$str .= "\n}";
			
			$file = fopen($file_path,'w');
			@fwrite($file,$str);
			@fclose($file);
		}
	}
	
	private function get_action(){
		$db = Zend_Registry::get('db');
    	
    	$innerStr = "";
		foreach($this->restricts as $restrict){
			$nome 	= $this->default_name($restrict);
			$order	= "";
			
			$query 	= "SHOW COLUMNS FROM `".$restrict."`";

			$qr 	= $db->fetchAll($query);
			$fields = array();
			foreach($qr as $col)
				$fields[] = $col['Field'];
			
			if(in_array("sigla",$fields))
				$order = "sigla";
			elseif(in_array("nome",$fields))
				$order = "nome";
			elseif(in_array("logradouro",$fields))
				$order = "logradouro";
				
			$innerStr 	.= "\n			\$".$restrict." 	= new ".$nome."();\n";
    		$innerStr 	.= "			\$".$restrict." 	= \$".$restrict."->fetchAll('1','".$order."');\n";
    		$innerStr 	.= "			\$view->assign(\"".$restrict."\",\$".$restrict.");\n";
    		
		}
    	
    	$file_name = strtolower($this->file_name);

    	$str  = "		\$view = Zend_Registry::get('view');\n\n";		
		$str .= "		\$this->acesso(\$view);\n\n";
		
		$str .= "		\$".$this->table_name." = new ".$this->file_name."();\n\n";		
		
		$str .= "		\$post 	= Zend_Registry::get('post');\n";
		$str .= "		\$get 	= Zend_Registry::get('get');\n\n";
		
		$str .= "		\$funcao 	= new FuncoesProjeto();\n";
		$str .= "		\$display_datagrid = array();\n\n";
		
		$str .= "		if(isset(\$get->action)){";
			
		$str .= $innerStr;
		
		$caminho = PROJECT_ROOT. 'application'. SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR;
		
		$pasta = strtolower($this->default_name($this->table_name));
		if(!is_dir($caminho.$pasta))
			mkdir($caminho.$pasta);
			
		$str .= "			switch(\$get->action){\n";
		$str .= "				case 'edit':\n";
		$str .= "					\$".$this->table_name."->load(\$get->".$this->key.");\n";
		$str .= "					break;\n";
		$str .= "				case 'delete':\n";
		$str .= "					\$".$this->table_name."->load(\$get->".$this->key.");\n";
		$str .= "					\$".$this->table_name."->delete();\n\n";
					
		$str .= "					\$this->_redirect(\"".$pasta."/".$file_name."\");\n";
		$str .= "					die();\n";
		$str .= "			}\n";
			
		$str .= "			\$view->assign(\"".$this->table_name."\",\$".$this->table_name.");\n";
			
		$str .= "\n			\$view->assign(\"header\",\"html/default/header.tpl\");\n";
    	$str .= "			\$view->assign(\"body\",\"".$pasta."/".$file_name.".tpl\");\n";
    	$str .= "			\$view->assign(\"footer\",\"html/default/footer.tpl\");\n";
    	$str .= "			\$view->output(\"index.tpl\");\n";
    	
		$str .= "		}elseif(isset(\$post->".$this->key.")){\n";
		$str .= "			// SALVA E ATUALIZA REGISTRO\n";
		
		$tmp = "";
		foreach($this->columns as $column){
			if($column->get_key() != 'PRI')
				$tmp .= "			\$".$this->table_name."->set".$this->default_method_name($column->get_nome())."(\$funcao->to_sql(\$post->".$column->get_nome()."));\n";
		}
		
		$str .= $tmp."\n";
		
		$str .= "			if(empty(\$post->".$this->key.")){\n";
		$str .= "				// CREATE\n\n";
				
		$str .= "				if(\$".$this->table_name."->insert())\n";				
		$str .= "					\$retorno = array('msg' => 'ok', 'display' => htmlentities('".$this->file_name." inserido com sucesso'), 'url' => '?');\n";
		$str .= "				else\n";
		$str .= "					\$retorno = array('msg' => 'error', 'display' => htmlentities('Erro ao inserir ".$this->file_name."'));\n\n";
		
		$str .= "				die(\$funcao->array2json(\$retorno));\n";
		$str .= "			}else{\n";
		$str .= "				// UPDATE\n";
		$str .= "				\$".$this->table_name."->set".$this->default_method_name($this->key)."(\$post->".$this->key.");\n";
		$str .= "				\$".$this->table_name."->update();\n";
		$str .= "				\$retorno = array('msg' => 'ok', 'display' => htmlentities('".$this->file_name." modificado com sucesso'));\n";
		$str .= "				die(\$funcao->array2json(\$retorno));\n";
		$str .= "			}\n";
		$str .= "		}else{\n";
		$str .= "			// DATAGRID\n";
		$str .= "			\$this->datagrid(\$view, '".$this->table_name."',\$display_datagrid);\n";
		$str .= "		}\n";
		
		$strutura  = "\n	public function ".$file_name."Action(){\n";
		$strutura .= $str;
    	$strutura .= "	}";
    	
    	return $strutura;
	}
	private function get_input($coluna){
		if($coluna->get_key() == 'PRI')
			$this->key = $coluna->get_nome();
			
		$nome 	= $coluna->get_nome();
		$tipo 	= $coluna->get_data_type();
		$class 	= ($coluna->get_key() == 'PRI' || !$coluna->is_null())?"key ":"";
		$class	.= "input";
		$class_length = " normal";
		$length = "";
		if(($pos = strpos($tipo,"("))){
			$pos_tmp = strpos($tipo,")",$pos);
			
			$length = substr($tipo,$pos+1,$pos_tmp-$pos-1);
			$tipo = substr($tipo,0,$pos);
			
			if($length<=10)
				$class_length = " pequeno";
			if($length>100)
				$class_length = " medio";
			if($length>200)
				$class_length = " grande";
		}
		$innerValue = "\$".$this->table_name."->get".$this->default_method_name($nome)."()";
		$value = "{".$innerValue."}";
		
		$input = "";
		if($coluna->get_key() != 'MUL'){
			switch(strtolower($tipo)){
				case "bigint":
				case "int":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,soNumeros)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
					
				case "float":
				case "double":
				case "decimal":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,monetario)\" value=\"".$value."\" />\n";
					break;
				
				case "char":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
					
				case "date":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,data)\" maxlength=\"10\" value=\"{html_data values=".$innerValue."}\" />\n";
					break;
				case "datetime":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,dataHora)\" maxlength=\"19\" value=\"{html_data values=".$innerValue."}\" />\n";
					break;
				case "time":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,hora)\" maxlength=\"5\" value=\"".$value."\" />\n";
					break;
				case "mediumtext":
				case "longtext":
					$input = "<textarea class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\">".$value."</textarea>\n";
					break;
				
				case "tinyint":
					if($length == 1)
						$input = "<input type=\"checkbox\" class=\"".$class."\" id=\"".$nome."\" name=\"".$nome."\"  value=\"1\" {if ".$innerValue."}checked=\"checked\"{/if} />\n";
					else
						$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,soNumeros)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				case "varchar":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				default:
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" value=\"".$value."\" />\n";
			}
			switch($nome){
				case "id":
					$input = "<input type=\"hidden\" id=\"".$nome."\" name=\"".$nome."\" value=\"".$value."\" />\n";
					break;
				case "telefone":
				case "fone":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,telefone)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				case "cpf":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,cpf)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				case "cnpj":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,cnpj)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				case "cep":
					$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,cep_mask)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
				case "senha":
				case "pwd":
				case "password":
					$input = "<input type=\"password\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,soNumeros)\" maxlength=\"".$length."\" value=\"".$value."\" />\n";
					break;
			}
			
			if($tipo != 'date' && $tipo != 'datetime' && strpos(" ".$nome,'dt_') == 1)
				$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,data)\" ".((!empty($length))?"maxlength=\"".$length."\" ":"maxlength=\"10\" ")."value=\"".$value."\" />\n";
			if(strpos(" ".$this->table_name,'telefone') && $nome == 'numero')
				$input = "<input type=\"text\" class=\"".$class.$class_length."\" id=\"".$nome."\" name=\"".$nome."\" onkeypress=\"mascara(this,telefone)\" ".((!empty($length))?"maxlength=\"".$length."\" ":"maxlength=\"14\" ")."value=\"".$value."\" />\n";
				
		}else{
			$var = substr($nome,0,-3);
			$input  = "<select name=".$nome." class=\"".$class.$class_length."\">\n";
			$input .= "								{foreach item=item from=\$".$var."}\n";
			$input .= "									<option value=\"{\$item.id}\" {if \$item.id == ".$innerValue."}selected=\"selected\"{/if}>{\$item.nome}</option>\n";
			$input .= "								{foreachelse}\n";
			$input .= "									<option>Nenhum Registro</option>\n";
			$input .= "								{/foreach}\n";
			$input .= "							</select>\n";
		}
		
		$class 	= ($coluna->get_key() == 'PRI' || !$coluna->is_null())?" required":"";
		
		$str = "					".$input;
		
		if($nome != 'id'){
			$str  = "					<div class=\"line\">\n";
			$str .= "						<label class=\"label".$class."\" for=\"".$nome."\">".$nome."</label>\n";
			$str .= "						<div class=\"innerLine\">\n";
			$str .= "							".$input;
			$str .= "						</div>\n";
			$str .= "					</div>\n";
		}
		return $str;
	}
	private function file_input(){
		$str  = "{*\n";
		$str .= " * ".$this->default_name($this->table_name)." => View de manipulação de dados da classe '".$this->file_name."'\n";
		$str .= " * Data de Cricação - ".date("d/m/Y")."\n";
		$str .= " * @author Leonardo Popik e João Marcos=> Classgen ".$this->classgen_versao."\n";
		$str .= " * @version 1.0\n";
		$str .= " *}\n\n";

		$pasta = strtolower($this->default_name($this->table_name));
		
		$file_name = strtolower($this->file_name);
		
		$str .= "<center>\n";
		$str .= "	<div class=\"body\">\n";
		$str .= "		<div class=\"innerBody\">\n";
		$str .= "			<form id=\"form\" name=\"form\" method=\"post\" action=\"javascript: enviarForm('".BASE_URL."/".$pasta."/".$this->file_name."', 'form', 'save');\" onsubmit=\"return(runAction(this))\">\n";
		$str .= "				<h1>".$this->file_name."</h1>\n";
		$str .= "				<sub>Gerencimento - ".$this->file_name."</sub>\n";
		$str .= "				<div class=\"content\">\n";
		foreach($this->columns as $column)
			$str .= $this->get_input($column);
		$str .= "				</div>\n";	
		$str .= "				<div class=\"controle\">\n";
		$str .= "					<input type=\"submit\" class=\"button save\" value=\"Salvar\" />\n";
		$str .= "					<input type=\"button\" class=\"button back\" value=\"Sair\" onclick=\"voltarForm();\" />\n";
		$str .= "				</div>\n";
		$str .= "			</form>\n";
		$str .= "		</div>\n";
		$str .= "	</div>\n";
		$str .= "</center>\n";
		
		$caminho = PROJECT_ROOT. 'application'. SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR;
		
		if(!is_dir($caminho.$pasta))
			mkdir($caminho.$pasta);
		
		$file_path = $caminho . $pasta . SYS_BAR .$file_name.'.tpl';
		/**
		if(is_file($file_path)){
			$bkp = PROJECT_ROOT. 'application'. SYS_BAR .'views'. SYS_BAR .'scripts'. SYS_BAR .'backup'. SYS_BAR;
			if(!is_dir($bkp))
				mkdir($bkp);
			$bkp .= $file_name;

			rename($file_path, $tmp.date("YmdHis").'.tpl');
		}
		/**/
		if(!is_file($file_path)){
			$file= @fopen($file_path,'w');
			@fwrite($file,$str);
			@fclose($file);
		}
	}
	private function set_restrict(){
		$db 	= Zend_Registry::get('db');
		$tables	= $db->fetchAll("SHOW CREATE TABLE `".$this->table_name."`");
		
		$restricts = array();
		foreach($tables as $table){
			$col = 'Create Table';
			if(isset($table['Create View']))
				$col = 'Create View';
			
			$sql_create 	= trim($table[$col]);
			$pos_constraint = strpos($sql_create,"CONSTRAINT");
			if($pos_constraint > 0){
				$tmp_sql = trim(substr($sql_create,$pos_constraint));
				
				$lista = explode("ACTION",$tmp_sql);
				foreach($lista as $ref){
					$pos = strpos($ref,"REFERENCES `");
					$tmp = substr($ref,$pos);
					$tmp = trim(str_replace("REFERENCES `","",$tmp));
					
					$pos = strpos($tmp,"`");
					$tmp = trim(substr($tmp,0,$pos));
					if(!empty($tmp))
						$restricts[] = $tmp;
				}
			}
		}
		
		$this->restricts = $restricts;
	}
	public function get_file_name(){return $this->file_name;}
	
	private function find_restrict($txt){
		for($i=0;$i<sizeof($this->restricts);$i++){
			if($this->restricts[$i] == $txt)
				return $i;
		}
		return -1;
	}
}