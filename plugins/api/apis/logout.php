<?php
	Core::getInstance()->getLib('User')->logout();
	header('Location: /');