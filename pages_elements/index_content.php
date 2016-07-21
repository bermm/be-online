<body>
<div id="content">
	<?php
	if (isset($_POST['log_out_btn'])){
		unset($_SESSION['name']);
		unset($_SESSION['id']);
		session_destroy();}
	
	if (isset($_SESSION['name'])){
	echo "<a href=\"main.php\">{$_SESSION['name']}</a>
			<form name=\"log_out\" action=\"".URL."\" method=\"post\">
				<input class=\"sub-btn\" type=\"submit\" name=\"log_out_btn\" value=\"Вихід\">
			</form>";}
	else{ 
		echo "Ввійдіть<br />
			<table>
				<tr>
					<td class=\"log-pass\">Логін:</td>
					<td class=\"log-pass\">Пароль:</td>
				</tr>
			</table>
			<table>
				<tr id=\"form\">
					<td>
						<form name=\"log_in_form\" action=\"main.php\" method=\"post\">
							<input class=\"input\" type=\"text\" name=\"login_edit\" required>
							<input class=\"input\" type=\"password\" name=\"pass_edit\" required><br>
							<input class=\"sub-btn\" type=\"submit\" name=\"submit_btn\" value=\"Ввійти\">
						</form>
					</td>
				</tr>
			</table>
		<a href=\"reg.php\">або зареєструйтеся</a>";}
	?>
</div>