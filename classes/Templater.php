<?php
	class Templater{
		private $title;
		private $path;
		
		public function load_template($title,$path=NULL){
			$this->title = $title;
			$this->path = $path;
			
			$tmp = file_get_contents(PATH.$this->path);
			$tmp =	str_replace("{title}",$this->title,$tmp);
			$tmp =	str_replace("{path}",PATH,$tmp);
			$tmp =	str_replace("{url}",URL,$tmp);
			
			return $tmp;		
			}
		
		}
?>