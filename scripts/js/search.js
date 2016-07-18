// JavaScript Document    
    $(document).ready(function(){
		var doc_height = $(document).height();
		$("#search").click(function(){
			$("#search_field").show(500);
			$("#search_hover").css("height", doc_height);
			$("#search_hover").show();
			});
		$("#search_hover").click(function(){
			$("#search_field").hide(300);
			$("#search_hover").hide();
			});
			
			})