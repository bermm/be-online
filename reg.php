<?php
	require_once("config.php");
	
	if (isset($_SESSION['name'])) header("Location:".URL);
	
	$templater = new Templater();
	$title = "Реєстрація користувача";
	echo $templater->load_template($title, "/pages_elements/reg_header.tpl");
	
	$reg_form = file_get_contents("pages_elements/reg_form.tpl");
	$reg_form = str_replace("{path}", URL, $reg_form);
	echo $reg_form;
	
	echo(file_get_contents(PATH."/pages_elements/reg_footer.tpl"));
?>

