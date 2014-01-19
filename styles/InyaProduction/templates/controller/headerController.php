<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: headerController
	*/

class headerController extends abstractController{

	protected static $_url = null;
	function __construct(){
		self::$_url = Core::config()->getConfig('baseUrl');
	}

	public function getJavascripts(){
		if(is_array(Core::config()->getConfig('javascripts')))
			return Core::config()->getConfig('javascripts');
		return array();
	}
	
	public function getJavascriptPath($javascript){
		$jsPath = self::$_url."/styles/".Core::config()->getConfig('style')."/js/".$javascript;
		return $jsPath;
	}
	
	public function getStylesheets(){
		if(is_array(Core::config()->getConfig('stylesheets')))
			return Core::config()->getConfig('stylesheets');
		return array();
	}
	
	public function getStylesheetPath($stylesheet){
		$cssPath = self::$_url."/styles/".Core::config()->getConfig('style')."/css/".$stylesheet;
		return $cssPath;
	}
}	