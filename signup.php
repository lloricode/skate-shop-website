
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

		//validation
		if (!preg_match("/^[a-zA-Z ]*$/",$fn)) 
		  	$fnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z ]*$/",$ln)) 
		  	$lnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) 
		  	$usernamerr = "Only letters, 0-9 and _ allowed";
		if(!preg_match("/^(19|20)\d{2}$/", $by) && !$by=="")//For 1900-2099   //from 1000 to 2999   ^[12][0-9]{3}$
			$byrr = "invalid year";
		if(!preg_match("/^[0-9]*$/", $mobile))
			$mobilerr="Invalid mobile number";
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) and !empty($_POST['email']) )
			$emailrr="Invalid email format";

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
				VALUES('$gen','".$_POST['fn']."','".$_POST['ln']."','".$_POST['username']."','".md5($_POST['pass'])."','".$_POST['bm']."','".$_POST['bd']."','".$_POST['by']."',
					'$gender','".$_POST['home']."','".$_POST['mobile']."','".$_POST['email']."','".$_POST['shipping']."','".$_POST['ques']."','".md5($_POST['ans'])."')";
			DB::query($sql);
			$ok="Account Created!";
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
				<?php if(isset($ok)) echo $ok;?>
				<div style="background-color:; width:800px; float:right;">
					<BR><BR><BR><BR>
					<? if(!isset($fn))$fn=$ln=$username=$pass=$bm=$bd=$by=$gender=$home=$mobile=$email=$shipping=$ques=$ans="";?>
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR>
						
						<label id="label">FIRST NAME:  </label>
							<input placeholder="first name"  type="text" name="fn" id="text" value="<?=$fn;?>">
							<span id="err"><? if(isset($fnrr)) echo $fnrr;?></span><BR><BR>
							<label id="label">LAST NAME: </label>
							<input placeholder="last name"  type="text" name="ln" id="text" value="<?=$ln;?>">
							<span id="err"><? if(isset($lnrr)) echo $lnrr;?></span><BR><BR>
						<label id="label">USERNAME: </label>
							<input placeholder="username"  type="text" name="username" id="text" value="<?=$username;?>">
							<span id="err"><? if(isset($usernamerr)) echo $usernamerr;?></span><BR><BR>
						<label id="label">PASSWORD: </label>
							<input placeholder="password"  type="password" name="pass" id="text">
							<span id="err"><? if(isset($passrr)) echo $passrr;?></span><BR><BR>
						<label id="label">RE-TYPE PASSWORD:</label>
							<input placeholder="re-type password" type="pass2" name="pass2" id="text"><BR><BR>
						<label id="label">BIRTHDATE: </label>
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
							<span id="err"><? if(isset($bdate)) echo $bdate;?></span>
						<BR><BR>

						<label id="label">GENDER: </label>
							<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="male" ) echo "checked"; ?> value="male"> male
							<input type="radio" name="gender" <?php if(isset($_POST['gender']) && $gender=="female" ) echo "checked"; ?>  value="female">female
							<span id="err"><? if(isset($genderrr)) echo $genderrr;?></span><BR><BR>

						<label id="label">HOME ADDRESS: </label>
							<textarea placeholder="home address" rows="3" cols="48" name="home"  id="text" ><?=$home;?></textarea>
							<span id="err"><? if(isset($homerr)) echo $homerr;?></span><BR><BR><BR>
						<label id="label">MOBILE NUMBER: </label>
							<input placeholder="mobile number" type="text" name="mobile" id="text" value="<?=$mobile;?>">
							<span id="err"><? if(isset($mobilerr)) echo $mobilerr;?></span><BR><BR>
						<label id="label">EMAIL ADDRESS: </label>
							<input placeholder="email address" type="text" name="email" id="text" value="<?=$email;?>">
							<span id="err"><? if(isset($emailrr)) echo $emailrr;?></span><BR>
						<label id="label">SHIPPING ADDRESS: </label>
							<textarea placeholder="shipping address" rows="3" cols="48" name="shipping"  id="text" ><?=$shipping;?></textarea>
							<span id="err"><? if(isset($shippingrr)) echo $shippingrr;?></span><BR><BR>
						<p>---------------------------------------------------------------------------</p>
						<label id="label">SECRET QUESTION: </label>
							<input placeholder="secret question" type="text" name="ques" id="text" value="<?=$ques;?>">
							<span id="err"><? if(isset($quesrr)) echo $quesrr;?></span><BR><BR>
						<label id="label">SECRET ANSWER: </label>
							<input placeholder="secret answer " type="password" name="ans" id="text">
							<span id="err"><? if(isset($ansrr)) echo $ansrr;?></span><BR><BR>
						<label id="label">RETYPE ANSWER: </label>
							<input placeholder="re-type secret answer" type="password" name="ans2" id="text"><BR><BR>
						
						<textarea rows="3" cols="10" id="text" name="qq">
							
						</textarea><BR><BR><BR><BR><BR><BR>
						<table>
							<tr>
								<td>
									<? for($i=0;$i<50;$i++) echo "&nbsp"; ?>
								</td>
								<td>
									<a href="login.php" style="font-size:15px;">
										<input type="button" value="   CANCEL  ">
									</a>
								</td>
								<td>
									<input type="submit" value="CREATE ACCOUNT">
								</td>
								<td>
									<? for($i=0;$i<50;$i++) echo "&nbsp"; ?>
								</td>
							</tr>
						</table>
						<p>Learn how to validate form in</p>
						<a href="http://www.w3schools.com/php/php_form_complete.asp" target="blank_">http://www.w3schools.com/php/php_form_complete.asp</a>
					</form>


				</dv>
			</div>
		</center>
<?php

	include 'footer.php';
?>