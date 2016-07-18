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
				
	if(isset($_POST['jq_post_mdel'])){	
		$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
		$mysqli->select_db(DB_NAME) or die ("Can not select database");
		
		$db_query = "SELECT login FROM users WHERE id = '".$_POST['jq_ses']."'";
		$result = $mysqli->query($db_query) or die ("Can not read data");
		$array = $result->fetch_array();
		$table_name = "messages_".$array['login'];
				     
		$button_id = $_POST['jq_button_id'];
		$db_query = "DELETE FROM ".$table_name." WHERE id = '".$button_id."'";
				
		$result = $mysqli->query($db_query) or die ("Can not delete data");
				
		unset($_POST['jq_post_mdel']);}
?>