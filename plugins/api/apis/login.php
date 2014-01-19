<?php
	$username = htmlentities(Core::db()->escape($_POST["username"]));
	$password = htmlentities(Core::db()->escape($_POST["password"]));
	
	if(Core::db()->login($username, $password) != false){
		header('Location: /');
	} else {
		header('Location: /false_login');
	}