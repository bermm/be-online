<?php		
	set_include_path(get_include_path().";E:/OpenServer/domains/be-online/".";E:/OpenServer/domains/be-online/classes/");
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
	
	require_once("ShowMessage.php");
	require_once("Month.php");
				
	if(isset($_POST['jq_post'])){	
		$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
		$mysqli->select_db(DB_NAME) or die ("Can not select database");
				     
		$show_message = new ShowMessage($_POST['jq_ses']);
		$show_message->dialogue($_POST['jq_ses'], $_POST['jq_get'], $_POST['jq_name'], $_POST['jq_start_id']);
				
		unset($_POST['jq_post']);
		unset($_POST['jq_start_id']);}	
?>