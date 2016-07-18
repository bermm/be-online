<?php
	class Registering{
		
		public function __construct(){
			if(isset($_POST['reg_submit_btn'])){ // преревірка чи натиснута кнопка відправлення даних (submit)
			
			$name = trim($_POST["reg_name_edit"]);
			$sample_name = "/^(([A-Z][a-z]{1,15})|([А-ЯІЇЁ\W][а-яіїё\W]{1,15}))$/";
			(preg_match($sample_name, $name)) or die ("<strong class=\"failed-reg\">Введене ім'я не відповідає вимогам!</strong>");
			
			$login = trim($_POST["reg_log_edit"]); // отримання логіна з форми
			$sample_login = "/^[A-Za-z0-9\._-]{5,20}\$/"; // регулярний вираз 
			if (!preg_match($sample_login, $login)) die("<strong class=\"failed-reg\">Логін задано некоректно!</strong>");
			
			$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); //з'єднання з сервером баз даних (серевер - користувач - пароль)
			$mysqli->select_db(DB_NAME) or die ("Can not select database"); //вибір бази даних
		
			/*перевірка на наявність логіна ідентичного тому, що вводиться*/
			$db_query = "SELECT login FROM users WHERE login = '{$login}'";
			$result = $mysqli->query($db_query); 
			if($row = $result->fetch_row()) die("<strong class=\"failed-reg\">Такий логін вже існує! Спробуйте ввести інший</strong>");
	
			/* перевірка e-mail на коректність*/
			$sample_email = "/^[A-Za-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$/"; // регулярний вираз 
			$email = $_POST["reg_email_edit"];
			if (!preg_match($sample_email, $email)) die("<strong class=\"failed-reg\">E-mail задано некоректно!</strong>");
			$db_query = "SELECT email FROM users WHERE email = '{$email}'";
			$result = $mysqli->query($db_query); 
			if($row = $result->fetch_row()) die("<strong class=\"failed-reg\">Такий e-mail вже існує! Спробуйте ввести інший</strong>");
		
			$pass1 = $_POST["reg_pass1_edit"];
			$sample_pass = "/^([\w\!\@\#\$\%\^\&\?\*\(\)\-\=\+\[\]\;\:\'\.\,]{7,20})$/";
			(preg_match($sample_pass, $pass1)) or die ("<strong class=\"failed-reg\">Введений пароль не відповідає вимогам!</strong>");
			$pass1 = md5($_POST["reg_pass1_edit"]);
			$pass2 = md5($_POST["reg_pass2_edit"]);
			($pass1 == $pass2) or die ("<strong class=\"failed-reg\">Паролі не співпадають! Спробуйте ще раз</strong>");
					
			$age = $_POST["reg_age"];
			$date = date("d.m.Y")." ".date("H:i:s")." UTC+2:00";
			$time = time();
		
			$db_query = "INSERT INTO users (name, login, email, password, age, date, time, access) VALUES ('$name', '$login', '$email', '$pass1', '$age', '$date', '$time', '0')";
				
			$result = $mysqli->query($db_query) or die ("<br>Can not insert new data"); //додання запису в таблицю користувачів - users
			
			$db_query = "CREATE TABLE messages_".$login."(id INT NOT NULL AUTO_INCREMENT,
															PRIMARY KEY(id),
															from_id VARCHAR(10),
															from_id_name VARCHAR(50),
															input_message TEXT,
															to_id VARCHAR(10),
															output_message TEXT,
															date VARCHAR(30)) DEFAULT CHARSET=UTF8";
			$result = $mysqli->query($db_query) or die ("<br>Can not create user"); //додання таблиці в базу даних
			
		
			$mysqli->close() or die ("<br>Can not disconnect with DB server"); //роз'єднання з сервером бази даних
		
			echo "<strong class=\"success-reg\">Вітаємо, Вас успішно зареєстровано!</strong>";}
		}
	}
?>