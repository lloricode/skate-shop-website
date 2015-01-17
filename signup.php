<?php 
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	include('config.php');
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$gen=($_POST['gender']=="male")?"male.png":"female.png";
 		$sql="INSERT INTO UserAccount(UserAccountImage,UserAccountFisrtName,UserAccountLastName,UserAccountUserName,UserAccountPassword,UserAccountBM,UserAccountBD,UserAccountBY,
 			UserAccountGender,UserAccountHomeAddress,UserAccountMobile,UserAccountEmail,UserAccountShipping,UserAccountSecretQuestion,UserAccountAnswer)
			VALUES('$gen','".$_POST['fn']."','".$_POST['ln']."','".$_POST['username']."','".md5($_POST['pass'])."','".$_POST['bday']."','".$_POST['bday']."','".$_POST['bday']."',
				'".$_POST['gender']."','".$_POST['home']."','".$_POST['mobile']."','".$_POST['email']."','".$_POST['shipping']."','".md5($_POST['ques'])."','".md5($_POST['ans'])."')";
		DB::query($sql);
		$ok="Account Created!";
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
						<a href="login.php" style="font-size:15px;">BACK</a>
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
				<div style="background-color:; width:550px;">
				<form action="" method="post"><BR><BR>
					<label id="label">FIRST NAME: </label><input type="text" name="fn" id="text"><BR><BR>
					<label id="label">LAST NAME: </label><input type="text" name="ln" id="text"><BR><BR>
					<label id="label">USER NAME: </label><input type="text" name="username" id="text"><BR><BR>
					<label id="label">PASSWORD: </label><input type="password" name="pass" id="text"><BR><BR>
					<label id="label">FRE-TYPE PASSWORD: </label><input type="pass2" name="pass2" id="text"><BR><BR>
					<label id="label">BIRTHDATE: </label><input type="datetime" name="bday" id="text"><BR><BR>
					<label id="label">GENDER: </label>male<input type="radio" name="gender" value="male"> 
														female<input type="radio" name="gender" value="female"> <BR><BR>
					<label id="label">HOME ADDRESS: </label><textarea rows="3" cols="48" name="home"  id="text"></textarea><BR><BR><BR>
					<label id="label">MOBILE NUMBER: </label><input type="text" name="mobile" id="text"><BR><BR>
					<label id="label">EMAIL ADDRESS: </label><input type="text" name="email" id="text"><BR>
					<label id="label">SHIPPING ADDRESS: </label><textarea rows="3" cols="48" name="shipping"  id="text"></textarea><BR><BR>
					<p>---------------------------------------------------------------------------</p>
					<label id="label">SECRET QUESTION: </label><input type="text" name="ques" id="text"><BR><BR>
					<label id="label">SECRET ANSWER: </label><input type="password" name="ans" id="text"><BR><BR>
					<label id="label">RETYPE ANSWER: </label><input type="password" name="ans2" id="text"><BR><BR>
					<textarea rows="3" cols="10" id="text" name="qq"></textarea><BR><BR><BR><BR><BR><BR>
					<table>
						<tr>
							<td><? for($i=0;$i<50;$i++) echo "&nbsp"; ?></td>
							<td><input type="button" value="   CANCEL  "></td>
							<td><input type="submit" value="CREATE ACCOUNT"></td>
						</tr>
					</table>
				</form>
				</dv>
			</div>
		</center>
<?php

	include 'footer.php';
?>