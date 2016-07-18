<?php
	session_start();
	set_include_path(get_include_path().";/home/be-online/www/".";/home/be-online/www/classes/");
	error_reporting(E_ALL & ~E_NOTICE);
	//error_reporting(E_ALL );


	header("Content-Type: text/html; charset=utf-8");
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
	
	function __autoload($className){
		require_once(PATH."/classes/{$className}.php");}
		
?>