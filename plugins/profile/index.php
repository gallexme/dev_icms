<?php
	if(Core::getInstance()->getLib('User')->isLoggedIn()){
		$return = "";
		$profile = preg_replace("/[^0-9]/", "",$_GET['u']);
		$queryUser = Core::db()->query("SELECT * FROM icms_user WHERE id = $profile");
		$queryPro = Core::db()->query("SELECT * FROM iplugin_profile WHERE profile_id = $profile");
		if(!Core::db()->isResult($queryUser)){
			ob_start();
			require("templates/nouser.phtml");
			$return .= ob_get_clean();
		} else {
			$userContent = $queryUser->fetch_object();
			if(!Core::db()->isResult($queryPro))
				$profileContent = "NONE";
			else
				$profileContent = $queryPro->fetch_object();
			ob_start();
			require("templates/profile.phtml");
			$return .= ob_get_clean();
		}
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