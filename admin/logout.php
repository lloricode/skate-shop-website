<?php
		setcookie('auth_accountID',"", time() - (3600 * 30), "/"); // 86400 = 1 day
		setcookie('auth_name', "", time() - (3600 * 30), "/"); // 86400 = 1 day
		setcookie('auth_lname', "", time() - (3600 * 30), "/"); // 86400 = 1 day
		setcookie('auth_permission', "", time() -(3600 * 30), "/"); // 86400 = 1 day
	header("Location: index.php");
?>