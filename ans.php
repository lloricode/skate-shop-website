<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	
?>
<?php
	//session_start();
	
	if ( isset($_GET) and $_SERVER["REQUEST_METHOD"]=="POST") {
		$data=addslashes($_POST['sec_ans']);

	//	$data=trim($data);
	//	$data=stripslashes($data);
	//	$data=htmlspecialchars($data);
		if($_COOKIE['ans']==md5($data)){
			header("Location: resetpass.php");
		}
		else
			$error= "Incorrect Answer.<BR>";
	}
	include 'headerlogin.php';
?>
						<?  echo $_COOKIE['ques']; ?><br>
						<input placeholder="enter your secret answer" type="text" name="sec_ans" style="width:300px; height:22px;"><BR><BR><BR>
						
						<? for($i=0;$i<11;$i++) echo "<BR>"; ?>
						
						<table>
							<tr>
								<td >
									<a href="login.php">
										<input type="button" name="signup" value="BACK TO LOG IN" style="background-color:orange">
									</a>
								</td>
								<td><? for($i=0;$i<50;$i++) echo "&nbsp"; ?></td>
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
	include 'footer.php';
?>