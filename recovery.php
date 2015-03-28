<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	//include("config.php");
?>
<?php
	//session_start();
	
	$docfile="recover";
	include 'php/headerlogin.php';
	if ( isset($_GET) and $_SERVER["REQUEST_METHOD"]=="POST") {

		$data=addslashes($_POST['email_username']);

		if(filter_var($data, FILTER_VALIDATE_EMAIL)){//check if email is use bu user
			$tmp="UserAccountEmail";
			//list($usercode,$r)=explode(".", $usercode);
		}
		else
			$tmp="UserAccountUserName";

		$sql="SELECT UserAccountID,UserAccountFirstName,UserAccountLastName,
		UserAccountSecretQuestion,UserAccountAnswer,UserAccountImage 
		FROM UserAccount WHERE $tmp='$data'";

		//if result matched usercode and passcode, table must be 1 row.
		$rs=DB::query($sql);
		
		unset($error);
		if (DB::getNumRows()>0) {
			$row=$rs->fetch_object();
			setcookie("recID",$row->UserAccountID,time()+60,"/");
			setcookie("fn",$row->UserAccountFirstName,time()+60,"/");
			setcookie("ln",$row->UserAccountLastName,time()+60,"/");
			setcookie("ques",$row->UserAccountSecretQuestion,time()+60,"/");
			setcookie("ans",$row->UserAccountAnswer,time()+60,"/");
			setcookie("img",$row->UserAccountImage,time()+60,"/");
			header("Location: ans.php");
		}
		else
			$error= "UserName or Email not found.<BR>";
	}
?>


<center>
			<div style=" height: 1139px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						E-MAIL ADDRESS/USERNAME:<?php for($i=0;$i<14;$i++) echo "&nbsp;"; ?><br>
						<input type="text" name="email_username" style="width:300px; height:22px;"><BR><BR><BR>
						
						<?php for($i=0;$i<11;$i++) echo "<BR>"; ?>
						
						<table>
							<tr>
								<td >
									<a href="login.php">
										<input type="button" name="signup" value="BACK TO LOG IN" style="background-color:orange">
									</a>
								</td>
								<td><?php for($i=0;$i<50;$i++) echo "&nbsp;"; ?></td>
								<td>
									<input type="submit" name="login" value="SUBMIT" style="background-color:red">
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