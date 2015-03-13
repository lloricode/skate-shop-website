<?php
	class IMG{
		private static $image,$dir;
		function __construct($tmp_dir) {
			self::$image = new SimpleImage();
			self::$dir=$tmp_dir;
			if(!self::check_if_exist($tmp_dir."tmp"))
				mkdir($tmp_dir."tmp");
		}
		function w($str,$w){//width

			$str2=self::get_file_name($str);
			list($str2,$ext)=explode(".", $str2);
			$output_name="tmp/".$str2."-(Width".$w.").".$ext;

			if(!self::check_if_exist($output_name)){
				self::$image->load($str);
				self::$image->resizeToHeight($w);
	   			self::$image->save(self::$dir.$output_name);
	   			return self::$dir.$output_name;
   			}
   			else
   				return self::$dir.$output_name;
		}
		function h($str,$h){//height

			$str2=self::get_file_name($str);
			list($str2,$ext)=explode(".", $str2);
			$output_name="tmp/".$str2."-(Heigt".$h.").".$ext;

			if(!self::check_if_exist($output_name)){
				self::$image->load($str);
				self::$image->resizeToHeight($h);
	   			self::$image->save(self::$dir.$output_name);
	   			return self::$dir.$output_name;
   			}
   			else
   				return self::$dir.$output_name;
		}
		function wh($str,$w,$h){// widht && height

			$str2=self::get_file_name($str);
			list($str2,$ext)=explode(".", $str2);
			$output_name="tmp/".$str2."-(Width".$w."&Height".$h.").".$ext;

			if(!self::check_if_exist($output_name)){
				self::$image->load($str);
				self::$image->resize($w,$h);
	   			self::$image->save(self::$dir.$output_name);
	   			return self::$dir.$output_name;
   			}
   			else
   				return self::$dir.$output_name;
		}
		//getting the file name include xtension name
		private function get_file_name($file){
			$token = strtok($file, "/");
			$t="";
			while ($token !== false){
				$t=$token;
				$token = strtok("/");
			}
			return $t;
		}
		private function check_if_exist($tmpFile){
			return file_exists($tmpFile);
		}
	}
?>


