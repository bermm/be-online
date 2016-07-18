<?php
	//error_reporting(E_ALL & ~E_NOTICE);
	//error_reporting(E_ALL );
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
	
	function __autoload($className){
		require_once(PATH."/classes/{$className}.php");}
		
?>