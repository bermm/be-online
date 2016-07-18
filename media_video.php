<?php
	require_once("config.php");
	
	if (!isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Медіа || Відео";
	echo $templater->load_template($title, "/pages_elements/video_header.tpl");
	include_once("pages_elements/video_content.php");
	echo(file_get_contents(PATH."/pages_elements/video_footer.tpl")); 
?>
    
		
