<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Повідомлення || ".$_SESSION['name'];
	echo $templater->load_template($title, "/pages_elements/message_header.tpl");
	include_once("pages_elements/message_content.php");
	echo(file_get_contents(PATH."/pages_elements/message_footer.tpl"));
?>