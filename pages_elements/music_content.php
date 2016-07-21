        <body>
        <?php
		echo "<div id=\"login\">";
        $authorization = new Authorization();
		echo "</div>";
		
		$menu = file_get_contents("pages_elements/menu.tpl");
		$menu =	str_replace('{path}',URL,$menu);
		$menu =	str_replace('{id}',$_SESSION['id'],$menu);
		echo $menu;
		?>
    <div class="container">
		<div id="inconteiner"> 
         <?php
			$mysqli = new MySQLi(MySQL_SERVER, MySQL_USER, MySQL_PASSWORD) or die ("Can not connect to the database server"); 
			$mysqli->select_db(DB_NAME) or die ("Can not select database");
			
			$db_query = "SELECT name, mp3_path, ogg_path FROM audio";
			$result = $mysqli->query($db_query);
			while ($audio = $result->fetch_array()){
				echo "<div class=\"song\"><div class=\"play_btn\"></div><div class=\"pause_btn\"></div><div class=\"song_name\">".$audio['name']."</div><div class=\"mp3\">".$audio['mp3_path']."</div><div class=\"ogg\">".$audio['ogg_path']."</div></div>";}
			?>