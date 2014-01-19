<?php
	$api_key = htmlentities($_GET['api_key']);
	if(strlen($api_key) > 0){
		$api_key = str_replace("..", "", $api_key);
		$api_key = str_replace("/", "", $api_key);
		ob_start();
		require_once("apis/$api_key.php");
		echo ob_get_clean();
	} else {
		die("Fehler bei Api Anfrage. Fehlercode: #001");
	}