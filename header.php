<?php
/**
 * @author Lloric Garcia
 * @copyright 2015//
 */
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="./img/Skateboard-2-512.png" rel="shortcut icon" type="image/x-icon" />

        <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>-->
      	<script type="text/javascript" src="js/fresco/jquery-1.11.2.min.js"></script>
       	<script type="text/javascript" src="js/fresco/fresco.js"></script>
       	<link rel="stylesheet" type="text/css" href="css/fresco/fresco.css" />
       <!--	<link rel="stylesheet" type="text/css" href="css/style.css" /> -->
       	<meta name="robots" content="noindex,nofollow" />
	</head>
	<body>
		<div style="background-color:black; height:270;">
			<center>
				<div class="header">
					<div id="inside_header">
						<div id="log" >
							<?php 
								if(isset($_COOKIE['authFn'])){
									echo "<p>Welcome, ".$_COOKIE['authFn']."!&nbsp;&nbsp;&nbsp;<img src='./img/UserImage/".$_COOKIE['authImg']."' alt='' height='28' >&nbsp;&nbsp;&nbsp;&nbsp; 
									 <a href='setting.php'>SETTING</a>&nbsp;&nbsp; <a href='logout.php' style='color:brown'>LOG OUT</a>&nbsp;</p>";
								}
								else
									echo "<p><a href='login.php'>LOG IN</a>&nbsp;&nbsp;</p>";
							?>
						</div>
					</div>
				</div>
			</center>
		</div>
