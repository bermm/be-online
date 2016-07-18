<?php
	require_once("../config.php");
	
	if (isset($_SESSION['admin'])){
		header("Location:".URL."/admin/admin_environment.php");}
					
	$templater = new Templater();
	$title = "Адміністратор || Вхід";
	echo $templater->load_template($title, "/admin/admin_pages_elements/admin_header.tpl");
	include_once("admin_pages_elements/admin_content.php");
	echo(file_get_contents(PATH."/admin/admin_pages_elements/admin_footer.tpl"));
?>
