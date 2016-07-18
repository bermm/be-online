/*$("#upload_btn").click(function(){
			console.log("clicked");
			$("#upload_file_form").ajaxForm(
				{
            	beforeSubmit:function(){
					alert("begin");
					},
				success:function(){
					console.log("success");
					},
            	error:function(){
					console.log("error");
					}
				}).submit();
			
			});*/


$("#upload_btn").click(function(){
			$("#ajax_loader").show();
			$("#upload_file_form").submit(function(event){
    			var formObj = $(this);
    			var formURL = formObj.attr("action");
    			var formData = new FormData(this);
    			$.ajax({
        			url: formURL,
    				type: 'POST',
        			data:  formData,
    				mimeType:"multipart/form-data",
    				contentType: false,
       				cache: false,
        			processData:false,
    				success: function(data, textStatus, jqXHR){
						$("#ajax_loader").hide();
						$("#upload_message").html(data);
						},
     				error: function(jqXHR, textStatus, errorThrown){
						alert(textStatus);
						}
					});
    			event.preventDefault(); //Prevent Default action. 
   			event.unbind();}); 
			$("#upload_file_form").submit(); //Submit the form
			})