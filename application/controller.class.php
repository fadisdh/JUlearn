<?php

abstract class Controller{
	protected $registry;
	
	public function __construct($registry){
		$this -> registry = $registry;
	}
}