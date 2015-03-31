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
	include"php/visit.php";
	session_start();
	$title="";
	switch ($docfile) {
		case 'login':
			$title="Log In";
			break;
		case 'recover':
			$title="Recover Password";
			break;
		case 'ans':
			$title="Secret Answer";
			break;
		case 'reset':
			$title="Reset Password";
			break;
		case 'success':
			$title="Success Reset Password!";
			break;
		default:
			$title="Home";
			break;
	}
?>



<!DOCTYPE html>
<html>
  	<head>
    	<title><?php echo "Skate Apparel | ".$title?></title>
    	<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/icon.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div style="background-color:#101010; height:90;">
			<center>
				<div class="menu" >
			    	<table >
		                <tr style="font-size:35px; ">
							<td>
								<a href="index.php" style="font-size:15px;">
									HOME<?php for($i=0;$i<20;$i++) echo "&nbsp;"; ?>
								</a>
							</td>
		                    <td >
		                    	<div><br>WELCOME TO SKATE APPAREL</div> 
		                    </td>
		                    <td>
		                    	<a href="index.php" style="font-size:15px;">
									<?php for($i=0;$i<28;$i++) echo "&nbsp;"; ?>
								</a>
							</td>
		            </table>
				</div>
			</center>
		</div>