	<?php $menu = file_get_contents(PATH."/admin/admin_pages_elements/admin_menu.tpl");
	//$menu =	str_replace('{path}',URL,$menu);
	//$menu =	str_replace('{id}',$_SESSION['id'],$menu);
	echo $menu;
	?>
	<div id="container">
	<?php
		if (isset($_POST['admin_in_btn'])){	
				$log = $_POST['login_admin'];
				$pass = $_POST['pass_admin'];
				
			if (($log =='admin')&&($pass == 'pass')){
						$_SESSION['admin'] = $log;
						$_SESSION['logged'] = true;
						echo "Адміністратор 
						<form name=\"log_out\" action=\"admin_environment.php\" method=\"post\">
							<input class=\"sub-btn\" type=\"submit\" name=\"admin_out_btn\" value=\"вихід\">
						</form><hr></hr>";
					}
			else die("<a href=\"index.php\">неправильний логін або пароль</a>");
			}
		elseif(isset($_SESSION['admin'])){
				echo "Адміністратор
					<form name=\"log_out\" action=\"admin_environment.php\" method=\"post\">
						<input class=\"sub-btn\" type=\"submit\" name=\"admin_out_btn\" value=\"вихід\">
					</form><hr></hr>";}
		
		$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die("Can't connect to the DB");
		
		$mysqli->select_db(DB_NAME);
		
		$db_query = "SHOW TABLES FROM ".DB_NAME." LIKE 'users'";
		$result = $mysqli->query($db_query);
		
		$result = $mysqli->query($db_query);
			while ($table = $result->fetch_array()){
				if ($table['0'] == 'users') {$boolean = true;}
				else{$boolean = false;};
				};
		
		if(!$boolean){echo "Необхідно створити таблиці в базі даних<br>
							<form name=\"log_in_form\" action=\"admin_environment.php\" method=\"post\">
								<input type=\"submit\" name=\"create_table_btn\" value=\"Створити\" />
							</form><hr></hr>";}
		
		if (isset($_POST['create_table_btn'])){
		$db_query = "CREATE TABLE users (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
										name VARCHAR(50),
										login VARCHAR(50),
										email VARCHAR(50),
										password VARCHAR(50),
										age VARCHAR(30),
										date VARCHAR(50),
										time VARCHAR(50),
										access VARCHAR(1)) DEFAULT CHARSET=UTF8";
		$result = $mysqli->query($db_query) or die ("<br>Can not create table"); //додання таблиці користувачів в базу даних
		
		$db_query = "CREATE TABLE audio (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id),
										name VARCHAR(50),
										mp3_path VARCHAR(100),
										ogg_path VARCHAR(100),
										date VARCHAR(50)) DEFAULT CHARSET=UTF8";
		$result = $mysqli->query($db_query) or die ("<br>Can not create table"); //додання таблиці в базу даних
		
		echo "<strong>Необхідні таблиці успішно створені!</strong>";
		unset($_POST['create_table_btn']);
		}
	?>     
	<div id="add_media">
    	<form action=<?php echo "\"".URL."/admin/admin_scripts/php/upload.php\""?> method="post" enctype="multipart/form-data"
	onsubmit="return sendForm(this, get('status'))">
			<div id="upload_progress_out"><div id="upload_progress_in"></div></div>
  			<input type="file" name="file[]" id="file" multiple="multiple" />
  			<input type="submit" name="go" id="go" value="Завантажити" />
		</form>
        <div id="status"></div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var item1 = true;
		var item3 = true;
						
		$("#item1").click(function(){
			if (item1) {
				item1 = false;
				item3 = true;
				$(".subitem3").hide();
				$(".subitem1").slideDown(200);
				}
			else {
				$(".subitem1").slideUp(200);
				item1 = true;}
			});
			
		$("#item3").click(function(){
			if (item3) {
				item3 = false;
				item1 = true;
				$(".subitem1").hide();
				$(".subitem3").slideDown(200);
				}
			else {
				$(".subitem3").slideUp(200);
				item3 = true;}
			});
		
		$(".subitem1:first").click(function(){
			$("#add_media").show();
			});	
		})
		
		
	//JavaScript: upload form with file BEGIN
	function get(id){
		return document.getElementById(id);
		}
 
	window.onload = function(){
		if(!window.FormData){
			var div = get('status');
			div.innerHTML = "Ваш браузер не підтримує об'єкт FormData";
			div.className = 'notSupport';
			}
		}
 
	function sendForm(form, output){
		get('upload_progress_out').style.display = "block";
		output.innerHTML = '';

		var data = new FormData(form),
			xhr = new XMLHttpRequest(),
   			progressBar = get('upload_progress_in'),
    		goBtn = get('go'),
    		fileInp = get('file');  
 		if(fileInp.value == ''){
    		get('status').innerHTML = 'Виберіть файл!';
    		return false;
			}
  		if(fileInp.files[0].size > 200*1024 * 1024){
			output.innerHTML = 'Максимум 150 мб!';
   			return false;
			}
  		output.innerHTML = '';
		xhr.open('POST', form.action);
  		xhr.onload = function(e){
    		output.innerHTML = e.currentTarget.responseText;
			}
  		xhr.upload.onprogress = function(e){
    		progressBar.style.cssText = "width:"+ Math.round (e.loaded / e.total * 500)+"px";
			}
		xhr.send(data);
  		return false;
	}
	//JavaScript: upload form with file END

</script>