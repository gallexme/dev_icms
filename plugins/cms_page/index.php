<?php
	$return = "";
	$queryCon = Core::db()->query("SELECT content, topic FROM iplugin_cms_page WHERE page_id = $id");
	while($cmsContent = $queryCon->fetch_object()){
		$cont = $cmsContent->content;
		$topic = $cmsContent->topic;
		ob_start();
		require("templates/content.phtml");
		$return .= ob_get_clean();
	}
	echo $return;