<?php
	require_once("config.php");
		
	$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); //підключення до сервера з базою даних (серевер - користувач - пароль)

	$mysqli->select_db(DB_NAME) or die ("Can not select database");
	
	$templater = new Templater();
	$title = "Головна";
	echo $templater->load_template($title, "/pages_elements/index_header.tpl");
	include_once("pages_elements/index_content.php");
	echo(file_get_contents(PATH."/pages_elements/index_footer.tpl"));
?>
