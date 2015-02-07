<?php
	$docfile="profile";
	if(!isset($_COOKIE['authID']))
		header("Location: index.php");
	include 'php/main_style.php';
	include 'php/header.php';
	include 'php/menu.php';
	require_once('config.php');
	$rs=DB::query("SELECT *  FROM UserAccount WHERE UserAccountID=".$_COOKIE['authID']);
	$row=$rs->fetch_object();
?>
		
		<center>
			<div class="main_body">
				<div class="primary" style="  background-image: url('img/UserImage/<?=$_COOKIE['authImg']?>');background-repeat: no-repeat; background-size: cover;">
				</div>
				<BR><BR><BR><BR><BR><BR>
				<table>
					<tr>
						<th><?=$row->UserAccountFisrtName."   ".$row->UserAccountLastName?></th>
					</tr>
					<tr>
						<th><?=$row->UserAccountBM." ".$row->UserAccountBD.", ".$row->UserAccountBY?></th>
					</tr>
					<tr>
						<th><?=$row->UserAccountGender?></th>
					</tr>
					<tr>
						<th><?="Home: ".$row->UserAccountHomeAddress?></th>
					</tr>
					<tr>
						<th><?=$row->UserAccountMobile?></th>
					</tr>
					<tr>
						<th><?=$row->UserAccountEmail?></th>
					</tr>
					<tr>
						<th><?="Shpping Address: ".$row->UserAccountShipping?></th>
					</tr>
				</table>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>