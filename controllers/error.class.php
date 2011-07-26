<?php

class errorController extends Controller{
	
	public function index($params){
		echo '404 Page not found.';
		
		if($params['errorController']){
			echo "\r\n Controller '" . $this -> registry -> router -> getControllerName() . "' Not Found.";	
		}
		
		if($params['errorAction']){
			echo "\r\n Action '" . $this -> registry -> router -> getActionName() . "' Not Found.";	
		}
	}
}