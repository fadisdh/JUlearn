<?php

abstract class Model{
	protected $registry;
	
	public function __construct($registry){
		$this -> registry = $registry;	
	}
}