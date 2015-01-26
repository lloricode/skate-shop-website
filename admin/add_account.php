<?php
	if($_COOKIE['auth_permission']=="editor")
		header("Location: view_accounts.php");
	include 'header.php';
	include '../config.php';

	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST"){
		$fn=$ln=$un=$pass=$per="";
		$fnrr=$lnrr=$unrr=$passrr=$perrr="";
		$valid = array( "admin","editor" );
		
		//check if empty
		if(empty($_POST['fn'])) $fnrr="first name required"; else $fn=$_POST['fn']; 
		if(empty($_POST['ln'])) $lnrr="last name required"; else $ln=$_POST['ln']; 
		if(empty($_POST['un'])) $unrr="username required"; else $un=$_POST['un']; 
		if(empty($_POST['pass'])) $passrr="password required"; else $pass=$_POST['pass']; 
		if(empty($_POST['per'])) $perrr="permission required"; else $per=$_POST['per']; 

		//check/filtering the input
		function check_data($data){
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
		$fn=check_data($fn);
		$ln=check_data($ln);
		$un=check_data($un);
		$pass=check_data($pass);
		$per=check_data($per);

		//validation
		if(!in_array($per, $valid) and $per!=="") //if user modify from inspect in browser
			$perrr="this is for human.";

		if (!preg_match("/^[a-zA-Z ]*$/",$fn)) 
		  	$fnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z ]*$/",$ln)) 
		  	$lnrr = "Only letters and white space allowed";
		if (!preg_match("/^[a-zA-Z0-9_]*$/",$un)) 
		  	$unrr = "Only letters, 0-9 and _ allowed";

		//check if password and secret answer is match
		$pass2=check_data($_POST['pass2']);
		if($pass2!=$pass)
			$passrr="Password mismatch";

		if($fnrr==""&&$lnrr==""&&$unrr==""&&$passrr==""&&$perrr==""){
			$sqlcmd="INSERT INTO AdminAccount(AdminAccountUserName,AdminAccountName,AdminAccountLastName,AdminAccountPass,permission) 
			VALUES('$un','$fn','$ln','".md5($pass)."','$per')";
			DB::query($sqlcmd);
			$ok="ok!!";
		}
	}

?>





<?php
	if(!isset($fn))$fn=$ln=$un="";
?>
		<div class="d ad">
		<a href="view_accounts.php"><button>back</button></a>
		<?	if(!isset($ok)){	?>
				<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<table>
						<tr>
							<td><label id="lbl">FIRST NAME: </label></td>
							<td><input id="text" type="text" placeholder="first name" name="fn" value="<?=$fn?>"></td>
							<td><span id="err"><? if(isset($fnrr)) echo $fnrr?></span></td>
						</tr>
						<tr>
							<td><label id="lbl">LAST NAME: </label></td>
							<td><input id="text" type="text" placeholder="last name" name="ln" value="<?=$ln?>"></td>
							<td><span id="err"><? if(isset($lnrr)) echo $lnrr?></span></td>
						</tr>
						<tr>
							<td><label id="lbl">USERNAME: </label></td>
							<td><input id="text" type="text" placeholder="username" name="un" value="<?=$un?>"></td>
							<td><span id="err"><? if(isset($unrr)) echo $unrr?></span></td>
						</tr>
						<tr>
							<td><label id="lbl">PASSWORD: </label></td>
							<td><input id="text" type="password" placeholder="password" name="pass"></td>
							<td><span id="err"><? if(isset($passrr)) echo $passrr?></span></td>
						</tr>
						<tr>
							<td><label id="lbl">RE-TYPE PASSWORD: </label></td>
							<td><input id="text" type="password" placeholder="re-type password" name="pass2"></td>
							<td></td>
						</tr>
						<tr>
							<td><label>PERMISSION:</label></td>
							<td>
								<input type="radio" name="per" <?php if(isset($_POST['per']) && $per=="admin" ) echo "checked"; ?> value="admin"> admin
								<input type="radio" name="per" <?php if(isset($_POST['per']) && $per=="editor" ) echo "checked"; ?> value="editor"> editor
							</td>
							<td><span id="err"><? if(isset($perrr)) echo $perrr?></span></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="add account"></td>
						</tr>
					</table>
				</form>
	<?		}
			else{		?>
				<p>Register succesfully!</p>
				<table>
					<tr>
						<td>FULL NAME: </td>
						<td><?=$fn." ".$ln?></td>
					</tr>
					<tr>
						<td>USERNAME: </td>
						<td><?=$un?> </td>
					</tr>
					<tr>
						<td>PASSWORD: </td>
						<td>protected</td>
					</tr>
					<tr>
						<td>PERMISSION: </td>
						<td><?=$per?> </td>
					</tr>
				</table>
		<?	}
			?>

		</div>
	</body>
</html>
	
