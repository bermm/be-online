	<div id="inconteiner">
<center>        	
           <iframe class="video-frame" src="//www.youtube.com/embed/sYkjLh-61nM" frameborder="0" allowfullscreen></iframe>
           <iframe class="video-frame" src="http://vk.com/video_ext.php?oid=138284121&id=163909713&hash=3520376b95734442&hd=1" frameborder="0"></iframe>
          <!-- <iframe class="video-frame" src="//www.youtube.com/embed/9rH1kT8EIOU" frameborder="0" allowfullscreen></iframe>
</center>  
     </div>           
	<script type="text/javascript">
    	$(document).ready(function(){
			var frame = ["//www.youtube.com/embed/9rH1kT8EIOU","//www.youtube.com/embed/sYkjLh-61nM","http://vk.com/video_ext.php?oid=138284121&id=163909713&hash=3520376b95734442&hd=1"];
			var current = 0;
						
			$("#prev_btn").click(function(){
				if (current != 0){
					current--;
					$(".video_frame").attr("src", frame[current]);
					location.reload();}
					});
			
			$("#next_btn").click(function(){
					if (current != frame.length-1){
					current++;
					$(".video_frame").attr("src", frame[current]);
					location.reload();}
				});
		
			
			})
    
    </script>  
    <button id="prev_btn">Prev</button>
    <button id="next_btn">Next</button>   -->         
    </div>
</body>
</html>