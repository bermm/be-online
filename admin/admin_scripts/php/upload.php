<?php
require_once("../admin_config.php");

$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
$mysqli->select_db(DB_NAME) or die ("Can not select database");

set_error_handler("errorHandler", E_ALL);
function errorHandler($err_num, $err_str, $err_file, $err_line){
	if(ob_get_length()){ob_clean();}
	$error_message = "Виникла помилка ".$err_str."<br>"."файл: ".$err_file." рядок: ".$err_line;
	echo $error_message;
	exit;	
	}

$default_dir = PATH."/tmp_files/";

if (isset($_FILES['file'])){
	$file_number = 0;
	$success_upload = true;
	$mp3 = array();
	$ogg = array();
	while(isset($_FILES['file']['tmp_name'][$file_number])){
			$code =  md5_file($_FILES['file']['tmp_name'][$file_number]);
			$type = $_FILES['file']['type'][$file_number];
			switch($type){
				case 'audio/mp3': 
					$dir = PATH."/media/audio/mp3/";
					$end = ".mp3";
					$mp3[0] = URL."/media/audio/mp3/".$code.$end;
					$ogg[0] = "";
					break;
				case 'audio/ogg': 
					$dir = PATH."/media/audio/ogg/";
					$end = ".ogg";
					$ogg[0] = URL."/media/audio/ogg/".$code.$end;
					$mp3[0] = "";
					break;
				default: $dir = $default_dir;}
			copy($_FILES['file']['tmp_name'][$file_number], $dir.$code.$end);
			$name = substr($_FILES['file']['name'][$file_number], 0, strlen($_FILES['file']['name'][$file_number])-4);
			$db_query = "INSERT INTO audio (name, mp3_path, ogg_path, date) VALUES ('".$name."', '".$mp3[0]."', '".$ogg[0]."', '".date("d.m.Y")."')";
			$mysqli->query($db_query) or die("Файли завантажені, але виникла помилка бази даних");
			$file_number ++;
		};
	}

if ($success_upload){echo "Завантаження пройшло успішно <br >";}

?>