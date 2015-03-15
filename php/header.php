<?php
/**
 * @author Lloric Garcia
 * @copyright 2015//
 */
	include"config.php";
?>

	</head>
	<body>

		<div style="background-color:#101010; height:270;">
			<center>
				<div class="header">
					<div id="inside_header">
						<div id="log" >
							<?php
								if(isset($_SESSION['authID'])){  ?>
									<p>
										Welcome,
										<a href='profile.php' >
											<?php echo $_SESSION['authFn']?>!&nbsp;&nbsp;&nbsp;
											<img src="<?php echo $ri->h("img/UserImage/".$_SESSION['authImg'],28);?>" alt="<?php echo $_SESSION['authFn']." ".$_SESSION['authLn']; ?>" >
										</a>&nbsp;&nbsp;&nbsp;&nbsp;
									 	<a href="setting.php" class="setting">SETTING</a>&nbsp;&nbsp; <a href="php/logout.php" class="logout">LOG OUT</a>&nbsp;
									</p>
						<?php		}
								else
									echo "<p><a href='login.php?".basename(DB::esc($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING'])."' class='login'>LOG IN</a>&nbsp;&nbsp;</p>";
							?>
						</div>
					</div>
				</div>
			</center>
		</div>
<?php
	if(!($docfile=="cart" || $docfile=="fill" ))
 		include('top-cache.php'); ?>