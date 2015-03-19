<?php
	if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		include"../config.php";
		//product to be checkout
		$pids=unserialize($_POST["pid"]);
		$pidquery="";
		$z=sizeof($pids);
		for ($i=0; $i < $z; $i++) {
			$pidquery.="c.CartID=".$pids[$i]." ";
			if(($z-1)!=$i)
				$pidquery.="AND ";
		}
		echo $pidquery;
		//checking the paying
		$card=$expire=$secure="";
		$cardrr=$expirerr=$securerr="";
		if(empty($_POST["card"])) $cardrr="Card number required."; else $card=DB::esc($_POST["card"]);
		if(empty($_POST["expire"])) $expirerr="Expiration date required."; else $expire=DB::esc($_POST["expire"]);
		if(empty($_POST["secure"])) $securerr="Security code required."; else $secure=DB::esc($_POST["secure"]);

		if(!empty($_POST["card"]) and !preg_match("/^[0-9]*$/", $card))
			$cardrr="Invalid format";
		if(!empty($_POST["secure"]) and !preg_match("/^[0-9]*$/", $secure))
			$securerr="Invalid format";

		if($cardrr=="" and $expirerr=="" and $securerr==""){
			session_start();
			DB::query("SELECT c.CartPurchased as a FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID='".$_SESSION["authID"]."'");
			if(/*$_GET['purchase']=="yes" and */DB::getNumRows()>0){
				//total purchanse in all item
				$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND $pidquery AND UserAccountID=".$_SESSION['authID'];  
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$amount=$row->total_;
				//total quantity in all purchase
				$sql="SELECT SUM(c.CartQuantity) AS total_Q FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$quant=$row->total_Q;
				//insert purchase including 2 above
				$sqlcmd="INSERT INTO Purchased(PurchasedAmount,PurchasedQuantity,UserAccountID,PurchasedDelivered,card_number,card_expiration,secure_code)
					VALUES($amount,$quant,".$_SESSION['authID'].",0,'$card','$expire','$secure')";
				DB::query($sqlcmd);
				//slect purchaseID for purchaseLine
				$sql="SELECT PurchasedId FROM Purchased ORDER BY PurchasedId DESC LIMIT 0,1";
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$pid=$row->PurchasedId;
				//select all item to be insert in purchaseLine WHERE purchase=0
				$sql="SELECT c.ProductId,c.CartQuantity,c.CartItemSize FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
				$rs=DB::query($sql);
				while($row = $rs->fetch_object()){
					$quantity=0;
					switch ($row->CartItemSize) {
						case 'small':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilitySmall,ProductSoldSmall FROM Product WHERE ProductID=".$row->ProductId;
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilitySmall;
							$sold=$row2->ProductSoldSmall;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilitySmall=".($avail-$quantity).", ProductSoldSmall=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
							DB::query($sqlcmd);
							break;
						case 'medium':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilityMedium,ProductSoldMedium FROM Product WHERE ProductID=".$row->ProductId;
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilityMedium;
							$sold=$row2->ProductSoldMedium;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilityMedium=".($avail-$quantity).", ProductSoldMedium=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
							DB::query($sqlcmd);
							break;
						case 'large':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilityLarge,ProductSoldLarge FROM Product WHERE ProductID=".$row->ProductId;
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilityLarge;
							$sold=$row2->ProductSoldLarge;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilityLarge=".($avail-$quantity).", ProductSoldLarge=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
							DB::query($sqlcmd);
							break;
					}
					//insert purchaseLine incuding purchaseID
					$insertline="INSERT INTO PurchasedLine(PurchasedId,ProductID,Quantity,Size) VALUES($pid,".$row->ProductId.",".$quantity.",'".$row->CartItemSize."')";
					DB::query($insertline);
				}
				//------
				//change purchase to true where false
				$sqlcmd="UPDATE Cart AS c SET c.CartPurchased=1 WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
				DB::query($sqlcmd);
				setcookie("paid","paid",time()+20,"/");
			}
		}
	}
	else
		header("Location: index.php");
	setcookie("cardrr",$cardrr,time()+20,"/");
	setcookie("expirerr",$expirerr,time()+20,"/");
	setcookie("securerr",$securerr,time()+20,"/");
	setcookie("card",$card,time()+20,"/");
	setcookie("expire",$expire,time()+20,"/");
	setcookie("secure",$secure,time()+20,"/");
	header("Location: ../mycart.php?".$_SERVER ['QUERY_STRING']);
?>