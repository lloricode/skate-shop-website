<!DOCTYPE html>
<html>
	<head>
		<title>text</title>
        <link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
		<style type="text/css">
		a,p,div         {text-decoration:none;color: white;font-family: sans-serif;/*segoe ui light*/}
		</style>
	</head>
	<body>
		<div>
			<?php
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
			?>
		</div>
	</body>
</html>