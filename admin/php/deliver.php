<?php
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		include"../../config.php";
		session_start();
		$sql="UPDATE Purchased SET PurchasedDelivered=1 WHERE PurchasedID=".DB::esc($_GET["pid"]);
		DB::query($sql);
		$sql="INSERT INTO PurchasedApproved(PurchasedID,UserAccountID,PurchasedApprovedStatus) VALUES(".DB::esc($_GET["pid"]).",".$_SESSION["auth_accountID"].",".DB::esc($_POST["approve"]).")";
		DB::query($sql);
	}
	header("Location: ../orders.php");
?>