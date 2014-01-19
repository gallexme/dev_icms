<?php
/*
	* @author: InyaProduction
	* @version: 0.2b
	* @file: naviController
	*/

class footerController extends abstractController{
	
	public function _getIcon($icon){
		return '<span class="glyphicon '.$icon.'"></span> ';
	}
	
	public function _isActive($url_key){
		if(Core::getInstance()->getLib('Url')->getPath() == $url_key){
			return "active";
		}
		return;
	}
}	 
 
