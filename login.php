<?php
//echo $_SERVER ['QUERY_STRING'];
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	include("config.php");
?>
<?php
	$docfile="login";
	include 'php/headerlogin.php';
//	if(isset($_SESSION['authID']))
//		header("Location: index.php");
	setcookie("recID","",time()-3600,"/");
	if ( isset($_GET) and $_SERVER["REQUEST_METHOD"]=="POST") {
		$usercode=addslashes($_POST['user']);
		$passcode=addslashes(md5($_POST['pass']));

		if(filter_var($usercode, FILTER_VALIDATE_EMAIL)){
			$tmp="UserAccountEmail";
		}
		else
			$tmp="UserAccountUserName";

		$sql="SELECT UserAccountID,UserAccountFisrtName,UserAccountLastName,UserAccountImage 
			FROM UserAccount WHERE $tmp='$usercode' AND UserAccountPassword='$passcode'";
		$rs=DB::query($sql);
		if (DB::getNumRows()>0) {
			$row=$rs->fetch_object();
			$_SESSION["authFn"]=$row->UserAccountFisrtName;//setcookie("authFn",$row->UserAccountFisrtName,time()+3600,"/");
			$_SESSION["authLn"]=$row->UserAccountLastName;//setcookie("authLn",$row->UserAccountLastName,time()+3600,"/");
			$_SESSION["authImg"]=$row->UserAccountImage;//setcookie("authImg",$row->UserAccountImage,time()+3600,"/");
			$_SESSION["authID"]=$row->UserAccountID;//setcookie("authID",$row->UserAccountID,time()+3600,"/");
			//unset($error);
			header("Location: ".(($_SERVER['QUERY_STRING']=="")?"index.php":$_SERVER['QUERY_STRING']));
			//echo "[".(($_SERVER['QUERY_STRING']=="")?"index.php":$_SERVER['QUERY_STRING'])."]";
		}
		else
			echo "Your Login UserName/Email or Pasword is invalid.<br />";
	}
?>		<center>
			<div style=" height: 1139px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?".$_SERVER ['QUERY_STRING']; ?>" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						E-MAIL ADDRESS/USERNAME:<?php for($i=0;$i<14;$i++) echo "&nbsp;"; ?><br />
						<input type="text" name="user" style="width:300px; height:22px;"><br /><br /><br />
						PASSWORD:<?php for($i=0;$i<42;$i++) echo "&nbsp;"; ?><br />
						<input type="password" name="pass" style="width:300px; height:22px;"><br />
						<?php for($i=0;$i<8;$i++) echo "<br />"; ?>
						<a href="recovery.php">forgot password?</a>
						<table>
							<tr>
								<td >
									<a href="signup.php">
										<input class="btnorange" type="button" name="signup" value="SIGN UP">
									</a>
								</td>
								<td><?php for($i=0;$i<50;$i++) echo "&nbsp;"; ?></td>
								<td>
									<input class="btnred" type="submit" name="login" value="LOG IN" >
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</center>
<?php
	include 'php/footer2.php';
?>