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
    	<div id="profile-results">
         	<?php $show_profile = new ShowProfile($_GET['id']);?>
		</div>
		<div id="others"><a href="../others.php">[Інші користувачі]</a></div>      
		<hr color="#003366" size="2" width="100%">
		<div id="message">
			<form name="send_message" action="
            <?php echo URL."/profile.php/?id=".$_GET['id']?>" method="post">
            	<textarea id="message_area" name="message" cols="40" rows="5" wrap="virtual" placeholder = "Тут можна написати Ваше повідомлення"></textarea><br />
                <input class="message-btn" type="button" name="message_btn" value="Відправити" />
                <input id="dialogue" type="button" value="Діалог" />
            </form>
         </div>
	</div>      
         <script type="text/javascript">				
				function sendMessage(get_id, session_id, session_name){
					var bckgrnd = $("#message_area").css("background-color");
					var border = $("#message_area").css("border-color");					
					var message = $("#message_area").val();
					message = $.trim(message);	
			
					if (message!==''){		
						$.post("http://be-online/scripts/php/msgSend.php",
								{jq_mes: message,
								jq_get:get_id,
								jq_ses:session_id,
								jq_name:session_name,
								jq_post:true}, 
							function(data){
								console.log(data)
								})
						$("#message_area").val('').focus();
						}else {						
							$("#message_area").val('').focus();
							$("#message_area").css({"background":"#FFE4E1", "border-color":"#FF0000"});
			
							setTimeout(function(){
								$("#message_area").css({"background":bckgrnd, "border-color":border});}, 1000); // ч. колір текст. поля при спробі відпр. пуст. пов.
							}
					}
									
				$(document).ready(function(){	
					var placeholder = $("#message_area").attr("placeholder");								
					var bckgrnd = $("#message_area").css("background-color");
					var border = $("#message_area").css("border-color");
					var url = "<?php echo URL."/dialogue.php/?id=".$_GET['id']?>";
					var session_id = <?php echo $_SESSION['id']?>;
					var get_id = <?php echo $_GET['id']?>;
					var session_name = "<?php echo $_SESSION['name']?>";

					if (session_id == get_id){
						$("#message").css("display","none");
						}
						
					$("#message_area").on("focusin", function(){
						$(this).css("text-align","left");
						$(this).attr("placeholder", "");
						})
					$("#message_area").on("focusout", function(){
						$(this).css("text-align","center");
						$(this).attr("placeholder", placeholder);
						})
						
					$("#dialogue").click(function(){
						window.location.href = url;
						})
					
					$(".message-btn").click(function(){
						sendMessage(get_id, session_id, session_name);})
					})
            </script>