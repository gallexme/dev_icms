<?php
	/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: core
	* 
	* @copyright: 
	* 	Alle Rechte an diesem CMS liegen bei InyaProduction
	*/

class Core{
	protected static $_singleton = null;
	protected static $_config = null;
	protected static $_db = null;
	protected static $_user = null;
	protected static $_libs = array();
	
	/*Konstruktor*/
	function __construct(){
		DEFINE(BASE_URL, dirname(__FILE__)."/");
		session_start();
	}
	
	/*Singleton Manager*/
	static public function getInstance (){
		if (is_null(self::$_singleton)) {
			self::$_singleton = new Core ();
		}
		return self::$_singleton;
	}
	
	/*Hauptklasse. Führt das CMS aus*/
	public function run(){
		$this	->_getConfig();
		$this	->_setCustomConfig();
		$this	->_getDb();
		self	::config()->setDatabaseOptions();
		$this	->_loadStyleSettings(self::config()->getConfig('style'));
		$this	->getLib('User')->loadUser();
		$this	->_loadStandardTemplates();
	}
	
	protected function _loadStandardTemplates(){
		if(!isset($_GET['api'])){
			$this	->getLib('Template')->load('header');
			$this	->getLib('Template')->load('navi');
			$this	->getLib('Template')->load('title');
			$this	->getLib('Template')->load('contentstart');
			$this	->getLib('Template')->load('content');
			$this	->getLib('Template')->load('contentright');
			$this	->getLib('Template')->load('contentstop');
			$this	->getLib('Template')->load('footer');
		} else {
			$this->getLib('Template')->load('api');
		}
	}
	
	/*Konfiguration laden*/
	protected function _getConfig(){
		$configFileName = "config.inc.php";
		include_once(BASE_URL."inc/config/$configFileName");
		self::$_config = new Config();
		return $this;
	}
	
	protected function _loadStyleSettings($style){
		include_once(BASE_URL."styles/$style/config/config.php");
		new StyleConfig;
	}
	
	protected function _getDb(){
		$dbFileName = "Mysqllib.php";
		include_once(BASE_URL."libs/$dbFileName");
		$mysql = self::$_config->getConfig('mysql');
		$host = $mysql['mysql_host'];
		$user = $mysql['mysql_user'];
		$pass = $mysql['mysql_pass'];
		$db = $mysql['mysql_db'];
		self::$_db = new db($host, $user, $pass, $db);
		return $this;
	}
	
	protected function _getUser(){
		$UserFileName = "User.php";
		include_once(BASE_URL."libs/$UserFileName");
		self::$_db = new User();
		return $this;
	}
	
	/*Entwickler Optionen. Für optimale Sicherheit nicht verändern*/
	protected function _setCustomConfig(){
		self::$_config	->setConfig('error_reporting', true)
				->setConfig('developer_mode', false);
	}
	
	//Autoloader for helper
	public function getLib($lib, $reload = false){
		$libPath = BASE_URL."libs/".$lib.".php";
		if(is_null(self::$_libs['AbstractLib'])){
			include_once(BASE_URL.'libs/AbstractLib.php');
			self::$_libs['AbstractLib'] = new AbstractLib();
		}
		
		if(!is_null(self::$_libs[$lib]) && $reload == false){
			return self::$_libs[$lib];
		} else {
			include_once($libPath);
			self::$_libs[$lib] = new $lib();
			return self::$_libs[$lib];
		}
	}
	
	public static function db(){
		if (is_null(self::$_db))
			self::_getDb();
		return self::$_db;
	}
	
	public static function config(){
		if (is_null(self::$_config))
			$this->_getConfig();
		return self::$_config;
	}
	
	public static function user(){
		if (is_null(self::$_user))
			self::_getUser();
		return self::$_user;
	}
	
	public function getPageTitle(){
		$url_key = self::getLib('Url')->getPath();
		$url_key = self::db()->escape($url_key);
		$url_key = htmlentities($url_key);
		$titledb = self::db()->query("SELECT title FROM icms_navi WHERE url_key = '".$url_key."'");
		$title = $titledb->fetch_object();
		if(strlen($title->title)>0)
			return self::config()->getConfig('title')." - ".$title->title;
		else
			return self::config()->getConfig('title')." - Seite nicht gefunden";
	}
}	