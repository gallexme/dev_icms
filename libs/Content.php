<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: ContentLib
	*/

class Content extends AbstractLib{

	protected static $_plugins = array();
	
	function __construct(){
		$this->_loadPlugins();
	}
	
	protected function _loadPlugins(){
		$pluginDir = Core::config()->getConfig('pluginDir');
		$pluginsRaw = scandir($pluginDir);
		foreach($pluginsRaw as $plugin){
			$pluginPath = $pluginDir."/".$plugin;
			if(!is_dir($pluginPath))
				continue;
				
			if($plugin == "." or $plugin == "..")
				continue;			
			
			self::$_plugins[] = $plugin;
		}
	}
	
	public function showContent(){
		$id = Core::getInstance()->getLib('Category')->getId();
		$query = Core::db()->query("SELECT * FROM icms_content WHERE id = $id");
		if(!$query->num_rows > 0){
			$plugin = "404";
		} else {
			$plugin = $query->fetch_object()->plugin;
		}
		if(!strlen($plugin) > 0)
			$plugin = "404";
		$pluginFolder = BASE_URL."plugins/".$plugin;
		ob_start();
		require_once("$pluginFolder/index.php");
		$content = ob_get_clean();
		return $content;
	}
	
} 
