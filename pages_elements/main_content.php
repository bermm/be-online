        <?php
		echo "<div id=\"login\">";
        $authorization = new Authorization();
		echo "</div> <div id=\"menu_container\">";
		
		$menu = file_get_contents("pages_elements/menu.tpl");
		$menu =	str_replace('{path}',URL,$menu);
		$menu =	str_replace('{id}',$_SESSION['id'],$menu);
		echo $menu;
		 ?>
         
        <!--<center>
    		<object id="clock" width="" height="">
				<param name="movie" value="../media/clock.swf">
				<param name="quality" value="high">
            	<param name="wmode" value="transparent">
			</object>
		</center>-->

	</div>
	<div class="container">
		<div id="inconteiner">
        </div>
    </div>