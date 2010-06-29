<?php
/*
class Datagrid{
	private $table;
	private $key;
	private $object_name;
	public 	$columns;
	private $length;
	private $data;
	private $where;
	private $title;
	
	public function __construct($table, $where = "", $columns = array(), $title = ""){
		$this->table 	= $table;
		$this->set_title($title);
		$this->columns 	= $columns;
		$this->set_where($where);
		$this->object_name = $this->default_name($table);
		$this->get_header();
	}
	private function default_name($file_name){
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
	public function get_header(){
		$db 		= Zend_Registry::get('db');
		$colunas 	= array();
		$this->data	= array();
		
		$query 	= "SHOW COLUMNS FROM `".$this->get_table()."`";
			
		$cols 	= $db->fetchAll($query);
		
		foreach($cols as $coluna){
			if($coluna['Key'] == 'PRI')
				$this->set_key($coluna['Field']);
			$colunas[] = new Coluna(array($coluna['Field'],$coluna['Field']), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
		}
		$vars = "*";
		if(sizeof($this->columns)){
			$vars = $this->get_key().",";
			$colunas = array();
			foreach($this->columns as $key => $column){
				$vars .= "`".$key."`,";
				$query 	= "SHOW COLUMNS FROM `".$this->get_table()."` WHERE `Field` = '".$key."'";
				
				$cols 	= $db->fetchAll($query);
				foreach($cols as $coluna)
					$colunas[] = new Coluna(array($key, $column), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
			}
			$vars = trim(substr($vars,0,-1));
		}
		$this->columns = $colunas;
		$this->set_length(sizeof($this->columns));
	
		$query 	= "SELECT ".$vars." FROM `".$this->get_table()."`";
		if($this->get_where())
			$query .= " WHERE ".$this->get_where();
			
		$qr 	= $db->fetchAll($query);
		foreach($qr as $linha){
			$object = new $this->object_name();
			$object = $object->fetchRow("`".$this->get_key()."` = '".$linha[$this->get_key()]."'");
			
			$this->data[] = $object;
		}
	}
	public function display(){
		$funcao = new FuncoesProjeto();
		$header = "";
		foreach($this->get_columns() as $column){
			$tmp = $column->get_nome();
			$header .= "<td>".$tmp[1]."</td>\n";
		}
		$header .= "<td class=\"data_controller\">&nbsp;</td>\n";
		
		$i = 0;
		$data = "";
		foreach($this->get_data() as $value){
			$data .= "<tr class=\"dg_body".(($i++%2 == 0)?" tr_color":"")."\">\n";
			foreach($this->get_columns() as $key => $column){
				$tmp = $column->get_nome();
				$tmp_value = "";
				switch(strtoupper($column->get_data_type())){
					case 'DATE':
					case 'DATETIME':
						$tmp_value = $funcao->to_date($value->$tmp[0], false);
						break;
					default:
						$tmp_value = $value->$tmp[0];
				}
				$data .= "<td>".$tmp_value."&nbsp;</td>\n";
			}
			$chave = $this->get_key();
			$data .= "
				<td class=\"data_controller_td\">
					<ul class=\"data_controller_ul\">
						<li><a class=\"li_a_edit\" href=\"javascript: openPage('".strtolower($this->get_object_name())."','get', 'action=edit&".$this->get_key()."=".$value->$chave."');\" title=\"Editar Registro\"><span>Editar</span></a></li>
						<li><a class=\"li_a_delete\" href=\"javascript: confirm('Deseja excluir o registro?','javascript: openPage(\'".strtolower($this->get_object_name())."\',\'get\', \'action=delete&".$this->get_key()."=".$value->$chave."\');');\" title=\"Excluir Registro\"><span>Excluir</span></a></li>
					</ul>
				</td>\n";
			$data .= "</tr>\n";
		}
		if(empty($data))
			$data = "<tr class=\"dg_body\"><td colspan=\"".(sizeof($this->get_columns())+1)."\">Nenhum Registro Cadastrado</td></tr>";
		
		$controller = "
		<div class=\"dg_controller\">
			<ul class=\"dg_controller_ul\">
				<li><a class=\"li_a_insert\" href=\"javascript: openPage('".strtolower($this->get_object_name())."','get', 'action=insert');\" title=\"Novo Registro\"><span>Novo</span></a></li>
				<li><a class=\"li_a_find\" href=\"javascript: alert('Em Desenvolvimento')\" title=\"Pesquisar Registro\"><span>Buscar</span></a></li>
				<li><a class=\"li_a_refresh\" href=\"javascript: openPage('".strtolower($this->get_object_name())."');\" title=\"Recarregar Tabela\"><span>Recarregar</span></a></li>
			</ul>
		";
		if($this->get_title())
			$controller .= "<span class=\"dg_controller_title\">".$this->get_title()."</span>";
		$controller .=
		"
		</div>
		";
		$str = "
		<div class=\"dg_table\">
			<table class=\"datagrid\" cellpadding=\"0\" cellspacing=\"0\">
				<tr class=\"dg_controller_tr\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">".$controller."</td>
				</tr>
				<tr class=\"dg_blank\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">&nbsp;</td>
				</tr>
				<!-- HEADER -->
				<tr class=\"dg_header\">	
					".$header."
				</tr>
				<!-- DATA -->
				".$data."
				<!-- FOOTER -->
				<tr class=\"dg_footer\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">Copyright © Léo Popik 2010 / ".date("Y")."</td>
				</tr>
			</table>
		</div>
		";
		return "<center>".$str."</center>";
	}
	public function get_table(){return $this->table;}
	public function set_table($var){$this->table = $var;}

	public function get_key(){return $this->key;}
	public function set_key($var){$this->key = $var;}
	
	public function get_object_name(){return $this->object_name;}
	public function set_object_name($var){$this->object_name = $var;}
	
	public function get_columns(){return $this->columns;}
	public function set_columns($var){$this->columns = $var;}

	public function get_length(){return $this->length;}
	public function set_length($var){$this->length = $var;}

	public function get_data(){return $this->data;}
	public function set_data($var){$this->data = $var;}

	public function get_where(){return $this->where;}
	public function set_where($var){$this->where = $var;}
	
	public function get_title(){return $this->title;}
	public function set_title($var){$this->title = $var;}
}
*/

class Datagrid{
	
	private $title;	
	private $table;
	
	private $columns;
	private $length;
	
	private $where;
	private $order;
	
	private $data;
	private $key;
	private $object_name;
	
	public function __construct($title, $table,$where, $columns = array(), $order = "", $length = ""){
		$this->set_title($title);
		$this->set_table($table);
		
		$this->set_where($where);
		$this->set_columns($columns);
		$this->set_order($order);		
		$this->set_length($length);
		
		$this->set_object_name($this->default_name($table));		
		$this->set_key();
	}
	private function default_name($file_name){
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
	private function columns($table, $array){
		$db	= Zend_Registry::get('db');
		
		$colunas = array();//sigla
		$vars = $array['sigla'].".*";
		$vars = " ";
		
		foreach($array['data'] as $nodo => $value){
			$vars .= $array['sigla'].".`".$nodo."`,";
			$query 	= "SHOW COLUMNS FROM `".$table."` WHERE `Field` = '".$nodo."'";
					
			$cols 	= $db->fetchAll($query);
			foreach($cols as $coluna)
				$colunas[] = new Coluna(array($nodo, $value), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
		}
		
		$vars = trim(substr($vars,0,-1));
		return array('vars'=> $vars, 'colunas' => $colunas);
	}
	
	public function defaultLays(){
		if($this->get_columns() && sizeof($this->get_columns()))
			$this->byKeyName();
		else
			$this->bySchema();
		return $this->display();
	}
	private function bySchema(){
		$db	= Zend_Registry::get('db');
		
		$query 	= "SHOW COLUMNS FROM `".$this->get_table()."`";				
		$schema	= $db->fetchAll($query);
		$colunas = array();
		
		$vars = "*";
		if($this->get_key())
			$vars = "`".$this->get_key()."`,";
			
		foreach($schema as $key => $column){
			if($this->get_key() != $column['Field'])
				$vars .= "`".$column['Field']."`,";
				
			$query 	= "SHOW COLUMNS FROM `".$this->get_table()."` WHERE `Field` = '".$column['Field']."'";
			
			$cols 	= $db->fetchAll($query);
			foreach($cols as $coluna)
				$colunas[] = new Coluna(array($column['Field'], $column['Field']), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
		}
		$vars = trim(substr($vars,0,-1));

		$this->set_columns($colunas);
		
		$query 	= "SELECT ".$vars." FROM `".$this->get_table()."`";

		$query .= $this->get_where().$this->get_order().$this->get_length();
		
		$qr 	= $db->fetchAll($query);
		foreach($qr as $linha)
			$this->data[] = $linha;
		
	}
	
	private function byKeyName(){

		$db	= Zend_Registry::get('db');

		$colunas = array();
		$relacionamento = array();
		
		$vars = "A.*";
		if($this->get_key())
			$vars = "A.`".$this->get_key()."`,";
			
		foreach($this->get_columns() as $key => $column){
			if(is_array($column)){
				if($column['subconsulta']){
					$tmp = $column['subconsulta'];
					foreach($column['data'] as $keyData => $tmpData){
						$vars .= "(SELECT `".$keyData."` FROM `".$key."` WHERE `".$tmp['this']."` = A.`".$tmp['other']."`".$column['complement']." LIMIT 1) AS '".(($column['sigla'])?$column['sigla']."_":"").$keyData."',";
						
						$query 	= "SHOW COLUMNS FROM `".$key."` WHERE `Field` = '".$keyData."'";
				
						$cols 	= $db->fetchAll($query);
						foreach($cols as $coluna)
							$colunas[] = new Coluna(array((($column['sigla'])?$column['sigla']."_":"").$keyData, $tmpData), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
						
					}
				}else{
					$relacionamento[$key] = $column;
					
					$tmp = $this->columns($key,$column);
					if(sizeof($tmp['colunas'])){
						$vars .= $tmp['vars'].",";
						foreach($tmp['colunas'] as $coluna)
							$colunas[] = $coluna;
					}
				}
			}else{
				$key = trim($key);
				if($this->get_key() != $key){
					$vars .= "A.`".$key."`,";
				}
					
				$query 	= "SHOW COLUMNS FROM `".$this->get_table()."` WHERE `Field` = '".$key."'";
				
				$cols 	= $db->fetchAll($query);
				foreach($cols as $coluna)
					$colunas[] = new Coluna(array($key, $column), $coluna['Type'], (($coluna['Null'] == 'YES')?true:false), (($coluna['Extra'] == 'auto_increment')?true:false), $coluna['Default'], $coluna['Key']);
			}
		}
		$vars = trim(substr($vars,0,-1));

		$this->set_columns($colunas);
		
		$query 	= "SELECT ".$vars." FROM `".$this->get_table()."` A";
		if(sizeof($relacionamento)){
			$query .=", ";
			foreach($relacionamento as $table => $linha)
				$query .= "`".$table."` ".$linha['sigla'].", ";
			$query = trim(substr($query,0,-2));
		}

		$query .= $this->get_where();
		
		if(sizeof($relacionamento)){
			if($this->get_where())
				$query .= " AND ";
			else
				$query .= " WHERE ";
			$tmpWhere = "     ";	
			foreach($relacionamento as $table => $linha)
				$tmpWhere .= " A.".$linha['relacionamento']['other']." = ".$linha['sigla'].".".$linha['relacionamento']['this']." AND ";
			$query .= trim(substr($tmpWhere,0,-5));	
		}
		$query .= $this->get_order().$this->get_length();

		/**/
		$qr 	= $db->fetchAll($query);		
		foreach($qr as $linha)
			$this->data[] = $linha;
		/**/
	}
	private function display(){
		$funcao = new FuncoesProjeto();
		$header = "";
		foreach($this->get_columns() as $column){
			$tmp = $column->get_nome();
			$header .= "<td>".$tmp[1]."</td>\n";
		}
		$header .= "<td class=\"data_controller\">&nbsp;</td>\n";
		
		$i = 0;
		$data = "";
		$tam = 180;
		foreach($this->get_data() as $value){
			$data .= "<tr class=\"dg_body".(($i++%2 == 0)?" tr_color":"")."\">\n";
			foreach($this->get_columns() as $key => $column){
				$tmp = $column->get_nome();
				$tmp_value = "";
				switch(strtoupper($column->get_data_type())){
					case 'DATE':
					case 'DATETIME':
						$tmp_value = $funcao->to_date($value[$tmp[0]], false);
						break;
					case 'TINYINT(1)':
						if($value[$tmp[0]])
							$tmp_value = "<img border=\"0\" width=\"16\" height=\"16\" src=\"".BASE_URL."/public/images/admin/datagrid/ok_16.png\" />";
						else
							$tmp_value = "<img border=\"0\" width=\"16\" height=\"16\" src=\"".BASE_URL."/public/images/admin/datagrid/error_16.png\" />";
						break;
					default:
						$tmp_value = $funcao->getResumo($value[$tmp[0]],180);
				}
				$data .= "<td>".$tmp_value."&nbsp;</td>\n";
			}
			$chave = $this->get_key();
			$data .= "
				<td class=\"data_controller_td\">
					<ul class=\"data_controller_ul\">
						<li><a class=\"li_a_edit\" href=\"javascript: openPage('".strtolower($this->get_object_name())."','get', 'action=edit&".$this->get_key()."=".$value[$chave]."');\" title=\"Editar Registro\"><span>Editar</span></a></li>
						<li><a class=\"li_a_delete\" href=\"javascript: confirm('Deseja excluir o registro?','javascript: openPage(\'".strtolower($this->get_object_name())."\',\'get\', \'action=delete&".$this->get_key()."=".$value[$chave]."\');');\" title=\"Excluir Registro\"><span>Excluir</span></a></li>
					</ul>
				</td>\n";
			$data .= "</tr>\n";
		}
		if(empty($data))
			$data = "<tr class=\"dg_body\"><td colspan=\"".(sizeof($this->get_columns())+1)."\">Nenhum Registro Cadastrado</td></tr>";
		
		$controller = "
		<div class=\"dg_controller\">
			<ul class=\"dg_controller_ul\">
				<li><a class=\"li_a_insert\" href=\"javascript: openPage('".strtolower($this->get_object_name())."','get', 'action=insert');\" title=\"Novo Registro\"><span>Novo</span></a></li>
				<li><a class=\"li_a_find\" href=\"javascript: alert('Em Desenvolvimento')\" title=\"Pesquisar Registro\"><span>Buscar</span></a></li>
				<li><a class=\"li_a_refresh\" href=\"javascript: openPage('".strtolower($this->get_object_name())."');\" title=\"Recarregar Tabela\"><span>Recarregar</span></a></li>
			</ul>
		";
		if($this->get_title())
			$controller .= "<span class=\"dg_controller_title\">".$this->get_title()."</span>";
		$controller .=
		"
		</div>
		";
		$str = "
		<div class=\"dg_table\">
			<table class=\"datagrid\" cellpadding=\"0\" cellspacing=\"0\">
				<tr class=\"dg_controller_tr\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">".$controller."</td>
				</tr>
				<tr class=\"dg_blank\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">&nbsp;</td>
				</tr>
				<!-- HEADER -->
				<tr class=\"dg_header\">	
					".$header."
				</tr>
				<!-- DATA -->
				".$data."
				<!-- FOOTER -->
				<tr class=\"dg_footer\">
					<td colspan=\"".(sizeof($this->get_columns())+1)."\">Copyright © Léo Popik 2010 / ".date("Y")."</td>
				</tr>
			</table>
		</div>
		";
		return "<center>".$str."</center>";
	}
	
	public function get_title(){return $this->title;}
	public function set_title($var){$this->title = $var;}
	
	public function get_table(){return $this->table;}
	public function set_table($var){$this->table = $var;}

	public function get_key(){
		if(!$this->key)
			$this->set_key();
		return $this->key;
	}
	public function set_key($var){
		if(empty($var)){
			$db 		= Zend_Registry::get('db');
			
			$query 	= "SHOW COLUMNS FROM `".$this->get_table()."` WHERE `Key` = 'PRI'";				
			$row 	= $db->fetchRow($query);
			
			if($row['Key'])			
				$var = $row['Field'];
		}
		$this->key = $var;
	}
	
	public function get_object_name(){return $this->object_name;}
	public function set_object_name($var){$this->object_name = $var;}
	
	public function get_columns(){return $this->columns;}
	public function set_columns($var){$this->columns = $var;}
	
	public function get_data(){return $this->data;}
	public function set_data($var){$this->data = $var;}

	public function get_length(){
		if($this->length)
			return " LIMIT ".$this->length;
		return "";
	}
	public function set_length($var){$this->length = $var;}

	public function get_where(){
		if($this->where)
			return " WHERE ".$this->where;
		return "";
	}
	public function set_where($var){$this->where = $var;}
	
	public function get_order(){
		if($this->order)
			return " ORDER BY ".$this->order;
		return "";
	}
	public function set_order($var){$this->order = $var;}
}