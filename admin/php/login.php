<?php
//setcookie('auth_account', '1', time() + (86400 * 30), "/"); // 86400 = 1 day
//header("Location: index.php");

require_once('../../config.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$query = "SELECT * FROM UserAccount WHERE UserAccountUserName = '" . DB::esc($_POST['user']) . "' AND UserAccountPassword = '" . md5(DB::esc($_POST['pass'])) . "'";
	$result = DB::query($query);

	if(DB::getNumRows())
	{
		$row = $result->fetch_object();
		$rs1=DB::query("SELECT UserAccountTypeValue,UserAccountID FROM UserAccountType WHERE UserAccountID=".$row->UserAccountID);
		$row1=$rs1->fetch_object();
		if(DB::getNumRows()){
			if($row1->UserAccountTypeValue=="admin"){
				$s="SELECT UserAccountAccessValue FROM UserAccountAccess WHERE UserAccountID=".$row1->UserAccountID;
				echo $s."<br />";
				$rs2=DB::query($s);
				$row2=$rs2->fetch_object();
				$_SESSION["auth_permission"]=$row2->UserAccountAccessValue;
				$_SESSION["auth_accountID"]=$row->UserAccountID;
				$_SESSION["auth_name"]=$row->UserAccountFirstName;
				$_SESSION["auth_lname"]=$row->UserAccountLastName;
				$_SESSION["auth_img"]=$row->UserAccountImage;
				header("Location: ../index.php");
			}
			else
				echo "Invalid account.";
		}
		else
			echo "Invalid account.";
	}
	else
	{
		echo "Invalid account";
	}
}
else
{
	header("Location: ../index.php");
}
?>