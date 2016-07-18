<div id="loaderImage"></div>
<div id="note">*Примітка: всі поля, окрім "Вік", є обов'язковими для заповнення. Поле вважається валідним, якщо воно відповідає <a id="requirements">вимогам</a> і є унікальним (для "Логін" та "E-mail")</div>
</div>
<script type="text/javascript">
		var boolname = 0;
		var boollog = 0;
		var boolemail = 0;
		var boolpass = 0;
		var boolrepeatpass = 0;
		
		function fieldCheck(field, post_name, no_img, ok_img){
				if ($(field).val().length > 0){
					switch(field){
						case "#reg-name":
							var name_sample = /^(([A-Z][a-z]{1,15})|([А-ЯІЇЁ][а-яіїё]{1,15}))$/;
							if (!($(field).val()).match(name_sample)){$(no_img).show(); $(ok_img).hide(); boolname = 0;}
							else{$(no_img).hide(); $(ok_img).show(); boolname = 1;}
							break
						case "#reg-login":
							var login_sample = /^([A-Za-z0-9_\.-]{4,15})$/;
							if (!($(field).val()).match(login_sample)){$(no_img).show(); $(ok_img).hide(); boollog = 0;}
							else {
							$.post("http://be-online/scripts/php/fieldCheck.php",
								{jq_field_name: post_name,
								jq_text: $(field).val()}, 
							function(data){
								if(data > 0){$(no_img).show(); $(ok_img).hide(); boollog = 0;} else{$(no_img).hide(); $(ok_img).show(); boollog = 1;}
								});}
							break
						case "#reg-email":
							var email_sample = /^([A-Za-z0-9_\.-])+@[a-z0-9_\.-]+\.([a-z]{2,4})$/;
							if (!($(field).val()).match(email_sample)){$(no_img).show(); $(ok_img).hide(); boolemail = 0;}
							else {
								$.post("http://be-online/scripts/php/fieldCheck.php",
								{jq_field_name: post_name,
								jq_text: $(field).val()}, 
							function(data){
								if(data > 0){$(no_img).show(); $(ok_img).hide(); booemail = 0;} else{$(no_img).hide(); $(ok_img).show(); boolemail = 1;}
								});}
							break
						case "#reg-pass":
							var pass_sample = /^([\w\!\@\#\$\%\^\&\?\*\(\)\-\=\+\[\]\;\:\'\.\,]{7,20})$/;
							if (!($(field).val()).match(pass_sample)){$(no_img).show(); $(ok_img).hide(); boolpass = 0;}
							else{$(no_img).hide(); $(ok_img).show(); boolpass = 1;}
							break
						case "#reg-repeatpass":
							if ($(field).val() === $("#reg-pass").val()){$(no_img).hide(); $(ok_img).show(); boolrepeatpass = 1;}
							else{$(no_img).show(); $(ok_img).hide(); boolrepeatpass = 0;}
						}
					}
					else{
						$(ok_img).hide();
						$(no_img).hide();
						}
			}
		
		$(document).ready(function(){
			$("#reg-name").on("keyup", function(){fieldCheck("#reg-name", "", "#name-no-img", "#name-ok-img");});
			$("#reg-login").on("keyup", function(){fieldCheck("#reg-login", "login", "#login-no-img", "#login-ok-img");});
			$("#reg-email").on("keyup", function(){fieldCheck("#reg-email", "email", "#email-no-img", "#email-ok-img");});
			$("#reg-pass").on("keyup", function(){fieldCheck("#reg-pass", "", "#pass-no-img", "#pass-ok-img");});
			$("#reg-repeatpass").on("keyup", function(){fieldCheck("#reg-repeatpass", "", "#repeatpass-no-img", "#repeatpass-ok-img");});
			
			$("#reset_btn").click(function(){$(".picture").hide(); $("#answer").html("");})
						
			$("#reg_submit_btn").click(function(){
					$("#answer").hide();
					$("#loaderImage").show();
					setTimeout(function(){
						if (boolname*boollog*boolemail*boolpass*boolrepeatpass == 1){		
						$.post("http://be-online/scripts/php/registration.php",
								{reg_name_edit: $("#reg-name").val(),
								reg_log_edit:$("#reg-login").val(),
								reg_email_edit:$("#reg-email").val(),
								reg_pass1_edit:$("#reg-pass").val(),
								reg_pass2_edit:$("#reg-repeatpass").val(),
								reg_age:$("#age_field").val(),
								reg_submit_btn:true}, 
							function(data){
								$("#loaderImage").hide();
								$("#answer").show();
								$("#answer").html(data);
								})
						}else {
							$("#loaderImage").hide();
							$("#answer").show();
							$("#answer").html("<strong class=\"failed-reg\">Заповніть поля згідно вимог</strong>");}}, 1000);
						});
						
			$("#requirements").click(function(){alert("Які будуть описані згодом...");})			

			})
	
	</script>

<script type="text/javascript"> //http://preloaders.net/ru/
	var cSpeed=9;
	var cWidth=48;
	var cHeight=16;
	var cTotalFrames=12;
	var cFrameWidth=48;
	var cImageSrc='../media/sprites.gif';
	
	var cImageTimeout=false;
	var cIndex=0;
	var cXpos=0;
	var cPreloaderTimeout=false;
	var SECONDS_BETWEEN_FRAMES=0;
	
	function startAnimation(){
		
		document.getElementById('loaderImage').style.backgroundImage='url('+cImageSrc+')';
		document.getElementById('loaderImage').style.width=cWidth+'px';
		document.getElementById('loaderImage').style.height=cHeight+'px';
		
		//FPS = Math.round(100/(maxSpeed+2-speed));
		FPS = Math.round(100/cSpeed);
		SECONDS_BETWEEN_FRAMES = 1 / FPS;
		
		cPreloaderTimeout=setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES/1000);
		
	}
	
	function continueAnimation(){
		
		cXpos += cFrameWidth;
		//increase the index so we know which frame of our animation we are currently on
		cIndex += 1;
		 
		//if our cIndex is higher than our total number of frames, we're at the end and should restart
		if (cIndex >= cTotalFrames) {
			cXpos =0;
			cIndex=0;
		}
		
		if(document.getElementById('loaderImage'))
			document.getElementById('loaderImage').style.backgroundPosition=(-cXpos)+'px 0';
		
		cPreloaderTimeout=setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES*1000);
	}
	
	function stopAnimation(){//stops animation
		clearTimeout(cPreloaderTimeout);
		cPreloaderTimeout=false;
	}
	
	function imageLoader(s, fun)//Pre-loads the sprites image
	{
		clearTimeout(cImageTimeout);
		cImageTimeout=0;
		genImage = new Image();
		genImage.onload=function (){cImageTimeout=setTimeout(fun, 0)};
		genImage.onerror=new Function('alert(\'Could not load the image\')');
		genImage.src=s;
	}
	
	//The following code starts the animation
	new imageLoader(cImageSrc, 'startAnimation()');
</script>    
</body>
</html>