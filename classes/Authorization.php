<?php
	class Authorization{
		
		public function __construct(){
			if (isset($_POST['submit_btn']))
			{	
				$log = $_POST['login_edit'];
				$pass = md5($_POST['pass_edit']);
	
				$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
				$mysqli->select_db(DB_NAME) or die ("Can not select database");
				
				$db_query = "SELECT id, name, password FROM users WHERE login = '{$log}'";
				$result = $mysqli->query($db_query);
				$user = $result->fetch_array();
				
				if ($user['password'] == $pass) 
					{
						$_SESSION['id'] = $user['id'];
						$_SESSION['name'] = $user['name'];
						$_SESSION['login'] = $log;
						echo "<div id=\"name\">{$_SESSION['name']}</div><div id=\"btn_img\"><form name=\"log_out\" action=\"".URL."\" method=\"post\">
							<input class=\"sub-btn\" type=\"submit\" name=\"log_out_btn\" value=\"\">
						</form></div>";
					}
				else echo "<a href=\"".URL."\">неправильний логін або пароль</a>";
			}
		elseif(isset($_SESSION['name'])){
			echo "<div id=\"name\">{$_SESSION['name']}</div><div id=\"btn_img\"><form name=\"log_out\" action=\"".URL."\" method=\"post\">
							<input class=\"sub-btn\" type=\"submit\" name=\"log_out_btn\" value=\"\">
						</form></div>";
			}
		else echo "<a href=\"".URL."\">ввійдіть або зареєструйтеся</a>";

		}
	}
?>