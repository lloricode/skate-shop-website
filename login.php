<?php
	/**
	 * @author Lloric Garcia
	 * @copyright 2015
	 */
	include("config.php");
?>
<?php
	//session_start();
	if ( isset($_GET) and $_SERVER["REQUEST_METHOD"]=="POST") {
		$usercode=addslashes($_POST['user']);
		$passcode=addslashes(md5($_POST['pass']));
		
		$sql="SELECT UserAccountID,UserAccountFisrtName,UserAccountLastName,UserAccountImage FROM UserAccount WHERE UserAccountUserName='$usercode' AND UserAccountPassword='$passcode'";

		//if result matched usercode and passcode, table must be 1 row.
		$rs=DB::query($sql);
		
		//if (DB::getNumRows()>0) {
		if (DB::getNumRows()>0) {
			$row=$rs->fetch_object();
			setcookie("authFn",$row->UserAccountFisrtName,time()+3600,"/");
			setcookie("authLn",$row->UserAccountLastName,time()+3600,"/");
			setcookie("authImg",$row->UserAccountImage,time()+3600,"/");
			setcookie("authID",$row->UserAccountID,time()+3600,"/");
			unset($error);
			header("Location: index.php");
		}
		else
			$error= "Your Login Name or Pasword is invalid.<BR>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop | Log In</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/Skateboard-2-512.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu" >
			    	<table >
		                <tr style="font-size:35px; ">
		                    <td >
		                    	<div><br>WELCOME TO SKATESHOP</div> 
		                    </td>
		            </table>
				</div>
			</center>
		</div>
		<center>
			<div style=" height: 800px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="login.php" method="post">
						<BR><BR><BR><BR><BR>
						<?php if(isset($error)) echo "$error"; ?>
						E-MAIL ADDRESS/USERNAME:<? for($i=0;$i<14;$i++) echo "&nbsp"; ?><br>
						<input type="text" name="user" style="width:300px; height:22px;"><BR><BR><BR>
						PASSWORD:<? for($i=0;$i<42;$i++) echo "&nbsp"; ?><br>
						<input type="password" name="pass" style="width:300px; height:22px;"><BR>
						<? for($i=0;$i<10;$i++) echo "<BR>"; ?>
						<table>
							<tr>
								<td >
									<a href="signup.php">
										<input type="button" name="signup" value="SIGN UP" style="background-color:orange">
									</a>
								</td>
								<td><? for($i=0;$i<50;$i++) echo "&nbsp"; ?></td>
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
	include 'footer.php';
?>