<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Профіль || ".$_SESSION['name'];
	echo $templater->load_template($title, "/pages_elements/profile_header.tpl");
	include_once("pages_elements/profile_content.php");
	echo(file_get_contents(PATH."/pages_elements/profile_footer.tpl")); 
?>