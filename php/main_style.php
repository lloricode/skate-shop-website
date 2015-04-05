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
	include"php/visit.php";//?doc=".basename($_SERVER['PHP_SELF']);
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
			$title=$_SESSION['authFn']."'s Add Cart";
			break;
		case 'fill':
			$title="Check Out";
			break;
		case 'signup':
			$title="Sign Up";
			break;
		case 'mycart':
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
    <title><?php echo "Skate Apparel | ".$title?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/header slider/style.css">
        <link href="img/icon.png" rel="shortcut icon" type="image/x-icon" />
        <script type="text/javascript" src="js/header slider/document.js"></script>
        <script type="text/javascript" src="js/header slider/rotator.js"></script>
        <?php 
        	if($docfile=="signup")
        		include"php/datepicker.php";
        ?>