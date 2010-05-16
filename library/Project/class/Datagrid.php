<?php
class Datagrid{
	private $table;
	private $key;
	private $object_name;
	public $columns;
	private $length;
	private $data;
	private $where;
	
	public function __construct($table, $where = "", $columns = array()){
		$this->table 	= $table;
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
			$vars = " ";
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
			<ul class=\"db_controller_ul\">
				<li><a class=\"li_a_insert\" href=\"javascript: openPage('".strtolower($this->get_object_name())."','get', 'action=insert');\" title=\"Novo Registro\"><span>Novo</span></a></li>
				<li><a class=\"li_a_find\" href=\"javascript: alert('Em Desenvolvimento')\" title=\"Pesquisar Registro\"><span>Buscar</span></a></li>
				<li><a class=\"li_a_refresh\" href=\"javascript: openPage('".strtolower($this->get_object_name())."');\" title=\"Recarregar Tabela\"><span>Recarregar</span></a></li>
			</ul>
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
}