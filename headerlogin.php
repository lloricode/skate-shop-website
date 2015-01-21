<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop | Log In</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/Skateboard-2-512.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu" >
			    	<table >
		                <tr style="font-size:35px; ">
							<td>
								<a href="index.php" style="font-size:15px;">
									HOME<?php for($i=0;$i<20;$i++) echo "&nbsp"; ?>
								</a>
							</td>
		                    <td >
		                    	<div><br>WELCOME TO SKATESHOP</div> 
		                    </td>
		                    <td>
		                    	<a href="index.php" style="font-size:15px;">
									<?php for($i=0;$i<28;$i++) echo "&nbsp"; ?>
								</a>
							</td>
		            </table>
				</div>
			</center>
		</div>

		<center>
			<div style=" height: 800px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						