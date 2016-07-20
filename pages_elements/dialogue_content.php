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
        	<div id="ajax_loader">
				<img id="ajax_gif" src="../media/ajax-loader.gif" />
			</div>
	<div id="incontainer">
         		<?php
					$show_message = new ShowMessage($_SESSION['id']);
					$show_message->dialogue($_SESSION['id'], $_GET['id'], $_SESSION['name']);
				?>
    </div>
           <textarea class="message_field" cols="50" rows="4" wrap="hard" required></textarea>
           <button class="send-btn">Відправити</button>

            <script type="text/javascript">
				function autoUpdate(){
					var session_id = <?php echo $_SESSION['id']?>;
					var get_id = <?php echo $_GET['id']?>;
					var session_name = "<?php echo $_SESSION['name']?>";
					var start_id;
					
					if($("button").is(".del")){start_id = $(".del:last").attr("id");}
					else {start_id = 0;};			
						
					$.post("http://be-online/scripts/php/dialogueAutoUpdate.php",
								{jq_get:get_id,
								jq_ses:session_id,
								jq_name:session_name,
								jq_start_id:start_id,
								jq_post:true}, 
								function(data){
									if (!data == ""){document.getElementById('player').play();}
									$("#incontainer").html($("#incontainer").html() + data);
									})
					}
				
				function dialogueScroll(){
					if ($(".message:last").position().top < 500){
						$("#incontainer").scrollTop(999999);
						}
					}
				
				function sendMessage(){
					var session_id = <?php echo $_SESSION['id']?>;
					var get_id = <?php echo $_GET['id']?>;
					var session_name = "<?php echo $_SESSION['name']?>";
					var start_id;
					
					var bckgrnd = $(".message_field").css("background-color");
					var border = $(".message_field").css("border-color");
										
					var dmessage = $(".message_field").val();
					dmessage = $.trim(dmessage);
					
					if($("button").is(".del")){start_id = $(".del:last").attr("id");}
					else {start_id = 0;};	
			
					if (dmessage!==''){		
						$.post("http://be-online/scripts/php/dialogue.php",
								{jq_mes: dmessage,
								jq_get:get_id,
								jq_ses:session_id,
								jq_name:session_name,
								jq_start_id:start_id,
								jq_post:true}, 
							function(data){
								$("#incontainer").html($("#incontainer").html() + data);
								$("#incontainer").scrollTop(999999);
								//console.log("server data: " + data)
								})
						$(".message_field").val('').focus();
						}else {						
							$(".message_field").val('').focus();
							$(".message_field").css({"background":"#FFE4E1", "border-color":"#FF0000"});
			
							setTimeout(function(){
								$(".message_field").css({"background":bckgrnd, "border-color":border});}, 1000); // ч. колір текст. поля при спробі відпр. пуст. пов.
							}
					}
				
				$(document).ready(function(){
					$("#ajax_loader").css("display", "block");
					$("#ajax_loader").animate({opacity: 1}, 500);
					setTimeout(function(){
						$("#ajax_loader").animate({opacity: 0}, 500, function(){$("#ajax_loader").css("display", "none");});
						$("#incontainer").slideDown(1000);
						$(".message_field").css("display", "block");
						$(".send-btn").css("display", "block");}, 1000);						
					
					setTimeout(function(){$("#incontainer").scrollTop(999999);}, 2000);
					
					if($("button").is(".del")) {
						setInterval('autoUpdate()',1000);
						setInterval('dialogueScroll()',1000);
						};
																					
					$(".send-btn").on("click", sendMessage);
			
					$(".message_field").on("keydown", function(){
						if ((event.which === 13) && (event.ctrlKey == false)){
							sendMessage();
							event.preventDefault();
							};
						if ((event.which === 13) && (event.ctrlKey == true)){
							$(".message_field").val($(".message_field").val()+"\r\n");
							event.preventDefault();  
							};							
						})
					})
            </script>
            
			<script type="text/javascript"> // видалення повідомлення
				$(document).ready(function(){
					$(document).on("click", ".del", function(){
						var bool = confirm("Ви дійсно бажаєте видалити це повідомлення?");							
						if (bool == true){
							var button_id = $(this).attr("id");
							var session_id = <?php echo $_SESSION['id']?>;
							var scroll_top = $(this).position().top;
							$(this).parents(".message").remove();
							$.ajax({
								type: "POST",
								url: "http://be-online.sytes.net/scripts/php/msgDelete.php",
								data: {jq_button_id:button_id,
										jq_ses:session_id,
										jq_post_mdel:true},
								success: function(){}
								});
							};
						});
					});									
			</script>
   </div>
   
   