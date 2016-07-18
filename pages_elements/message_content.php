	<div id="menu_container">
        <?php
			echo "<div id=\"login\">";
        	$authorization = new Authorization();
			echo "</div>";
		
			$menu = file_get_contents("pages_elements/menu.tpl");
			$menu =	str_replace('{path}',URL,$menu);
			$menu =	str_replace('{id}',$_SESSION['id'],$menu);
			echo $menu;
		 ?> 
    </div> 
	<div class="container">
         		<?php
					$show_message = new ShowMessage($_SESSION['id']);
					$show_message->showUserMessage($_GET['id']);
				?>
	</div>