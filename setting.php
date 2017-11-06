<?php
	$docfile="setting";
	include 'php/main_style.php';
	include 'php/header.php';
	include 'php/menu.php';
?>
		<center>
			<div class="main_body" style="margin-top:1px;">
				<br /><br />
				<?php
					if(isset($_SESSION['authFn'])){ ?>
						<p>Hello! <?php echo $_SESSION['authFn']." ".$_SESSION['authLn']?>!</p>
						<?php
						if(isset($_SESSION['tmp']))
							 echo $_SESSION['tmp']."<br />";
						echo "<img src='./img/UserImage/".$_SESSION['authImg']."' alt='' height='300' >";
						echo "<form action='php/updateimage.php' method='post' enctype='multipart/form-data'>
							<label>Browse image</label><input type='file' name='imgfile'>
							<input type='submit' value='update image'>
						</form>"; ?>
						<br /><br /><hr /><br />
						<h3>Personal Information</h3>
						<?php
							$rs=DB::query("SELECT * FROM UserAccount WHERE UserAccountID=".$_SESSION["authID"]);
							$row=$rs->fetch_object();
							$fn=$row->UserAccountFirstName;
							$ln=$row->UserAccountLastName;
							$bd=$row->UserAccountBD;
							$gender=$row->UserAccountGender;
							$addr=$row->UserAccountHomeAddress;
							$cont=$row->UserAccountMobile;
							$email=$row->UserAccountEmail;
							$username=$row->UserAccountUserName;
							$quest=$row->UserAccountSecretQuestion;
							$ok1=$ok2=$ok3=$fnrr=$lnrr=$bdrr=$genderrr=$addrrr=$contrr=$emailrr="";

							$methods="";
							if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
								$methods=$_POST["methods"];
							}

							if(isset($_POST) and  $methods=="1" and $_SERVER["REQUEST_METHOD"]=="POST"){
								if(empty($_POST['fn'])) $fnrr="First Name is required"; else $fn=DB::esc($_POST['fn']);
								if(empty($_POST['ln'])) $lnrr="Last Name is required"; else $ln=DB::esc($_POST['ln']);
								if(empty($_POST['bd'])) $bdrr="Birthday is required"; else $bd=DB::esc($_POST['bd']);
								if(empty($_POST['addr'])) $addrrr="Home Address is required"; else $addr=DB::esc($_POST['addr']);
								if(empty($_POST['cont'])) $contrr="Mobile is required"; else $cont=DB::esc($_POST['cont']);
								if(empty($_POST['email'])) $emailrr="Email is required"; else $email=DB::esc($_POST['email']);
								if(isset($_POST['gender'])) $gender=$_POST['gender']; else $gender="";
								if(empty($gender)) $genderrr="Gender is required";

								if (!preg_match("/^[a-zA-Z ]*$/",$fn))
		  							$fnrr = "Only letters and white space allowed";
		  						if (!preg_match("/^[a-zA-Z ]*$/",$ln))
		  							$lnrr = "Only letters and white space allowed";
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
								if(!preg_match("/^[0-9]*$/", $cont))
									$contrr="Invalid mobile number";
								if(!filter_var($email, FILTER_VALIDATE_EMAIL) and !empty($_POST['email']) )
									$emailrr="Invalid email format";
								else{
									$sqlcmd="SELECT 1 From UserAccount WHERE UserAccountID!=".$_SESSION["authID"]." AND UserAccountEmail='$email'";//echo $sqlcmd."  ".DB::getNumRows();
									DB::query($sqlcmd);
									if(DB::getNumRows())
										$emailrr="Email already exist.";
								}
								$valid = array("male","female");
								if(!in_array($gender, $valid) and $gender!=="") //if user modify from inspect in browser
									$genderrr="this is for human.";
								if($fnrr==""&&$lnrr==""&&$bdrr==""&&$genderrr==""&&$addrrr==""&&$contrr==""&&$emailrr==""){
									$sql="UPDATE UserAccount SET UserAccountFirstName='$fn', UserAccountLastName='$ln',
									 	UserAccountBD='$bd', UserAccountGender='$gender', UserAccountHomeAddress='$addr',
									 	UserAccountMobile='$cont', UserAccountEmail='$email' 
										WHERE UserAccountID=".$_SESSION["authID"];
									DB::query($sql);
									$_SESSION["authFn"]=$fn;
									$_SESSION["authLn"]=$ln;
									$ok1="Update Successfully!";
								}
							}
						?>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<input type="hidden" name="methods" value="1">
							<?php echo $ok1; ?>
						<table>
							<tr>
								<td>First Name</td>
								<td><input type="text" name="fn" value="<?php echo $fn; ?>" required/></td>
								<td><span id="err"><?php echo $fnrr;?></span></td>
							<tr>
								<td>Last Name</td>
								<td><input type="text" name="ln" value="<?php echo $ln; ?>" required/></td>
								<td><span id="err"><?php  echo $lnrr;?></span></td>
							<tr>
								<td>Birthday</td>
								<td><input type="date" id="datepicker"   name="bd" value="<?php echo $bd; ?>" required/></td>
								<td><span id="err"><?php  echo $bdrr;?></span></td>
							<tr>
								<td>Gender</td>
								<td>
									<input type="radio" name="gender" <?php  if($gender=="male" ) echo "checked"; ?> value="male"> male
									<input type="radio" name="gender" <?php if($gender=="female" ) echo "checked"; ?>  value="female">female
								</td>
								<td><span id="err"><?php  echo $genderrr;?></span></td>
							<tr>
								<td>Home Address</td>
								<td><input type="text" name="addr" value="<?php echo $addr; ?>" required/></td>
								<td><span id="err"><?php  echo $addrrr;?></span></td>
							<tr>
								<td>Mobile</td>
								<td><input type="text" name="cont" value="<?php echo $cont; ?>" required/></td>
								<td><span id="err"><?php  echo $contrr;?></span></td>
							<tr>
								<td>Email</td>
								<td><input type="text" name="email" value="<?php echo $email; ?>" required/></td>
								<td><span id="err"><?php echo $emailrr;?></span></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit"  value="Update Info"></td>
							</tr>
						</table>
						</form>

				<br /><br /><hr />
				<br /><h3>Security</h3>
						<table>
							<tr>
								<?php $newpass=$usernamerr=$oldpassrr=$newpassrr="";$username=$row->UserAccountUserName;
									if(isset($_POST) and $methods=="2" and $_SERVER["REQUEST_METHOD"]=="POST"){
										$sql="SELECT UserAccountUserName FROM UserAccount
											WHERE UserAccountID!=".$_SESSION["authID"]." AND UserAccountUserName='".DB::esc($_POST["username"])."'";
										DB::query($sql);
										if(empty($_POST['username']))
											$usernamerr="UserName is required.";
										else if(DB::getNumRows())
											$usernamerr="user name exist.";
										else
											$username=DB::esc($_POST['username']);
										if(empty($_POST['oldpass']))
											$oldpassrr="Current Password is required";
										else if($row->UserAccountPassword!=md5($_POST["oldpass"]))
											$oldpassrr="incorect password.";
										if(empty($_POST['newpass1']))
											$newpassrr="New Password is required";
										else if($_POST["newpass1"]!=$_POST["newpass2"])
											$newpassrr="password not match.";
										else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $_POST['newpass1']))
											$newpassrr="Must contain at least 1 number or 1 letter and minimum of 8";
										else
											$newpass=DB::esc($_POST['newpass1']);
										if($usernamerr=="" &&$oldpassrr==""&&$newpassrr==""){
											DB::query("UPDATE UserAccount SET UserAccountUserName='".$username."', UserAccountPassword='".md5($newpass)."' WHERE UserAccountID=".$_SESSION["authID"]);
											$ok2="Update Successfully!";
										}
									}
								?>

								<td><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<input type="hidden" name="methods" value="2">
										<table>
											<tr>
												<td></td>
												<td><?php echo $ok2; ?></td>
											</tr>
											<tr>
												<td>Username</td>
												<td><input type="text" name="username" value="<?php echo $username; ?>" required/></td>
												<td><span id="err"><?php echo $usernamerr;?></span></td>
											</tr>
											<tr>
												<td>Type Current Password</td>
												<td><input type="password" name="oldpass" required/></td>
												<td><span id="err"><?php echo $oldpassrr;?></span></td>
											</tr>
											<tr>
												<td>New Password</td>
												<td><input type="password" name="newpass1" required/></td>
												<td><span id="err"><?php echo $newpassrr;?></span></td>
											</tr>
											<tr>
												<td>Retype New Password</td>
												<td><input type="password" name="newpass2" required/></td>
											</tr>
											<tr>
												<td></td>
												<td><input type="submit" value="Update Username/Password"></td>
											</tr>
										</table></form>

								</td>
								<?php $questrr=$passrr=$ansrr="";
									if(isset($_POST) and  $methods=="3" and $_SERVER["REQUEST_METHOD"]=="POST"){
										if(empty($_POST['quest']))
											$questrr="Secret Question is required";
										else
											$quest=DB::esc($_POST["quest"]);
										if(empty($_POST['pass']))
											$oldpassrr="Current Password is required";
										else if($row->UserAccountPassword!=md5($_POST["pass"]))
											$passrr="incorect password.";
										if(empty($_POST['ans1']))
											$ansrr="New Answer is required";
										else if($_POST["ans1"]!=$_POST["ans2"])
											$ansrr="Answer not match.";
										else
											$ans1=DB::esc($_POST['ans1']);
										if($usernamerr=="" &&$passrr==""&&$ansrr==""){
											DB::query("UPDATE UserAccount SET UserAccountSecretQuestion='".$quest."', UserAccountAnswer='".md5($ans1)."' WHERE UserAccountID=".$_SESSION["authID"]);
											$ok3="Update Successfully!";
										}
									}
								?>
								<td><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<input type="hidden" name="methods" value="3">
										<table>
											<tr>
												<td></td>
												<td><?php echo $ok3; ?></td>
											</tr>
											<tr>
												<td>New Secret Question</td>
												<td><input type="text" name="quest" value="<?php echo $quest; ?>" required/></td>
												<td><span id="err"><?php echo $questrr;?></span></td>
											</tr>
											<tr>
												<td>Type Current Password</td>
												<td><input type="password" name="pass" required/></td>
												<td><span id="err"><?php echo $passrr;?></span></td>
											</tr>
											<tr>
												<td>New Secret Answer</td>
												<td><input type="password" name="ans1" required/></td>
												<td><span id="err"><?php echo $ansrr;?></span></td>
											</tr>
											<tr>
												<td>Retype New Secret Answer</td>
												<td><input type="password" name="ans2" required/></td>
											</tr>
											<tr>
												<td></td>
												<td><input type="submit" value="Update Recovery"></td>
											</tr>
										</table></form>
								</td>
							</tr>
						</table>
						<?php
					}
					else
						header("Location: index.php")
				?>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>