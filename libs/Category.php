<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: CategoryLib
	*/

class Category extends AbstractLib{ 

	protected static $_category;
	function __construct(){
		$path = Core::getInstance()->getLib('Url')->getPath();
		$path = Core::db()->escape($path);
		$path = htmlentities($path);
		$query = Core::db()->query("SELECT * FROM icms_navi WHERE url_key = '$path';");
		self::$_category = $query->fetch_object();
	}
	
	public function getCategoryInformation(){
		return self::$_category;
	}
	
	public function getId(){
		return self::$_category->id;
	}
	
}