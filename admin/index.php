<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */


?>


<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
	<?php 
		if(!isset($_COOKIE['auth_account']))
		{
			?>
			<form method="POST" action="login.php">
				<input type="text" placeholder="Username" name="user" />
				<input type="password" placeholder="Password" name="pass" />
				<input type="submit" value="Login" />
			</form>
			<?php
		}
		else
		{?>
		Welcome <?= $_COOKIE['auth_name']; ?>
		<a href="logout.php"><button>Logout</button></a><BR>
			<a href="view_accounts.php"><button>view accounts</button></a><BR>
			<a href="view_product.php"><button>view product</button></a>

			<?
		}
	?>
	</body>
</html>
