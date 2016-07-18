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
			
				$db_query = "SELECT login FROM users WHERE id = '".$_POST['jq_get']."'";
				$result = $mysqli->query($db_query) or die ("Can not read data");
				$array = $result->fetch_array();
				$receiver_table_name = "messages_".$array['login'];
				
				$db_query = "SELECT login FROM users WHERE id = '".$_POST['jq_ses']."'";
				$result = $mysqli->query($db_query) or die ("Can not read data");
				$array = $result->fetch_array();
				$sender_table_name = "messages_".$array['login'];
				
				$message = trim($_POST['jq_mes']);
				$message = $mysqli->real_escape_string($message);
				$date = date("d.m.Y")." ".date("H:i:s")." UTC+2:00";
				
				$db_query = "INSERT INTO ".$receiver_table_name." (from_id, from_id_name, input_message, to_id, output_message, date) VALUES ('".$_POST['jq_ses']."', '".$_POST['jq_name']."', '$message', '#', '#', '$date')";
				$result = $mysqli->query($db_query) or die ($db_query."<br>Can not insert data");
				
				$db_query = "INSERT INTO ".$sender_table_name." (from_id, from_id_name, to_id, output_message, date) VALUES ('#', '#', '".$_POST['jq_get']."', '$message', '$date')";
				$result = $mysqli->query($db_query) or die ($db_query."<br>Can not insert data");
				
				unset($_POST['jq_post']);
				unset($_POST['jq_mes']);}
	      
	$show_message = new ShowMessage($_POST['jq_ses']);
	$show_message->dialogue($_POST['jq_ses'], $_POST['jq_get'], $_POST['jq_name'], $_POST['jq_start_id']);	
?>