<?php

class Registry{
	protected $vars = array();
	
	// get var ie. $value = $register -> key;
	public function __get($key){
		if(isset($this -> vars[$key])){
			return $this -> vars[$key];
		}else{
			return false;	
		}
	}
	
	// set var ie. $register -> key = val; 
	public function __set($key, $val){
		$this -> vars[$key] = $val;
	}
}