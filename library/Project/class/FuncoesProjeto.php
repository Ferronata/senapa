<?php
class FuncoesProjeto{
	/**
	 * Transforma os dados de um array numa string JSON
	 *
	 * Json é muito usado para a comunicação AJAX entre o javascript e o php,
	 * Principalmente porque no javascript ele se torna um objeto após executar-mos
	 * um eval!
	 *
	 * @param Array $arr
	 * @return string
	 */
	public function array2json($arr){
		return $this->php2js($arr);
	}
	public function php2js($a=false){
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a))
		{
			if (is_float($a))
			{
				// Always use "." for floats.
				$a = str_replace(",", ".", strval($a));
			}
	
			// All scalars are converted to strings to avoid indeterminism.
			// PHP's "1" and 1 are equal for all PHP operators, but
			// JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
			// we should get the same result in the JS frontend (string).
			// Character replacements for JSON.
			static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
			array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a))
		{
			if (key($a) !== $i)
			{
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList)
		{
			foreach ($a as $v) $result[] = $this->php2js($v);
			return '[ ' . join(', ', $result) . ' ]';
		}
		else
		{
			foreach ($a as $k => $v) $result[] = $this->php2js($k).': '.$this->php2js($v);
			return '{ ' . join(', ', $result) . ' }';
		}
	}
	public function to_sql($value){
		
		if(is_string($value))
			$value = utf8_decode(html_entity_decode($value, ENT_QUOTES, 'ISO-8859-1'));
		if(empty($value))
			return NULL;	
		return $value;
	}
	public function to_date($data, $banco = true){
		$data = trim($data);
		$dt = "";
		if(strlen($data)>=10 && (int)(str_replace("-","",$data)) && (int)(str_replace("/","",$data)) && (int)(str_replace(".","",$data))){
			if($banco){
				$dt = substr($data,6,4)."-".substr($data,3,2)."-".substr($data,0,2);
				if(strlen($data)>10)
					$dt .= substr($data,10);
			}else{
				$dt = substr($data,8,2)."/".substr($data,5,2)."/".substr($data,0,4);
				if(strlen($data)>10)
					$dt .= substr($data,10);
			}
		}
		return $dt;
	}
	public function acesso($session){
		if(empty($session->usuario))
			return false;
		return true;
	}
	
	function get_rnd_iv($iv_len){
	    $iv = '';
	    while ($iv_len-- > 0)
	        $iv .= chr(mt_rand() & 0xff);
	    return $iv;
	}
	
	function md5_encrypt($plain_text, $password = "", $iv_len = 64){
		$password = (!empty($password))?$password:"senapa";
		
	    $plain_text .= "\x13";
	    $n = strlen($plain_text);
	    if ($n % $iv_len) $plain_text .= str_repeat("\0", $iv_len - ($n % $iv_len));
	    $i = 0;
	    $enc_text = $this->get_rnd_iv($iv_len);
	    $iv = substr($password ^ $enc_text, 0, 512);
	    while ($i < $n) {
	        $block = substr($plain_text, $i, $iv_len) ^ pack('H*', md5($iv));
	        $enc_text .= $block;
	        $iv = substr($block . $iv, 0, 512) ^ $password;
	        $i += 16;
	    }
	    return base64_encode($enc_text);
	}
	
	function md5_decrypt($enc_text, $password = "", $iv_len = 64){
		$password = (!empty($password))?$password:"senapa";
		
	    $enc_text = base64_decode($enc_text);
	    $n = strlen($enc_text);
	    $i = $iv_len;
	    $plain_text = '';
	    $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
	    while ($i < $n) {
	        $block = substr($enc_text, $i, $iv_len);
	        $plain_text .= $block ^ pack('H*', md5($iv));
	        $iv = substr($block . $iv, 0, 512) ^ $password;
	        $i += $iv_len;
	    }
	    return preg_replace('/\\x13\\x00*$/', '', $plain_text);
	}
	function datagrid($view, $table, $display = array(), $where = "", $title = ""){
		//Exemplo => $datagrid = new Datagrid('com_endereco', array('id'=>'ID', 'logradouro'=>'Rua'));
		$datagrid = new Datagrid($title, $table,$where, $display);
		//$datagrid = new Datagrid($table,$where,$display,$title);
		$view->assign("datagrid",$datagrid);

		$view->assign("body","html/default/datagrid.tpl");
		$view->assign("header","html/default/header.tpl");
		$view->assign("footer","html/default/footer.tpl");
		$view->output("index.tpl");
	}
	public function getResumo($tmp_value,$length = ""){
		$tam = trim($length);
		if(empty($tam))
			$tam = 60;
		$str = trim(strip_tags($tmp_value));
		if(strlen($str)>$tam){
			$tmp = strpos($str," ",$tam+1);
			if($tmp>0){
				$str = substr($str,0,$tmp);
				$str = trim($str)."...";
			}
			else
				$str = substr($str,0,$tam);
			
		}			
		return $str;
	}
	function timeToSec($tempo){	
		// SEPARA A STRING EM HORAS, MINUTOS E SEGUNDOS
		$hh = substr($tempo,0,2);
		$mm = substr($tempo,3,2);
		$ss = substr($tempo,6,2);
		
		// CONVERTE EM SEGUNDOS
		$total = $hh*60;
		$total = $total+$mm;
		$total = $total*60;
		$total = $total+$ss;
		return $total;
	}
	function mediaAritimetica($array) {
		return array_sum($array)/sizeof($array);
	}
	function varianca($array) {
		$length = sizeof($array);
		$u = $this->mediaAritimetica($array);
		
		$sum = 0;
		foreach($array as $linha)
			$sum += (double)pow(($linha-$u),2);

		return ($sum/($length-1));
	}
   
	function desvio_padrao($array) {
		return sqrt($this->varianca($array));
	}
	
}