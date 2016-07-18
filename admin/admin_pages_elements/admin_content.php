<div id="body">
<div id="container">
	<?php	
		if (!isset($_SESSION['admin'])){
			echo "<a href=\"".URL."\">[На головну]</a><br /><br />";
			echo'<table align="center" border="0" cellspacing="0" cellpadding="0" width="400">
				<tr id="log-pas" align="center" valign="bottom">
        				<td width="50%">Логін:</td>
            			<td>Пароль:</td>
        			</tr>
              
       				<tr>
        				<td align="center" valign="top" colspan="2">
            				<form name="log_in_form" action="admin_environment.php" method="post">
   								<input class="input" type="text" name="login_admin" size="" required>
								<input class="input" type="password" name="pass_admin" size="" required><br>
 								<input class="sub-btn" type="submit" name="admin_in_btn" value="Ввійти">
							</form> 
        				</td>
					</tr>  
    			</table>';}

	?>     
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	})
</script>