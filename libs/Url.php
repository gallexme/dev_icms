<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: UrlLib
	*/

class Url extends AbstractLib{
	
	protected static $_path = array();
	
	function __construct(){
		$this->prepare();
	}
	
	public function prepare(){
		$url =  $_SERVER["REQUEST_URI"];
		$url = explode("?", $url);
		self::$_path = 'zerofiller';
		self::$_path = explode("/", $url[0]);
	}
	
	public function getPath($pos = 1){
		if (isset(self::$_path[$pos]) && strlen(self::$_path[$pos]) > 0){
			return Core::db()->escape(htmlentities(self::$_path[$pos]));
		} else {
			return 'home';
		}
	}
}
		
