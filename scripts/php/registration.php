<?php		
	set_include_path(get_include_path().";E:/OpenServer/domains/be-online/".";E:/OpenServer/domains/be-online/classes/");
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
	
	require_once("Registering.php");				
	$registration = new Registering();

?>