<?php
	class ShowProfile{
		
		public function __construct($id){
			$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
			$mysqli->select_db(DB_NAME) or die ("Can not select database");
			
			$db_query = "SELECT name, email, age, date FROM users WHERE id = '{$id}'";
			$result = $mysqli->query($db_query);
			$user = $result->fetch_array();
			
			$rez = file_get_contents(URL."/pages_elements/profile_results.tpl");
			$rez =	str_replace('{name}',$user['name'],$rez);
			$rez =	str_replace('{email}',$user['email'],$rez);
			$rez =	str_replace('{date}',substr($user['date'], 0, 10),$rez);
			
			echo $rez;
			}
	}
?>