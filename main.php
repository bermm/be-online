<?php
	require_once("config.php");
	
	$templater = new Templater();
	$title = "Користувач";
	echo $templater->load_template($title, "/pages_elements/main_header.tpl");
	include_once("pages_elements/main_content.php");
	echo(file_get_contents(PATH."/pages_elements/main_footer.tpl"));
?>