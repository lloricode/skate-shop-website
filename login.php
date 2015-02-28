<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	include("config.php");
?>
<?php
	$docfile="login";
	include 'php/headerlogin.php';
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
			unset($error);
			header("Location: index.php");
		}
		else
			$error= "Your Login UserName/Email or Pasword is invalid.<BR>";
	}
?>
						E-MAIL ADDRESS/USERNAME:<?php for($i=0;$i<14;$i++) echo "&nbsp;"; ?><br>
						<input type="text" name="user" style="width:300px; height:22px;"><BR><BR><BR>
						PASSWORD:<?php for($i=0;$i<42;$i++) echo "&nbsp;"; ?><br>
						<input type="password" name="pass" style="width:300px; height:22px;"><BR>
						<?php for($i=0;$i<8;$i++) echo "<BR>"; ?>
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
	include 'php/footer.php';
?>