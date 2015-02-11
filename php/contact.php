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
				$file=fopen("../text file/contact.txt","r") or die("Unable to open file!.");
				echo fread($file, filesize("../text file/contact.txt"));
				fclose($file);
			?>
		</div>
	</body>
</html>