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
	public function acesso(){
		return true;
	}
	
	function get_rnd_iv($iv_len){
	    $iv = '';
	    while ($iv_len-- > 0)
	        $iv .= chr(mt_rand() & 0xff);
	    return $iv;
	}
	
	function md5_encrypt($plain_text, $password = "sga", $iv_len = 16){
	    $plain_text .= "\x13";
	    $n = strlen($plain_text);
	    if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
	    $i = 0;
	    $enc_text = $this->get_rnd_iv($iv_len);
	    $iv = substr($password ^ $enc_text, 0, 512);
	    while ($i < $n) {
	        $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
	        $enc_text .= $block;
	        $iv = substr($block . $iv, 0, 512) ^ $password;
	        $i += 16;
	    }
	    return base64_encode($enc_text);
	}
	
	function md5_decrypt($enc_text, $password = "sga", $iv_len = 16){
	    $enc_text = base64_decode($enc_text);
	    $n = strlen($enc_text);
	    $i = $iv_len;
	    $plain_text = '';
	    $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
	    while ($i < $n) {
	        $block = substr($enc_text, $i, 16);
	        $plain_text .= $block ^ pack('H*', md5($iv));
	        $iv = substr($block . $iv, 0, 512) ^ $password;
	        $i += 16;
	    }
	    return preg_replace('/\\x13\\x00*$/', '', $plain_text);
	}
}