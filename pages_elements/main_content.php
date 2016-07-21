        <body>
        <?php
		echo "<div id=\"login\">";
        $authorization = new Authorization();
		echo "</div> <div id=\"menu_container\">";
		
		$menu = file_get_contents("pages_elements/menu.tpl");
		$menu =	str_replace('{path}',URL,$menu);
		$menu =	str_replace('{id}',$_SESSION['id'],$menu);
		echo $menu;
		 ?>
	</div>
	<div class="container">
		<div id="inconteiner">
        </div>
    </div>