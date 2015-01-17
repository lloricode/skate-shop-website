<?php
	setcookie("auth_account", "", time() - 3200, "/"); //
	setcookie("auth_name", "", time() - 3200, "/"); //
	header("Location: index.php");
?>