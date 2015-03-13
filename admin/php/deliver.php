<?php
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		include"../../config.php";
		session_start();
		$sql="UPDATE Purchased SET PurchasedDelivered=1 , AdminAccountID=".$_SESSION["auth_accountID"]." WHERE PurchasedID=".DB::esc($_GET["pid"]);
		DB::query($sql);
	}
	header("Location: ../orders.php");
?>