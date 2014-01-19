<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: naviController
	*/

class naviController extends abstractController{
	
	protected static $_naviContent = "";
	function __construct(){
		
	}

	public function getNaviLinks(){
		self::$_naviContent = "";
		$navi = Core::db()->query("SELECT * FROM icms_navi WHERE visible = 1 and parent = 0 ORDER BY pos ASC");
		while($link = $navi->fetch_object()){
			$id 	= $link->id;
			$url_key= $link->url_key;
			$title	= $link->title;
			$href	= $link->href;
			$type	= $link->type;
			$subtype= $link->subtype;
			$icon 	= $link->icon;
			
			if ($type == 2){
				self::$_naviContent .= '<li><a href="'.$href.'">'.$this->_getIcon($icon).''.$title.'</a></li>'."\n";
				continue;
			}
			
			if($subtype == 1){
				$active = $this->_isActive($url_key);
				self::$_naviContent .= '<li class="'.$active.'"><a href="'.$this->_getLink($url_key).'">'.$this->_getIcon($icon).''.$title.'</a></li>'."\n";
			} elseif ($subtype == 2) {
				self::$_naviContent .= '<li class="dropdown">'."\n";
				self::$_naviContent .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$this->_getIcon($icon).''.$title.' <b class="caret"></b></a>'."\n";
				self::$_naviContent .= '<ul class="dropdown-menu">'."\n";
				$this->_getDropdownLinks($id);
				self::$_naviContent .= '</ul>'."\n";
				self::$_naviContent .= '</li>'."\n";
			} elseif ($subtype == 3) {
				continue;
			}
		}
		return self::$_naviContent;
	}
	
	
	protected function _getDropdownLinks($id){
		$dropdown = Core::db()->query("SELECT * FROM icms_navi WHERE visible = 1 and parent = ".$id." ORDER BY pos ASC");
		while($link = $dropdown->fetch_object()){
			$id 	= $link->id;
			$url_key= $link->url_key;
			$title	= $link->title;
			$href	= $link->href;
			$type	= $link->type;
			$subtype= $link->subtype;
			$icon 	= $link->icon;
			
			if ($type == 2){
				self::$_naviContent .= '<li><a href="'.$href.'">'.$this->_getIcon($icon).''.$title.'</a></li>'."\n";
				continue;
			}
			if($subtype == 1){
				$active = $this->_isActive($url_key);
				self::$_naviContent .= '<li class="'.$active.'"><a href="'.$this->_getLink($url_key).'">'.$this->_getIcon($icon).''.$title.'</a></li>'."\n";
			} elseif ($subtype == 2) {
				self::$_naviContent .= '<li class="dropdown-submenu">'."\n";
				self::$_naviContent .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$this->_getIcon($icon).''.$title.'</a>'."\n";
				self::$_naviContent .= '<ul class="dropdown-menu">'."\n";
				$this->_getDropdownLinks($id);
				self::$_naviContent .= '</ul>'."\n";
				self::$_naviContent .= '</li>'."\n";
			} elseif ($subtype == 3) {
				continue;
			}
		}
	}
	
	protected function _isActive($url_key){
		if(Core::getInstance()->getLib('Url')->getPath() == $url_key){
			return "active";
		}
		return;
	}
	
	protected function _getLink($url_key){
		return "http://".$_SERVER['SERVER_NAME']."/".$url_key;
	}
	
	public function _getIcon($icon){
		return '<span class="glyphicon '.$icon.'"></span> ';
	}
}	 
