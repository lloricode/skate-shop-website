<?php

/**
 * @author Lloric Garcia
 * @copyright 2015
 */


include 'config.php';

$path = "img/UserImage/";

	$valid_formats = array("jpg","png");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
			$name = $_FILES['imgfile']['name'];
			$size = $_FILES['imgfile']['size'];

			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					
					if(in_array($ext,$valid_formats))
					{
						if($size<(15728640))
						{
							$imgfile = md5($txt . time()) . "." . $ext;
                            //$imgfile = $txt . "." . $ext;
							$tmp = $_FILES['imgfile']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$imgfile)) {
								if($_COOKIE['authImg']=="male.png" or $_COOKIE['authImg']=="female.png")
									;
								else
									unlink($path.$_COOKIE['authImg']);	
								$query = "UPDATE UserAccount 
								SET UserAccountImage='".$imgfile."' 
								WHERE UserAccountID='".$_COOKIE['authID']."'";
                                DB::query($query);
                                setcookie("authImg",$imgfile,time()+3600,"/");
								setcookie("tmp","Updated!",time()+3,"/");
								//header("Location: setting.php");
							}
							else 
								setcookie("tmp","failed",time()+3,"/");
                            
						}
						else
						  setcookie("tmp","Image file size max 10 MB",time()+3,"/");					
					}
					else
					setcookie("tmp","Invalid file format..",time()+3,"/");
				}
			else
			setcookie("tmp","please select a file.!",time()+3,"/");
			
	}
	header("Location: setting.php");
?>