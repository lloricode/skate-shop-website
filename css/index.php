<?php
	session_start();
	include"../config.php";
?>
<!DOCTYPE html>
<html>
  <head></head>
	<body>
		<div style="background-color:#101010; height:270;">
			<center>
				<div class="header" style="background-image:url('../img/header/banner<?php echo "6";?>.jpg');">
					<div id="inside_header">
						<div id="log" >
							<?php
								if(isset($_SESSION['authID'])){  ?>
									<p>
										Welcome,
										<a href='profile.php' >
											<?php echo $_SESSION['authFn']?>!&nbsp;&nbsp;&nbsp;
											<img src="<?php echo $ri->h("../img/UserImage/".$_SESSION['authImg'],28);?>" alt="<?php echo $_SESSION['authFn']." ".$_SESSION['authLn']; ?>" >
										</a>&nbsp;&nbsp;&nbsp;&nbsp;
									 	<a href="setting.php" class="setting">SETTING</a>&nbsp;&nbsp; <a href="../php/logout.php" class="logout">LOG OUT</a>&nbsp;
									</p>
						<?php		}
								else
									echo "<p><a  class='login' href='signup.php'>SIGN UP</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='../login.php?".basename(DB::esc($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING'])."' class='login'>LOG IN</a>&nbsp;&nbsp;</p>";
							?>
						</div>
					</div>
				</div>
			</center>
		</div>
    <title><?php echo "Skate Apparel | invalid"?></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
		<div style="background-color:#101010; height:90;">
			<center>
				<div class="menu">
		            <div style="float:left;margin-top:3px;">
		           	<ul id="navlist">
						<li id="mainmenu" class='active_menu' ><a href="../index.php" id="current">HOME</a></li>.
						<li id="mainmenu"  ><a href="../store.php?query=all">STORE</a></li>.
						<li id="mainmenu"  ><a href="../contact.php">CONTACT</a></li>.
						<li id="mainmenu"  ><a href="../about.php">ABOUT</a></li>.
						<li id="mainmenu"  ><a href="../mycart.php">CART</a></li>
					</ul>
					</div>
					<form action="../store.php" >
						<span style="float:right">
							<input type="text" class="txtF" height="100px" placeholder="PRODUCT NAME.." name="search">
							<input style="margin-left:0px" type="submit" value="GO">
						</span>
					</form>
				</div>
			</center>
		</div>		
		<center>
			<div class="main_body"><BR>
			<h1>You have no Permission to access this url</h1>
			</div>
		</center>

		<div class="footer">
			<center>
				<p style="color:gray; font-size:10px; margin-top:4px;">
					COPYRIGHT @ 2015 BY: LLORIC GARCIA & MUH TORLAO
				</p>
			</center>
		</div>
	</body>
</html>