<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: SessionLib
	*/

class Session extends AbstractLib{

	public function getSession($index){
		if(isset($_SESSION[$index]))
			return null;
		return $_SESSION[$index];
	}

	public function setSession($index, $value){
		$_SESSION[$index] = $value;
	}
	
	public function delSession($index){
		if(isset($_SESSION[$index]))
			return false;
		unset($_SESSION[$index]);
		return true;
	}
	
}