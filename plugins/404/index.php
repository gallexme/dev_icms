<?php
	ob_start();
	require("templates/content.phtml");
	echo ob_get_clean();