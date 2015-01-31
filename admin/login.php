<?php
//setcookie('auth_account', '1', time() + (86400 * 30), "/"); // 86400 = 1 day
//header("Location: index.php");

require_once('../config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$query = "SELECT * FROM AdminAccount WHERE AdminAccountUserName = '" . DB::esc($_POST['user']) . "' AND AdminAccountPass = '" . md5(DB::esc($_POST['pass'])) . "'";
	$result = DB::query($query);

	if(DB::getNumRows() > 0)
	{	
		 $row = $result->fetch_object();
		setcookie('auth_accountID', $row->AdminAccountID, time() + 3600 , "/"); // 86400 = 1 day
		setcookie('auth_name', $row->AdminAccountName, time() + 3600 , "/"); // 86400 = 1 day
		setcookie('auth_lname', $row->AdminAccountLastName, time() + 3600 , "/"); // 86400 = 1 day
		setcookie('auth_permission', $row->AdminPermission, time() + 3600 , "/"); // 86400 = 1 day
		header("Location: index.php");
	}
	else
	{
		echo "Invalid account";
	}
}
else
{
	header("Location: index.php");
}
?>