<?php
/*
	* @author: InyaProduction
	* @version: 0.1b
	* @file: style
	*/

class StyleConfig{
	function __construct(){
		Core::config()->setConfig(	'javascripts',
						array(
							'jquery.min.js',
							'bootstrap.js',
							'inyaproduction.js'
						));
		Core::config()->setConfig(	'stylesheets',
						array(
							'bootstrap.min.css',
							'bootstrap-responsive.min.css',
							'inyaproduction.css',
						));
						
		Core::config()->setConfig(	'style_information',
						array(
							'author'	=> 'InyaProduction',
							'version'	=> '1.0.1',
							'copyright'	=> 'InyaProduction 2013',
						));
		Core::config()->setConfig('loadOrder', 'test');
	}
}

