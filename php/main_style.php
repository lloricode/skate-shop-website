<!--   -->
<!--   -->
<!-- 			develop by Lloric Garcia  -->
<!--  			design by Megan Torlao -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<?php
	session_start();
	$title="";
	switch ($docfile) {
		case 'store':
			$title="Store";
			break;
		case 'contact':
			$title="Contact";
			break;
		case 'about':
			$title="About";
			break;
		case 'profile':
			$title=$_SESSION['authFn']." ".$_SESSION['authLn'];
			break;
		case 'cart':
			$title=$_SESSION['authFn']."'s Cart";
			break;
		default:
			$title="Skate Apparel";
			break;
	}
?>



<!DOCTYPE html>
<html>
  <head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/icon.jpg" rel="shortcut icon" type="image/x-icon" />