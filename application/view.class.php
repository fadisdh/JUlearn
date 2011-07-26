<?php

abstract class View{
	protected $registry;
	
	public function __construct($registry){
		$this -> registry = $registry;	
	}
}