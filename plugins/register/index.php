<?php
	$return = "";
	if(Core::getInstance()->getLib('User')->isLoggedIn()){
		ob_start();
		require("templates/denied.phtml");
		$return .= ob_get_clean();
	} elseif (Core::config()->getConfig('registration') == 0) {
		ob_start();
		require("templates/closed.phtml");
		$return .= ob_get_clean();
	} else {
		ob_start();
		require("templates/register.phtml");
		$return .= ob_get_clean();
	}
	echo $return;