<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Інші користувачі";
	echo $templater->load_template($title, "/pages_elements/others_header.tpl");
	include_once("pages_elements/others_content.php");
	echo(file_get_contents(PATH."/pages_elements/others_footer.tpl")); 
?>