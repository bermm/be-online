<?php
	class ShowUsers{
		
		public function __construct($id){	
				$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
				$mysqli->select_db(DB_NAME) or die ("Can not select database");
			
				$db_query = "SELECT id, name FROM users WHERE id != '{$id}' AND access != '1'";
				$result = $mysqli->query($db_query);
				while ($user = $result->fetch_array()){
					echo "<a href=\"".URL."/profile.php/?id=".$user['id']."\">".$user['name']."</a><br />";}
			}
		}
?>