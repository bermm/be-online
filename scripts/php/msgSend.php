<?php		
	set_include_path(get_include_path().";W:/OpenServer/domains/be-online/".";W:/OpenServer/domains/be-online/classes/");
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
	
	require_once("SendMessage.php");				
	$send_message = new SendMessage($_POST['jq_post'], $_POST['jq_mes'], $_POST['jq_get'], $_POST['jq_ses'], $_POST['jq_name']);

?>