<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: templatehelper
	*/

class Template extends AbstractLib{

	protected static $_abstract = null;
	function __construct(){
		
	}

	public function load($template){
		if(is_null(self::$_abstract)){
			require_once("styles/".Core::config()->getConfig('style')."/templates/controller/abstractController.php");
			self::$_abstract = new abstractController();
		}
		$templatePath = "styles/".Core::config()->getConfig('style')."/templates/".$template.".phtml";
		if(file_exists("styles/".Core::config()->getConfig('style')."/templates/controller/".$template."Controller.php")){
			$controllerPath = "styles/".Core::config()->getConfig('style')."/templates/controller/".$template."Controller.php";
			$controllerClass = $template."Controller";
			require_once($controllerPath);
			$$template = new $controllerClass();
		}
		ob_start();
		require_once($templatePath);
		$return = ob_get_clean();
		echo $return;
	}
}	