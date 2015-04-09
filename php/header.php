<?php
/**
 * @author Lloric Garcia
 * @copyright 2015//
 */
	//include"config.php";
	$banner="";
	switch ($docfile) {
		case 'index':
			$banner="1";
			break;
		case 'store':
			$banner="2";
			break;
		case 'contact':
			$banner="3";
			break;
		case 'index':
			$banner="1";
			break;
		case 'about':
			$banner="4";
			break;
		case 'mycart':
			$banner="5";
			break;
		case 'cart':
			$banner="6";
			break;
		case 'signup':
			$banner="6";
			break;
		case 'setting':
			$banner="6";
			break;
		case 'profile':
			$banner="6";
			break;
	}
?>

	</head>
	<body>
		<div style="background-color:#101010; height:270;">
			<center>
				<div class="header" style="background-image:url('img/header/banner<?php echo $banner;?>.jpg');">
					<div id="inside_header">
						<div id="log" >
							<?php
								if(isset($_SESSION['authID'])){  ?>
									<p>
										Welcome,
										<a href='profile.php' class="setting">
											<?php echo $_SESSION['authFn']?>!&nbsp;&nbsp;&nbsp;
											<img src="<?php echo $ri->h("img/UserImage/".$_SESSION['authImg'],28);?>" alt="<?php echo $_SESSION['authFn']." ".$_SESSION['authLn']; ?>" >
										</a>&nbsp;&nbsp;&nbsp;&nbsp;
									 	<a href="setting.php" class="setting">SETTING</a>&nbsp;&nbsp; <a href="php/logout.php" class="logout">LOG OUT</a>&nbsp;
									</p>
						<?php		}
								else
									echo "<p><a  class='login' href='signup.php'>SIGN UP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='login.php?".basename(DB::esc($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING'])."' class='login'>LOG IN</a>&nbsp;&nbsp;</p>";
							?>
						</div>
					</div>
				</div>
			</center>
		</div>
<?php
	if(!($docfile=="cart" || $docfile=="fill"|| $docfile=="store"|| $docfile=="mycart"|| $docfile=="profile"|| $docfile=="setting"))
 		include('php/top-cache.php'); ?>