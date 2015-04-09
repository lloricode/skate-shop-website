<?php
	$docfile="profile";
	include 'php/main_style.php';
	if(!isset($_SESSION['authID']))
		header("Location: index.php");
	include 'php/header.php';
	include 'php/menu.php';
	require_once('config.php');
	$rs=DB::query("SELECT *  FROM UserAccount WHERE UserAccountID=".$_SESSION['authID']);
	$row=$rs->fetch_object();
?>
		
		<center>
			<div class="main_body">
				<div class="primary" style="  background-image: url('img/UserImage/<?php echo $_SESSION['authImg']?>');background-repeat: no-repeat; background-size: cover;">
				</div>
				<br /><br /><br /><br /><br /><br />
				<table>
					<tr>
						<th><?php echo $row->UserAccountFirstName."   ".$row->UserAccountLastName?></th>
					</tr>
					<tr>
						<th><?php echo $row->UserAccountBD?></th>
					</tr>
					<tr>
						<th><?php echo $row->UserAccountGender?></th>
					</tr>
					<tr>
						<th><?php echo "Home: ".$row->UserAccountHomeAddress?></th>
					</tr>
					<tr>
						<th><?php echo $row->UserAccountMobile?></th>
					</tr>
					<tr>
						<th><?php echo $row->UserAccountEmail?></th>
					</tr>
				</table>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>