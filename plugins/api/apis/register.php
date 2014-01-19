<?php
	$error = 0;
	if(!isset($_POST['user']) || !isset($_POST['pw']) || !isset($_POST['name']) || !isset($_POST['email'])){
		die('<div class="alert alert-error" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Fehler!</strong> Es fehlen Eingaben</div>');
	}
	$user = Core::db()->escape(htmlentities($_POST['user']));
	$pw = Core::db()->escape(htmlentities($_POST['pw']));
	$name = Core::db()->escape(htmlentities($_POST['name']));
	$email = Core::db()->escape(htmlentities($_POST['email']));
	
	$isExist = Core::db()->query("SELECT * FROM icms_user WHERE username = '$user';");
	if($isExist->num_rows >= 1){
		die('<div class="alert alert-error" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Fehler!</strong> Nutzer existiert bereits</div>');
	}
	if (Core::config()->getConfig('registration') == 0) {
			die('<div class="alert alert-error" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Fehler!</strong> Registration geschlossen</div>');
	}
	if($error == 0){
		Core::db()->query("INSERT INTO icms_user (id, username, password, money, email, premium, register) VALUES ('', '$user', PASSWORD('$pw'), 0, '$email', 0, NOW())");
		die('<div class="alert alert-success" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Erfolg!</strong> Account erfolgreich registriert</div>');
	} else {
		die('<div class="alert alert-error" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Fehler!</strong> Fehler in den Eingaben</div>');
	}