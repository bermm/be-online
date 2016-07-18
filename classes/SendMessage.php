<?php
	class SendMessage{
		
		public function __construct($send_btn, $message, $get_id, $session_id, $session_name){
			if($send_btn){
				if(trim($message) !== ''){
					$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
					$mysqli->select_db(DB_NAME) or die ("Can not select database");
			
					$date = date("d.m.Y")." ".date("H:i:s")." UTC+2:00";
				
					$message = $mysqli->real_escape_string($message);				
				/* запис повідомлення в базу даних у таблицю повідомлень користувача-отримувача*/
					$db_query = "SELECT login FROM users WHERE id = '".$get_id."'";
					$result = $mysqli->query($db_query);
					$log = $result->fetch_array();
				
					$db_query = "INSERT INTO messages_".$log['login']."(from_id, from_id_name, input_message, to_id, output_message, date) VALUES ('".$session_id."', '".$session_name."', '".$message."', '#', '#', '$date')";
				
					$result = $mysqli->query($db_query) or die ("Can not insert data");
					
				/* запис повідомлення в базу даних у таблицю повідомлень користувача-відправника*/
					$db_query = "SELECT login FROM users WHERE id = '".$session_id."'";
					$result = $mysqli->query($db_query);
					$log = $result->fetch_array();
				
					$db_query = "INSERT INTO messages_".$log['login']."(from_id, from_id_name, to_id, output_message, date) VALUES ('#', '#', '".$get_id."', '".$message."', '$date')";
				
					$result = $mysqli->query($db_query) or die ("Can not insert data");
					}
				unset($send_btn);
				unset($message);
				}
			}
		}
?>