<!--   -->
<!--   -->
<!-- develop by Lloric Garcia  -->
<!--  design by Megan Torlao -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<?php
	$title="";
	switch ($docfile) {
		case 'index':
			$title="Home";
			break;
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
			$title=$_COOKIE['authFn']." ".$_COOKIE['authLn'];
			break;
		default:
			$title="Skate Shop";
			break;
	}
?>



<!DOCTYPE html>
<html>
  <head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/icon.jpg" rel="shortcut icon" type="image/x-icon" />