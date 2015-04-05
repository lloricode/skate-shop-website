<?php
	if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		session_start();
		include"../../config.php";
		$tmp=($_POST["rr"]=="y")?1:0;
		//$sql="INSERT INTO Received(PurchasedApprovedID,UserAccountID,ReceivedStatus) VALUES('".$_POST["pi"]."','".$_SESSION["auth_accountID"]."','$tmp')";
		$sql="INSERT INTO Received(PurchasedApprovedID,UserAccountID,ReceivedStatus) VALUES('".$_POST["pi"]."','".$_SESSION["auth_accountID"]."','$tmp')";
		echo "$sql<br />";
		DB::query($sql);
		header("Location: ../delivered.php");
	}
?>