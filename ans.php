<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	 if(!isset($_COOKIE['ques']))
	 	header("Location: login.php");

	//session_start();
	
	if ( isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST") {
		$data=addslashes($_POST['sec_ans']);

		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		
		if($_COOKIE['ans']==md5($data)){
			setcookie("fn","",time()-3600,"/");
			setcookie("ln","",time()-3600,"/");
			setcookie("ques","",time()-3600,"/");
			setcookie("ans","",time()-3600,"/");
			setcookie("img","",time()-3600,"/");
			header("Location: resetpass.php");
		}
		else
			$error= "Incorrect Answer.<BR>";
	}
	$docfile="ans";
	include 'php/headerlogin.php';
?><center>
			<div style=" height: 1139px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						
								<?php echo $_COOKIE['ques']?><br>
						<input placeholder="enter your secret answer" type="password" name="sec_ans" style="width:300px; height:22px;"><BR><BR><BR>
						
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
									<input type="submit" name="login" value="SUMBIT" style="background-color:red">
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