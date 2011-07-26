<?php

class Router{
	protected $query = array();
	protected $path;
	protected $controller;
	protected $action;
	protected $params;
	protected $registry;
	
	public function __construct($query, $registry){
		$query = explode('/', $query);
		$this -> controller = ($query[0] ? $query[0] : 'home');
		$this -> action = ($query[1] ? $query[1] : 'index');
		$this -> params = (count($query) > 2) ? array_slice($query, 2) : array();
		
		$this -> path = URL . '/controllers';
		$this -> registry = $registry;
	}
	
	public function getPath(){
		return $this -> path;
	}
	
	public function setPath($val){
		if(is_dir($val)){
			$this -> path = $val;	
		}else{
			throw new Exception('Invalid Path: ' . $val);
		}
	}
	
	public function getControllerName(){
		return $this -> controller;	
	}
	
	public function getActionName(){
		return $this -> action;
	}
	
	public function getParams(){
		return $this -> params;
	}
	
	public function getController(){
		$file = $this -> path . '/' . $this -> controller . '.class.php';
		
		if(file_exists($file)){
			include $file;
			
			$class = $this -> controller . 'Controller'; 
			$this -> registry -> controller = new $class($this -> registry);
		}else{
			$this -> params['errorController'] = true;
			include $this -> path . '/error.class.php';
			$this -> registry -> controller = new errorController($this -> registry);
			//throw new Exception('Invalid Controller File: ' . $file);	
		}
		
		return $this -> registry -> controller;
	}
	
	public function callAction(){
		if($this -> controller && $this -> action){
			if(!is_a($this -> registry -> controller, 'Controller')) $this -> getController();
			$action = $this -> action;
			if(is_callable(array($this -> registry -> controller, $action))){
				$this -> registry -> controller -> $action($this -> params);
			}else{
				$this -> params['errorAction'] = true;
				$this -> registry -> controller -> index($this -> params);
				//throw new Exception('Action does not exists in the Controller.');	
			}
		}else{
			throw new Exception('Controller or Action is not defined.');	
		}
	}
	
	public function getPage(){
		$this -> getController();
		$this -> callAction();
	}
}