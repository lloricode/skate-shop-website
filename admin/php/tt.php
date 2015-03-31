<?php
	include"../../config.php";
	$s="DELETE FROM `purchasedline` WHERE 1";
	DB::query($s);
	$s="SELECT * FROM `purchasedapproved` WHERE 1";
	DB::query($s);
	$s="DELETE FROM `payment` WHERE 1";
	DB::query($s);
	$s="DELETE FROM `purchasedapproved` WHERE 1";
	DB::query($s);
	$s="DELETE FROM `purchased` WHERE 1";
	DB::query($s);
	$s="DELETE FROM `cart` WHERE 1";
	DB::query($s);
	header("Location: ../index.php");
?>