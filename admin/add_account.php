
<?php
	$s=0;
		include 'php/header.php';
	//session_start();
	if($_SESSION['auth_permission']!="admin")
		header("Location: index.php");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		//include"../config.php";
		$access=$fn=$ln=$username=$pass=$bm=$bd=$by=$gender=$home=$mobile=$email=$ques=$ans="";
		$accessrr=$fnrr=$lnrr=$usernamerr=$passrr=$bdrr=$genderrr=$homerr=$mobilerr=$emailrr=$quesrr=$ansrr=" ";

		//check if empty
		if(empty($_POST['fn'])) $fnrr="First Name is required"; else $fn=$_POST['fn'];
		if(empty($_POST['ln'])) $lnrr="Last Name is required"; else $ln=$_POST['ln'];
		if(empty($_POST['username'])) $usernamerr="Usename is required"; else $username=$_POST['username'];
		if(empty($_POST['pass'])) $passrr="Password is required"; else $pass=$_POST['pass'];
		if(empty($_POST['bd'])) $bdrr="Birth Date is required"; else $bd=$_POST['bd'];

		if(isset($_POST['gender'])) $gender=$_POST['gender']; else $gender="";
		if(isset($_POST['access'])) $access=$_POST['access']; else $access="";

		if(empty($gender)) $genderrr="Gender is required";
		if(empty($access)) $accessrr="Access Type is required";
		if(empty($_POST['home'])) $homerr="Home Address is required"; else $home=$_POST['home'];
		if(empty($_POST['mobile'])) $mobilerr="Mobile is required"; else $mobile=$_POST['mobile'];
		if(empty($_POST['email'])) $emailrr="Email is required"; else $email=$_POST['email'];
		if(empty($_POST['ques'])) $quesrr="Secret Question is required"; else $ques=$_POST['ques'];
		if(empty($_POST['ans'])) $ansrr="Secret Answer is required"; else $ans=$_POST['ans'];

		$fn=DB::esc($fn);
		$ln=DB::esc($ln);
		$username=DB::esc($username);
		$pass=DB::esc($pass);
		$bd=DB::esc($bd);
		$gender=DB::esc($gender);
		$home=DB::esc($home);
		$mobile=DB::esc($mobile);
		$email=DB::esc($email);
		$ques=DB::esc($ques);
		$ans=DB::esc($ans);

		if(!preg_match("/^[[0-9]{4}\-[0-9]{2}\-[0-9]{2}]*$/", $bd) and !empty($_POST["bd"]))
			$bdrr="invalid birhtday format";
		else{//----------------------------checking age input
			if(!empty($_POST["bd"])){
				list($YY,$MM,$dd)=explode("-", $bd);
				if($YY<=(date("Y")-18)){
					if($MM>=date("m") and $dd<=date("d") and $YY==(date("Y")-18))
						$bdrr="below of 18yrs old is not allowed.";
				}
				else
					$bdrr="below of 18yrs old is not allowed.";
			}
		}
		$valid = array("male","female");
		//validation
		if(!in_array($gender, $valid) and $gender!=="") //if user modify from inspect in browser
			$genderrr="this is for human.";
		$valid2 = array("admin","editor");
		//validation
		if(!in_array($access, $valid2) and $access!=="") //if user modify from inspect in browser
			$accessrr="this is for human.";

		if (!preg_match("/^[a-zA-Z ]*$/",$fn))
		  	$fnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z ]*$/",$ln))
		  	$lnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username))
		  	$usernamerr = "Only letters, 0-9 and _ allowed";
		else{
			$sqlcmd="SELECT 1 From UserAccount WHERE UserAccountUserName='$username'";
			DB::query($sqlcmd);
			if(DB::getNumRows())
				$usernamerr="Username already exist.";
		}
		if(!preg_match("/^[0-9]*$/", $mobile))
			$mobilerr="Invalid mobile number";

		if(!filter_var($email, FILTER_VALIDATE_EMAIL) and !empty($_POST['email']) )
			$emailrr="Invalid email format";
		else{
			$sqlcmd="SELECT 1 From UserAccount WHERE UserAccountEmail='$email'";//echo $sqlcmd."  ".DB::getNumRows();
			DB::query($sqlcmd);
			if(DB::getNumRows())
				$emailrr="Email already exist.";
		}

		//check if password and secret answer is match
		$pass2=DB::esc($_POST['pass2']);
		if($pass2!=$pass)
			$passrr="Password mismatch";
		$ans2=DB::esc($_POST['ans2']);
		if($ans2!=$ans)
			$ansrr="Secret Answer mismatch";


		if($fnrr==" " && $lnrr==" " && $usernamerr==" " && $passrr==" "  && $bdrr==" "  &&
			$genderrr==" " && $homerr==" " && $mobilerr==" " && $emailrr==" " &&  $quesrr==" " && $ansrr==" " && $accessrr==" "){

			$gen=($gender=="male")?"male.png":"female.png";//set the default photo depends on user's gender

	 		$sql="INSERT INTO UserAccount(UserAccountImage,UserAccountFirstName,UserAccountLastName,UserAccountUserName,UserAccountPassword,UserAccountBD,
	 			UserAccountGender,UserAccountHomeAddress,UserAccountMobile,UserAccountEmail,UserAccountSecretQuestion,UserAccountAnswer)
				VALUES('$gen','$fn','$ln','$username','".md5($pass)."','$bd',
					'$gender','$home','$mobile','$email','$ques','".md5($ans)."')";
			DB::query($sql);
			$rs=DB::query("SELECT UserAccountID FROM UserAccount ORDER BY UserAccountID DESC LIMIT 1");
			$row=$rs->fetch_object();
			DB::query("INSERT INTO UserAccountType(UserAccountID,UserAccountTypeValue) VALUES(".$row->UserAccountID.",'admin')");
			DB::query("INSERT INTO UserAccountAccess(UserAccountID,UserAccountAccessValue) VALUES(".$row->UserAccountID.",'$access')");
			$ok="Account Created!";

		}
		else
			$ok="please complete the fields.";
	}
?>
<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */

		

		if(!isset($_SESSION['auth_accountID']))
			header("Location: index.php");
		else
		{
				?>
			<a href="view_accounts.php"><button>back</button></a>
				<?php 	if(isset($ok)){
							echo $ok;
							unset($ok);
						}?>
					<?php if(!isset($fn))$fn=$ln=$username=$pass=$bm=$bd=$by=$gender=$home=$mobile=$email=$ques=$ans=$access="";?>
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<table>
							<tr>
								<td>
									<span id="err">all field required</span>
								</td>
							</tr>
							<tr>
								<td>ACCESS TYPE:</td>
								<td>
									<input type="radio" name="access" <?php if(isset($_POST['access']) && $access=="admin" ) echo "checked"; ?> value="admin"> ADMIN
									<input type="radio" name="access" <?php if(isset($_POST['access']) && $access=="editor" ) echo "checked"; ?>  value="editor">EDITOR
								</td>
								<td><span id="err"><?php if(isset($accessrr)) echo $accessrr;?></span></td>
							</tr>
							<tr>
								<td>FIRST NAME: </td>
								<td><input placeholder="first name"  type="text" name="fn"  value="<?=$fn;?>"></td>
								<td><span id="err"><?php if(isset($fnrr)) echo $fnrr;?></span></td>
							</tr>
							<tr>
								<td>LAST NAME:</td>
								<td><input placeholder="last name"  type="text" name="ln" value="<?=$ln;?>"></td>
								<td><span id="err"><?php if(isset($lnrr)) echo $lnrr;?></span></td>
							</tr>
							<tr>
								<td>USERNAME:</td>
								<td><input placeholder="username"  type="text" name="username" value="<?=$username;?>"></td>
								<td><span id="err"><?php if(isset($usernamerr)) echo $usernamerr;?></span></td>
							</tr>
							<tr>
								<td>PASSWORD:</td>
								<td><input placeholder="password"  type="password" name="pass" ></td>
								<td><span id="err"><?php if(isset($passrr)) echo $passrr;?></span></td>
							</tr>
							<tr>
								<td>RE-TYPE PASSWORD</td>
								<td><input placeholder="re-type password" type="password" name="pass2"></td>
								<td></td>
							</tr>
							<tr>
								<td>BIRTHDATE:</td>
								<td>
									<input type="date" name="bd" id="datepicker"  value="<?=$bd;?>">
							<!--		<script src="js/datepicker/jquery.min.js"></script>-->
								</td>
								<td><span id="err"><?php if(isset($bdrr)) echo $bdrr;?></span></td>
							</tr>
							<tr>
								<td>GENDER:</td>
								<td>
									<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="male" ) echo "checked"; ?> value="male"> male
									<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="female" ) echo "checked"; ?>  value="female">female
								</td>
								<td><span id="err"><?php if(isset($genderrr)) echo $genderrr;?></span></td>
							</tr>
							<tr>
								<td>HOME ADDRESS:</td>
								<td colspan="2"><textarea placeholder="home address" rows="3" cols="48" name="home"><?=$home;?></textarea></td>
								<td><span id="err"><?php if(isset($homerr)) echo $homerr;?></span></td>
							</tr>
							<tr>
								<td>MOBILE NUMBER:</td>
								<td><input placeholder="mobile number" type="text" name="mobile" value="<?=$mobile;?>"></td>
								<td><span id="err"><?php if(isset($mobilerr)) echo $mobilerr;?></span></td>
							</tr>
							<tr>
								<td>EMAIL ADDRESS:</td>
								<td><input placeholder="email address" type="text" name="email" value="<?=$email;?>"></td>
								<td><span id="err"><?php if(isset($emailrr)) echo $emailrr;?></span></td>
							</tr>
							<tr>
								<td>SECRET QUESTION:</td>
								<td><input placeholder="secret question" type="text" name="ques" value="<?=$ques;?>"></td>
								<td><span id="err"><?php if(isset($quesrr)) echo $quesrr;?></span></td>
							</tr>
							<tr>
								<td>SECRET ANSWER:</td>
								<td><input placeholder="secret answer " type="password" name="ans" ></td>
								<td><span id="err"><?php if(isset($ansrr)) echo $ansrr;?></span></td>
							</tr>
							<tr>
								<td>RETYPE ANSWER:</td>
								<td><input placeholder="re-type secret answer" type="password" name="ans2" ></td>
								<td></td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
									<input type="submit" value="CREATE ACCOUNT">
								</td>
								<td>

								</td>
							</tr>
						</table>
						</form>
			<?php
		}
	?>
	</body>
</html>
