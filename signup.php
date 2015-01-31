
<?php 
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	include 'config.php';

	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

		$fn=$ln=$username=$pass=$bm=$bd=$by=$gender=$home=$mobile=$email=$shipping=$ques=$ans="";
		$fnrr=$lnrr=$usernamerr=$passrr=$bmrr=$bdrr=$byrr=$genderrr=$homerr=$mobilerr=$emailrr=$shippingrr=$quesrr=$ansrr=" ";

		//check if empty
		if(empty($_POST['fn'])) $fnrr="First Name is required"; else $fn=$_POST['fn'];
		if(empty($_POST['ln'])) $lnrr="Last Name is required"; else $ln=$_POST['ln'];
		if(empty($_POST['username'])) $usernamerr="Usename is required"; else $username=$_POST['username'];
		if(empty($_POST['pass'])) $passrr="Password is required"; else $pass=$_POST['pass'];
		if($_POST['bm']=="month") $bmrr="Birth Month is required"; else $bm=$_POST['bm'];
		if(empty($_POST['bd'])) $bdrr="Birth Date is required"; else $bd=$_POST['bd'];
		if(empty($_POST['by'])) $byrr="Birth Year is required"; else $by=$_POST['by'];

		if(isset($_POST['gender'])) $gender=$_POST['gender']; else $gender="";
		
		if(empty($gender)) $genderrr="Gender is required";
		if(empty($_POST['home'])) $homerr="Home Address is required"; else $home=$_POST['home'];
		if(empty($_POST['mobile'])) $mobilerr="Mobile is required"; else $mobile=$_POST['mobile'];
		if(empty($_POST['email'])) $emailrr="Email is required"; else $email=$_POST['email'];
		if(empty($_POST['shipping'])) $shippingrr="Shipping Address is required"; else $shipping=$_POST['shipping'];
		if(empty($_POST['ques'])) $quesrr="Secret Question is required"; else $ques=$_POST['ques'];
		if(empty($_POST['ans'])) $ansrr="Secret Answer is required"; else $ans=$_POST['ans'];

		//check/filtering the input
		function check_data($data){
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
		$fn=check_data($fn);
		$ln=check_data($ln);
		$username=check_data($username);
		$pass=check_data($pass);
		$bm=check_data($bm);
		$bd=check_data($bd);
		$by=check_data($by);
		$gender=check_data($gender);
		$home=check_data($home);
		$mobile=check_data($mobile);
		$email=check_data($email);
		$shipping=check_data($shipping);
		$ques=check_data($ques);
		$ans=check_data($ans);

		$valid = array("male","female");
		//validation
		if(!in_array($gender, $valid) and $gender!==" ") //if user modify from inspect in browser
			$genderrr="this is for human.";

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
		if(!preg_match("/^(19|20)\d{2}$/", $by) && !$by=="")//For 1900-2099   //from 1000 to 2999   ^[12][0-9]{3}$
			$byrr = "invalid year";
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
		$pass2=check_data($_POST['pass2']);
		if($pass2!=$pass)
			$passrr="Password mismatch";
		$ans2=check_data($_POST['ans2']);
		if($ans2!=$ans)
			$ansrr="Secret Answer mismatch";

		// error for birth date
		$bdate=" ";	
		if($byrr==" "){
			if($bmrr==" "){
				if($bdrr!=" ")
					$bdate=$bdrr;//   coming soon!
			}
			else
				$bdate=$bmrr;
		}
		else
			$bdate=$byrr;
		if($fnrr==" " && $lnrr==" " && $usernamerr==" " && $passrr==" " && $bmrr==" " && $bdrr==" " && $byrr==" " && 
			$genderrr==" " && $homerr==" " && $mobilerr==" " && $emailrr==" " && $shippingrr==" " && $quesrr==" " && $ansrr==" "){

			$gen=($gender=="male")?"male.png":"female.png";//set the default photo depends on user's gender

	 		$sql="INSERT INTO UserAccount(UserAccountImage,UserAccountFisrtName,UserAccountLastName,UserAccountUserName,UserAccountPassword,UserAccountBM,UserAccountBD,UserAccountBY,
	 			UserAccountGender,UserAccountHomeAddress,UserAccountMobile,UserAccountEmail,UserAccountShipping,UserAccountSecretQuestion,UserAccountAnswer)
				VALUES('$gen','$fn','$ln','$username','".md5($pass)."','$bm','$bd','$by',
					'$gender','$home','$mobile','$email','$shipping','$ques','".md5($ans)."')";
			DB::query($sql);
			$ok="Account Created!<BR><a href='login.php'>Back to Log in.</a>";
//------------------------------------------------------------------------------------------
			$sql="SELECT UserAccountID,UserAccountFisrtName,UserAccountLastName,UserAccountImage FROM UserAccount WHERE UserAccountUserName='$username' AND UserAccountPassword='".md5($pass)."'";
			/*
				if sign up is success will go to the home
			*/
			//if result matched usercode and passcode, table must be 1 row.
	/*		$rs=DB::query($sql);
			
			
			if (DB::getNumRows()>0) {
				$row=$rs->fetch_object();
				setcookie("authFn",$row->UserAccountFisrtName,time()+3600,"/");
				setcookie("authLn",$row->UserAccountLastName,time()+3600,"/");
				setcookie("authImg",$row->UserAccountImage,time()+3600,"/");
				setcookie("authID",$row->UserAccountID,time()+3600,"/");
				unset($error);
				//header("Location: index.php");
			}*/
		}
		else
			$ok="please complete the fields.";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop | Sign Up</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/Skateboard-2-512.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div style="background-color:black; height:270;">
			<center>
				<div class="header">
					<div id="inside_header">
						<div id="log" >
						
						</div>
					</div>
				</div>
			</center>
		</div>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu" >
				</div>
			</center>
		</div>
		<center>
			<div style="width: 900px; height: 45px; background-color: orange;">
			    <table>
	                <tr style="font-size:30px;">
	                    <td id="tdpad3" style="float:left;">
	                    	SIGN UP FORM<? for($i=0;$i<50;$i++) echo "&nbsp"; ?>
	                    </td>
	                </tr>
	            </table>
			</div>
			<div class="main_body" style="margin-top:1px;">
				<?php 	if(isset($ok)){
							echo $ok;
							unset($ok);
						}?>
			
					<BR><BR><BR><BR>
					<? if(!isset($fn))$fn=$ln=$username=$pass=$bm=$bd=$by=$gender=$home=$mobile=$email=$shipping=$ques=$ans="";?>
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<table>
							<tr>
								<td>FIRST NAME: </td>
								<td><input placeholder="first name"  type="text" name="fn"  value="<?=$fn;?>"></td>
								<td><span id="err"><? if(isset($fnrr)) echo $fnrr;?></span></td>
							</tr>
							<tr>
								<td>LAST NAME:</td>
								<td><input placeholder="last name"  type="text" name="ln" value="<?=$ln;?>"></td>
								<td><span id="err"><? if(isset($lnrr)) echo $lnrr;?></span></td>
							</tr>
							<tr>
								<td>USERNAME:</td>
								<td><input placeholder="username"  type="text" name="username" value="<?=$username;?>"></td>
								<td><span id="err"><? if(isset($usernamerr)) echo $usernamerr;?></span></td>
							</tr>
							<tr>
								<td>PASSWORD:</td>
								<td><input placeholder="password"  type="password" name="pass" ></td>
								<td><span id="err"><? if(isset($passrr)) echo $passrr;?></span></td>
							</tr>
							<tr>
								<td>RE-TYPE PASSWORD</td>
								<td><input placeholder="re-type password" type="password" name="pass2"></td>
								<td></td>
							</tr>
							<tr>
								<td>BIRTHDATE:</td>
								<td>
									<input type="text" name="by" placeholder="year" style="width:130px" value="<?=$by;?>">
									<select name="bm">
										<option <?php if(isset($_POST['bm']) && $bm=="month" ) echo "selected"; ?> >month</option>
										<option <?php if(isset($_POST['bm']) && $bm=="January" ) echo "selected"; ?> >January</option>
										<option <?php if(isset($_POST['bm']) && $bm=="February" ) echo "selected"; ?> >February</option>
										<option <?php if(isset($_POST['bm']) && $bm=="March" ) echo "selected"; ?> >March</option>
										<option <?php if(isset($_POST['bm']) && $bm=="April" ) echo "selected"; ?> >April</option>
										<option <?php if(isset($_POST['bm']) && $bm=="May" ) echo "selected"; ?> >May</option>
										<option <?php if(isset($_POST['bm']) && $bm=="June" ) echo "selected"; ?> >June</option>
										<option <?php if(isset($_POST['bm']) && $bm=="July" ) echo "selected"; ?> >July</option>
										<option <?php if(isset($_POST['bm']) && $bm=="August" ) echo "selected"; ?> >August</option>
										<option <?php if(isset($_POST['bm']) && $bm=="September" ) echo "selected"; ?> >September</option>
										<option <?php if(isset($_POST['bm']) && $bm=="October" ) echo "selected"; ?> >October</option>
										<option <?php if(isset($_POST['bm']) && $bm=="November" ) echo "selected"; ?> >November</option>
										<option <?php if(isset($_POST['bm']) && $bm=="December" ) echo "selected"; ?> >December</option>
									</select>
									<input type="text" name="bd" placeholder="day" style="width:110px;margin-right:35px" value="<?=$bd;?>">
								</td>
								<td><span id="err"><? if(isset($bdate)) echo $bdate;?></span></td>
							</tr>
							<tr>
								<td>GENDER:</td>
								<td>
									<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="male" ) echo "checked"; ?> value="male"> male
									<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="female" ) echo "checked"; ?>  value="female">female
								</td>
								<td><span id="err"><? if(isset($genderrr)) echo $genderrr;?></span></td>
							</tr>
							<tr>
								<td>HOME ADDRESS:</td>
								<td><textarea placeholder="home address" rows="3" cols="48" name="home"><?=$home;?></textarea></td>
								<td><span id="err"><? if(isset($homerr)) echo $homerr;?></span></td>
							</tr>
							<tr>
								<td>MOBILE NUMBER:</td>
								<td><input placeholder="mobile number" type="text" name="mobile" value="<?=$mobile;?>"></td>
								<td><span id="err"><? if(isset($mobilerr)) echo $mobilerr;?></span></td>
							</tr>
							<tr>
								<td>EMAIL ADDRESS:</td>
								<td><input placeholder="email address" type="text" name="email" value="<?=$email;?>"></td>
								<td><span id="err"><? if(isset($emailrr)) echo $emailrr;?></span></td>
							</tr>
							<tr>
								<td>SHIPPING ADDRESS:</td>
								<td><textarea placeholder="shipping address" rows="3" cols="48" name="shipping"   ><?=$shipping;?></textarea></td>
								<td><span id="err"><? if(isset($shippingrr)) echo $shippingrr;?></span></td>
							</tr>
							<tr>
								<td>SECRET QUESTION:</td>
								<td><input placeholder="secret question" type="text" name="ques" value="<?=$ques;?>"></td>
								<td><span id="err"><? if(isset($quesrr)) echo $quesrr;?></span></td>
							</tr>
							<tr>
								<td>SECRET ANSWER:</td>
								<td><input placeholder="secret answer " type="password" name="ans" ></td>
								<td><span id="err"><? if(isset($ansrr)) echo $ansrr;?></span></td>
							</tr>
							<tr>
								<td>RETYPE ANSWER:</td>
								<td><input placeholder="re-type secret answer" type="password" name="ans2" ></td>
								<td></td>
							</tr>
							<tr>
								<td>
									<a href="login.php" style="font-size:15px;">
										<button>CANCEL</button>
									</a></td>
								<td>
									<input type="submit" value="CREATE ACCOUNT">
								</td>
								<td>
									
								</td>
							</tr>
						</table>
						<p>Learn how to validate form in</p>
						<a href="http://www.w3schools.com/php/php_form_complete.asp" target="blank_">http://www.w3schools.com/php/php_form_complete.asp</a>
					</form>


			</div>
		</center>
<?php

	include 'footer.php';
?>