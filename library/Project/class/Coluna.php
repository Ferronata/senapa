<?php
class Coluna{
	private $nome;
	private $data_type;
	private $null;
	private $increment;
	private $default;	
	private $primary_key;
	
	public function __construct($nome, $data_type, $null, $increment, $default, $primary_key){
		$this->set_nome($nome);
		$this->set_data_type($data_type);
		$this->set_null($null);
		$this->set_auto_increment($increment);
		$this->set_default($default);
		$this->set_key($primary_key);
	}
	
	public function equals($coluna){
		if(
			strtolower($this->get_nome()) 		== strtolower($coluna->get_nome()) && 
			strtolower($this->get_data_type()) 	== strtolower($coluna->get_data_type()) && 
			$this->is_null() 					== $coluna->is_null() && 
			$this->is_auto_increment() 			== $coluna->is_auto_increment() && 
			strtolower($this->get_default()) 	== strtolower($coluna->get_default()) && 
			strtolower($this->get_key()) 		== strtolower($coluna->get_key())
		)
			return true;
		return false;
	}
	
	public function to_string(){
		$str = "Coluna: ".$this->get_nome()." - ".$this->get_data_type()." - ".$this->is_null()." - ".$this->is_auto_increment()." - ".$this->get_default()." - ".$this->get_key();
		return $str;
	}
	
	public function get_nome(){return $this->nome;}
	public function set_nome($var){$this->nome = $var;}
	
	public function get_data_type(){return $this->data_type;}
	public function set_data_type($var){$this->data_type = trim($var);}

	public function is_null(){return $this->null;}
	public function set_null($var){$this->null = $var;}

	public function is_auto_increment(){return $this->increment;}
	public function set_auto_increment($var){$this->increment = $var;}

	public function get_default(){return $this->default;}
	public function set_default($var){$this->default = trim($var);}

	public function get_key(){return $this->primary_key;}
	public function set_key($var){$this->primary_key = trim($var);}	
}