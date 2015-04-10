<!--   -->
<!--   -->
<!-- develop by Lloric Garcia  -->
<!--  design by Megan Torlao -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<!--   -->
<?php session_start();
$tmp_dir="../";
include"../config.php";?>
<!DOCTYPE html>
<html>
	<head>
		<title>Skate Shop Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="../img/icon.png" rel="shortcut icon" type="image/x-icon" />
		<?php
			if(isset($s))
				include"../php/datepicker.php"; ?>
	</head>
	<body>
	<div class="d">
	<?php if(isset($_SESSION['auth_accountID'])) {?>
	<img src="<?php echo $ri->h("../img/UserImage/".$_SESSION['auth_img'],28);?>" alt="<?php echo $_SESSION['auth_name']." ".$_SESSION['auth_lname']; ?>" >
<?php }
	if(isset($_SESSION['auth_accountID']))
		echo "Hello!, ".$_SESSION['auth_name']."! &nbsp;&nbsp;&nbsp;<a href='php/logout.php'><button class='btn'>Logout</button></a><br />";
	

?>
	</div>