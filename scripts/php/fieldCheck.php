<?php		
	set_include_path(get_include_path().";E:/OpenServer/domains/be-online/".";E:/OpenServer/domains/be-online/classes/");
	
	define("URL", "http://".$_SERVER['SERVER_NAME']);
	define("PATH",$_SERVER['DOCUMENT_ROOT']);
	define("DB_NAME", "beonline_db");
	define("MySQL_SERVER", "localhost");
	define("MySQL_USER", "be-online");
	define("MySQL_PASSWORD", "vfqtcr.tk");
					
	if(isset($_POST['jq_field_name'])){	
		$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
		$mysqli->select_db(DB_NAME) or die ("Can not select database");
		
		$db_query = "SELECT ".$_POST['jq_field_name']." FROM users WHERE ".$_POST['jq_field_name']." = '".$_POST['jq_text']."'";
				$result = $mysqli->query($db_query) or die ("Can not read data");
				$array = $result->fetch_array();
				$count = count($array);
				echo $count;    				
		unset($_POST['jq_field_name']);}	
?>