<?php
	if(Core::getInstance()->getLib('User')->isLoggedIn()){
		$return = "";
		$queryUser = Core::db()->query("SELECT * FROM icms_user LIMIT 15");
		ob_start();
		require("templates/member.phtml");
		$return .= ob_get_clean();
		echo $return; 
	} else {
		echo '<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nicht eingeloggt</h3>
			</div>
			<div class="panel-body">
				Es tut uns leid, aber dieses Feature ist nur f&uuml;r eingeloggte Mitglieder verfügbar
			</div>
		</div>'; 
	}