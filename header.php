<?php
/**
 * @author Lloric Garcia
 * @copyright 2015//
 */
?>

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
