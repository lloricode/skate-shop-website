<?php
	include"../../config.php";
	$s="DELETE FROM `received` WHERE 1";
	DB::query($s);
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
/*
	$rs=DB::query("SELECT ProductID FROM Product ORDER BY ProductID ASC");

	for($i=1;$row=$rs->fetch_object();$i++){
		$rs1=DB::query("SELECT ProductAvailabilitySmall,ProductSoldSmall FROM Product WHERE ProductID=".$row->ProductID);
		$row1=$rs1->fetch_object();
		DB::query("INSERT INTO ProductInventory(ProductID,ProductInventorySize,ProductInventoryStock,ProductInventorySold) 
			VALUES($row->ProductID,'small',$row1->ProductAvailabilitySmall,$row1->ProductSoldSmall)");


		$rs2=DB::query("SELECT ProductAvailabilityMedium,ProductSoldMedium FROM Product WHERE ProductID=".$row->ProductID);
		$row2=$rs2->fetch_object();
		DB::query("INSERT INTO ProductInventory(ProductID,ProductInventorySize,ProductInventoryStock,ProductInventorySold) 
			VALUES($row->ProductID,'medium',$row2->ProductAvailabilityMedium,$row2->ProductSoldMedium)");


		$rs3=DB::query("SELECT ProductAvailabilityLarge,ProductSoldLarge FROM Product WHERE ProductID=".$row->ProductID);
		$row3=$rs3->fetch_object();
		DB::query("INSERT INTO ProductInventory(ProductID,ProductInventorySize,ProductInventoryStock,ProductInventorySold) 
			VALUES($row->ProductID,'large',$row3->ProductAvailabilityLarge,$row3->ProductSoldLarge)");
		echo "<p>$i</p>";
	}
*/
?>
oppps! dis able muna just in case