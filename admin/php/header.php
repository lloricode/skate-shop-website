<!--   -->
<!--   -->
<!-- develop by Lloric Garcia  -->
<!--  design by Megan Torlao -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
	<div class="d">
<?php
	if(isset($_SESSION['auth_accountID']))
		echo "Hello!, ".$_SESSION['auth_name']."! &nbsp;&nbsp;&nbsp;<a href='php/logout.php'><button>Logout</button></a><br />";
	

?>
	</div>