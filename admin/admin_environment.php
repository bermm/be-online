<?php
	require_once("../config.php");
	
	function adminNotLogged(){
		unset($_SESSION['admin']);
		$_SESSION['logged'] = false;
		header("Location:".URL."/admin/");}
			
	if (isset($_POST['admin_out_btn'])){
		adminNotLogged();}
	elseif(!$_SESSION['logged']){
		header("Location:".URL."/admin/");}
	
				
	$templater = new Templater();
	$title = "Адміністратор || Редагування";
	echo $templater->load_template($title, "/admin/admin_pages_elements/admin_environment_header.tpl");
	include_once("admin_pages_elements/admin_environment_content.php");
	echo(file_get_contents(PATH."/admin/admin_pages_elements/admin_environment_footer.tpl"));
?>
