<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Медіа || Музика";
	echo $templater->load_template($title, "/pages_elements/music_header.tpl");
	include_once("pages_elements/music_content.php");
	echo(file_get_contents(PATH."/pages_elements/music_footer.tpl")); 
?>