<?php
	class ShowMessage{
		
		private $login;
		private $mysqli;
		
		public function __construct($id){	
				$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server");
				$this->mysqli = $mysqli; 
				$mysqli->select_db(DB_NAME) or die ("Can not select database");
			
				$db_query = "SELECT login FROM users WHERE id = '{$id}'";
				$result = $mysqli->query($db_query);
				$log = $result->fetch_array();
				$this->login = $log['login'];}
				
		public function showUserMessage($user_id){	
				$this->mysqli->select_db(DB_NAME) or die ("Can not select database");
		
				$db_query = "SELECT from_id, from_id_name, input_message, date FROM messages_".$this->login." WHERE from_id != '#'";
				$result = $this->mysqli->query($db_query);
				while ($message = $result->fetch_array()){
					$date = $message['date'];
					$day_number = substr($date, 0, 2);
					$month_number = substr($date, 3, 2);
					$year = substr($date, 6, 4);
					$time = substr($date, 11, 8);
					$user_link = "<a class=\"user_link\" href=\"".URL."/profile.php/?id=".$message['from_id']."\">".$message['from_id_name']."</a>";
					$month = new Month();
					echo "<div class=\"message\">
            				<div class=\"inf\">".$user_link."<br><small>".$day_number." ".$month->whichMonth($month_number)." ".$year."<br>".$time."</small></div>
                			<div class=\"mess_text\">".$message['input_message']."</div>
						</div>";}
			}
			
		public function dialogue($own_id, $id, $name, $query_id_start = 0){
				$this->mysqli->select_db(DB_NAME) or die ("Can not select database");
			
				$db = $db_query = $db_query = "SELECT * FROM messages_".$this->login." WHERE ( id > {$query_id_start}) AND ((from_id = '#' AND to_id = '{$id}') OR (from_id = '{$id}' AND to_id = '#'))";
				$result = $this->mysqli->query($db) or die("Невідома помилка діалогу! {$query_id_start}");
	
				while($message = $result->fetch_array()){
					if ($message['from_id'] == '#'){
						$dialogue_mes = $message['output_message'];
						$user_name = $name;
						$user_id = $own_id;} 
					else{
						$dialogue_mes = $message['input_message'];
						$user_name = $message['from_id_name'];
						$user_id = $id;} 
					$date = $message['date'];
					$day_number = substr($date, 0, 2);
					$month_number = substr($date, 3, 2);
					$year = substr($date, 6, 4);
					$time = substr($date, 11, 8);
					$user_link = "<a class=\"user_link\" href=\"".URL."/profile.php/?id=".$user_id."\">".$user_name."</a>";
					$month = new Month();
					echo "<div class=\"message\">
            				<div class=\"inf\" align=\"right\">".$user_link."<br><small>".$day_number." ".$month->whichMonth($month_number)." ".$year."<br>".$time."</small></div>
                			<div class=\"mess_text\">".$dialogue_mes."</div>
							<div class=\"mess_del\"><button class = \"del\" id=\"".$message['id']."\">Видалити</button></div>
						</div>";}
			}
		}    				                      
?>