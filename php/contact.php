<!DOCTYPE html>
<html>
	<head>
		<title>text</title>
        <link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
		<style type="text/css">
		a,p,div         {text-decoration:none;color: white;font-family: sans-serif;/*segoe ui light*/}
		</style>
 		<link rel="stylesheet" type="text/css" href="../css/comment.css?v=0" />
		<script type="text/javascript" id="hcb">
 			 /*<!--*/ if(!window.hcb_user){hcb_user={};} 
 			 (function(){var s=document.createElement("script"), l=(""+window.location).replace(/'/g,"%27") 
 			 	|| hcb_user.PAGE, h="//www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", 
 			 		h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&opts=16862&num=10");if (typeof s!="undefined") 
 			 	document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
			<!-- end htmlcommentbox.com -->
	</head>
	<body>
		<div>
			<?php
				$tmp_dir="../";
				include"../config.php";
				$rs1=DB::query("SELECT * FROM Document WHERE DocumentCategory='contact title' ORDER BY DocumentArrange");
				$rs2=DB::query("SELECT * FROM Document WHERE DocumentCategory='contact value' ORDER BY DocumentArrange");
				while ($row1=$rs1->fetch_object()) {
					echo "<h2>$row1->DocumentValue</h2>";
					$row2=$rs2->fetch_object();
					echo "<p>$row2->DocumentValue</p>";
				}
			?>
			<?php
			/*	$file=fopen("../text file/contact.txt","r") or die("Unable to open file!.");
				echo fread($file, filesize("../text file/contact.txt"));
				fclose($file);*/
			?><!-- begin htmlcommentbox.com -->

<hr/>
 			<div id="HCB_comment_box">
 		<!--		<a href="http://www.htmlcommentbox.com">Comment Form</a> is loading comments... -->
 			</div>
		</div>
	</body>
</html>