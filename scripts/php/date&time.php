<?php
echo "<pre>Today is: ".date("d.m.y")."  ".date("H.i.s")."</pre>";
		
	$file = fopen("files/time.txt", "r") or die("Error: Can not open file");
	
	$old_time = fread($file, 30)or die("Error: Can not read file");
	
	fclose($file) or die("Can not close the file");
			
	$now_time = time();
	
	$time = $now_time - $old_time;
	
	$sec = $time % 60;
	$time = floor($time / 60);
	$min = $time % 60;
	$time = floor($time / 60);
	$hour = $time % 24;
	$day = floor($time / 24);
	
	echo "<pre>\nYou visited this page ".$day." day(s) ".$hour." hour(s) ".$min." minute(s) ".$sec." second(s) ago</pre>";
	
	$file = fopen("files/time.txt", "w") or die("Error: Can not open file");
	fwrite($file, $now_time) or die("Error: Can not write to the file");
	fclose($file);		
?>