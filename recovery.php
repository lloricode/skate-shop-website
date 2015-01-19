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

		if(filter_var($usercode, FILTER_VALIDATE_EMAIL)){//check if email is use bu user
			$tmp="UserAccountEmail";
			list($usercode,$r)=explode(".", $usercode);
		}
		else
			$tmp="UserAccountUserName";

		$sql="SELECT UserAccountID,UserAccountFisrtName,UserAccountLastName,UserAccountImage FROM UserAccount WHERE $tmp='$usercode' AND UserAccountPassword='$passcode'";
		
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
			$error= "Your Login UserName/Email or Pasword is invalid.<BR>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop | Recovery</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="img/Skateboard-2-512.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu" >
			    	<table >
		                <tr style="font-size:35px; ">
							<td>
								<a href="index.php" style="font-size:15px;">
									HOME<?php for($i=0;$i<20;$i++) echo "&nbsp"; ?>
								</a>
							</td>
		                    <td >
		                    	<div><br>WELCOME TO SKATESHOP</div> 
		                    </td>
		                    <td>
		                    	<a href="index.php" style="font-size:15px;">
									<?php for($i=0;$i<28;$i++) echo "&nbsp"; ?>
								</a>
							</td>
		            </table>
				</div>
			</center>
		</div>
		<center>
			<div style=" height: 800px; width: 900px; background-image: url('img/bglog.jpg');">
				<div id="getlogin">
					<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<BR><BR><BR><BR><BR>
						
						<table>
							<tr>
								<td >
									<a href="login.php">
										<input type="button" name="signup" value="BACK TO LOGIN" style="background-color:orange">
									</a>
								</td>
								<td><? for($i=0;$i<50;$i++) echo "&nbsp"; ?></td>
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
	include 'footer.php';
?>