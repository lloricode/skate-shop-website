<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	if(!isset($_COOKIE['recID']))
		header("Location: login.php");
	include("config.php");
?>
<?php
	//session_start();
	
	if ( isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
		$data=addslashes($_POST['newpass']);
		$data2=addslashes($_POST['newpass2']);

		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		if($data==$data2){
			$sql="UPDATE UserAccount
			SET UserAccountPassword='".md5($data)."' 
			WHERE UserAccountID='".$_COOKIE['recID']."'"; 
			setcookie("recID","",time()-3600,"/");
			DB::query($sql);
			$match="1";
		}
		else
			$error= "password not match.<BR>";
	}
	$docfile=(!isset($match))?"reset":"success";
	include 'php/headerlogin.php';
?>

						<?php
							if(isset($match))
								echo"<p>reset password successfull!<BR><a href='login.php' >back to log in</a></p>";
							else{
							?>
						Enter new password:<br>
						<input placeholder="new password" type="password" name="newpass" style="width:300px; height:22px;">
						<input placeholder="re-type new password" type="password" name="newpass2" style="width:300px; height:22px;"><BR><BR><BR>
						
						<?php } for($i=0;$i<11;$i++) echo "<BR>"; ?>
					
						<table>
							<tr>
								<td >
									<a href="login.php">
										<input type="button" name="signup" value="BACK TO LOG IN" style="background-color:orange">
									</a>
								</td>
								<td><?php for($i=0;$i<50;$i++) echo "&nbsp;"; ?></td>
								<td>
									<input type="submit" name="login" value="LOG IN" style="background-color:red">
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