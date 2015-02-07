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
								if(isset($_COOKIE['authFn'])){  ?>
									<p>	
										Welcome, 
										<a href='profile.php' >
											<?=$_COOKIE['authFn']?>!&nbsp;&nbsp;&nbsp;
											<img src="./img/UserImage/<?=$_COOKIE['authImg'];?>" alt="" height="28" >
										</a>&nbsp;&nbsp;&nbsp;&nbsp; 
									 	<a href="setting.php" class="setting">SETTING</a>&nbsp;&nbsp; <a href="logout.php" class="logout">LOG OUT</a>&nbsp;
									</p>
						<?		}
								else
									echo "<p><a href='login.php' class='login'>LOG IN</a>&nbsp;&nbsp;</p>";
							?>
						</div>
					</div>
				</div>
			</center>
		</div>
