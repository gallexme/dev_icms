<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: config
	*/

class Config{

	protected static $_settings = array();
	function __construct(){
		self::$_settings = array(
			'mysql'		=> array(
						'mysql_host'	=> '',
						'mysql_user'	=> '',
						'mysql_pass'	=> '',
						'mysql_db'	=> 'testdb',
						),
			'pluginDir'	=> 'plugins',
		);
	}
	
	public function getData(){
		$protected_settings = array('mysql', 'error_reporting');
		$settings = self::$_settings;
		foreach($protected_settings as $protect){
			$settings[$protect] = "protected setting";
		}
		return $settings;
	}
	
	public function setDatabaseOptions(){
		$options = Core::db()->query("SELECT * FROM icms_options");
		while($option = $options->fetch_object()){
			self::$_settings[$option->option] = $option->value;
		}
	}
	
	public function getConfig($index = null){
		if(!isset(self::$_settings[$index])){
			return $this->getData();
		} else {
			return self::$_settings[$index];
		}
	}
	
	public function setConfig($index, $value){
		self::$_settings[$index] = $value;
		return $this;
	}
	
}	