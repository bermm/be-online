 <div id="content">
 		<a href="{path}">- На головну -</a><br />
 <br /><strong>реєстрація користувача</strong><br /><br />

<!-- Форма реєстрації, складається із іншої таблиці -->            
            	<form name="registering_form" action="" method="post">
                    <div class="inline field_name">Ім'я:</div><div class="inline"><input id="reg-name" class="input" type="text" name="reg_name_edit" maxlength="50" placeholder = "Введіть ім'я" required></div><div class="inline image"><img class="picture" id="name-no-img" src="../media/no.ico" /><img class="picture" id="name-ok-img" src="../media/ok.ico" /></div><br />                    
                    <div class="inline field_name">Логін:</div><div class="inline"><input id="reg-login" class="input" type="text" name="reg_log_edit" maxlength="20" placeholder = "Введіть логін" required></div><div class="inline image"><img class="picture" id="login-no-img" src="../media/no.ico" /><img class="picture" id="login-ok-img" src="../media/ok.ico" /></div><br />
                    <div class="inline field_name">E-mail:</div><div class="inline"><input id="reg-email" class="input" type="text" name="reg_email_edit" maxlength="50" placeholder = "Введіть адрес e-mail" required></div><div class="inline image"><img class="picture" id="email-no-img" src="../media/no.ico" /><img class="picture" id="email-ok-img" src="../media/ok.ico" /></div><br />
                    <div class="inline field_name">Пароль:</div><div class="inline"><input id="reg-pass" class="input" type="password" name="reg_pass1_edit" maxlength="20" placeholder = "Введіть пароль" required></div><div class="inline image"><img class="picture" id="pass-no-img" src="../media/no.ico" /><img class="picture" id="pass-ok-img" src="../media/ok.ico" /></div><br />
                    <div class="inline field_name">Повторення:</div><div class="inline"><input id="reg-repeatpass" class="input" type="password" name="reg_pass2_edit" maxlength="20" placeholder = "Повторіть пароль" required></div><div class="inline image"><img class="picture" id="repeatpass-no-img" src="../media/no.ico" /><img class="picture" id="repeatpass-ok-img" src="../media/ok.ico" /></div><br />
					<div class="inline image"></div><br />
                    <input class="sub-btn" type="reset" id="reset_btn" value="Очистити" />
                    <input class="sub-btn" type="button" id="reg_submit_btn" value="Готово" />
      			</form>
<div id="answer"></div>