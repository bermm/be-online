<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Діалог || ".$_SESSION['name'];
	echo $templater->load_template($title, "/pages_elements/dialogue_header.tpl");
	include_once("pages_elements/dialogue_content.php");
	echo(file_get_contents(PATH."/pages_elements/dialogue_footer.tpl"));
?>