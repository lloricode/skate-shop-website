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
	</head>
	<body>
		<div style="background-color:black; height:90;">
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
		                    	<div><br>WELCOME TO SKATESHOP</div> 
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

		<center>
			<div style=" height: 1139px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						