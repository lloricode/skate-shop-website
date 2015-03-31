




<?php
	$docfile="mycart";
	$docc=1;
	include 'php/main_style.php';
	//include("config.php");
	$msg="";
	//$chk_item=array();


	if( !isset($_POST["pid2"]) and isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){ 
		foreach ($_POST as $value) {
			$q="SELECT CartID FROM Cart WHERE CartID=".DB::esc($value)." AND UserAccountID=".$_SESSION["authID"];
			//	echo $q;
			DB::query($q);
			if(DB::getNumRows()){
				$chk_item[]=DB::esc($value);
			}
		}
		if(sizeof($_POST)==0)
			$msg="Please select cart";
		else{
			//htmlentities(serialize($chk_item));
			$docc=0;
			//header("Location: fillcheckout.php");
		}
	}
	if($docc)
		include 'php/fresco_style.php';
	//else
		include"php/datepicker.php";
	include 'php/header.php';
	if(!isset($_SESSION['authID']))
		header("Location: login.php?".DB::esc(basename($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING']));
	include 'php/menu.php';
	
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
?>


<?php
	$shipping=$cardrr=$expirerr=$securerr="";
	$shippingrr=$card=$expire=$secure="";
	if( isset($_POST["chk"]) and isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){ $docc=3;
		//include"../config.php";
		//product to be checkout
		$pids=unserialize($_POST["pid"]);
		$pidquery="";
		$z=sizeof($pids);
		for ($i=0; $i < $z; $i++) {
			$pidquery.="c.CartID=".$pids[$i]." ";
			if(($z-1)!=$i)
				$pidquery.=" OR ";  
		}
		//echo "on line".__LINE__.": ".$pidquery."<br />";
		//checking the paying
		if(empty($_POST["card"])) $cardrr="Card number required."; else $card=DB::esc($_POST["card"]);
		if(empty($_POST["expire"])) $expirerr="Expiration date required."; else $expire=DB::esc($_POST["expire"]);
		if(empty($_POST["secure"])) $securerr="Security code required."; else $secure=DB::esc($_POST["secure"]);
		if(empty($_POST["shipping"])) $shippingrr="Shipping Address required."; else $shipping=DB::esc($_POST["shipping"]);

		if(!preg_match("/^[[0-9]{4}\-[0-9]{2}\-[0-9]{2}]*$/", $expire) and !empty($expire))
			$expirerr="invalid date format";
		else{//----------------------------checking age input
			if(!empty($_POST["expire"])){
				list($YY,$MM,$dd)=explode("-", $expire);
				if($YY>=date("Y")){
					if($MM<=date("m") and $dd<=date("d") and $YY==(date("Y")))
						$expirerr="Your card is already expired..";
				}
				else
					$expirerr="Your card is already expired.";
			}
		}

		if(!empty($_POST["shipping"]) and !preg_match("/^[a-zA-Z 0-9]*$/", $shipping))
			$shippingrr="Invalid Shipping Address";
		if(!empty($_POST["card"]) and !preg_match("/^[0-9]*$/", $card))
			$cardrr="Invalid format";
		if(!empty($_POST["secure"]) and !preg_match("/^[0-9]*$/", $secure))
			$securerr="Invalid format";// echo $securerr; 
		if($cardrr=="" and $expirerr=="" and $securerr=="" and $shippingrr==""){ 
			//session_start();
			$q="SELECT COUNT(c.CartPurchased) as a FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION["authID"];
		//	echo "on line".__LINE__.": ".$q."<br />";
			$rss=DB::query($q);
			$roww=$rss->fetch_object();
		//	echo "on line".__LINE__.": ".$roww->a."<br />";
			//echo "on line".__LINE__.": ".DB::getNumRows()."<br />";
			if(/*$_GET['purchase']=="yes" and */$roww->a>0){
				//total purchanse in all item
				$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];  
		//		echo "on line".__LINE__.": ".$sql."<br />";
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$amount=$row->total_;
				//total quantity in all purchase
				$sql="SELECT SUM(c.CartQuantity) AS total_Q FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
		//		echo "on line".__LINE__.": ".$sql."<br />";
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$quant=$row->total_Q;
				//insert purchase including 2 above
				$sqlcmd="INSERT INTO Purchased(PurchasedAmount,PurchasedQuantity,UserAccountID,PurchasedDelivered)
					VALUES($amount,$quant,".$_SESSION['authID'].",0)";
		//		echo "on line".__LINE__.": ".$sqlcmd."<br />";
				DB::query($sqlcmd);
				//slect purchaseID for purchaseLine
				$sql="SELECT PurchasedId FROM Purchased ORDER BY PurchasedId DESC LIMIT 0,1";
		//		echo "on line".__LINE__.": ".$sql."<br />";
				$rs=DB::query($sql);
				$row = $rs->fetch_object();
				$pid=$row->PurchasedId;

				
				//DB::query($sqlcmd);
				//insert payment
				$sqlcmd="INSERT INTO Payment(UserAccountID,PaymentShippingAddress,PaymentCardNumber,PaymentCardExpiration,PaymentSecureCode,PurchasedId)
					VALUES(".$_SESSION['authID'].",'$shipping',$card,'$expire',$secure,$pid)";
		//			echo "on line".__LINE__.": ".$sqlcmd."<br />";
				DB::query($sqlcmd);
				//select all item to be insert in purchaseLine WHERE purchase=0
				$sql="SELECT c.CartID,c.ProductId,c.CartQuantity,c.CartItemSize FROM Cart AS c WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
		//		echo "on line".__LINE__.": ".$sql."<br />";
				$rs=DB::query($sql);
				for($i=0;$row = $rs->fetch_object();$i++){
					$quantity=0;
					switch ($row->CartItemSize) {
						case 'small':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilitySmall,ProductSoldSmall FROM Product WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilitySmall;
							$sold=$row2->ProductSoldSmall;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilitySmall=".($avail-$quantity).", ProductSoldSmall=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							DB::query($sqlcmd);
							break;
						case 'medium':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilityMedium,ProductSoldMedium FROM Product WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilityMedium;
							$sold=$row2->ProductSoldMedium;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilityMedium=".($avail-$quantity).", ProductSoldMedium=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							DB::query($sqlcmd);
							break;
						case 'large':
							//select availabilty and sold to be update
							$sqlcmd="SELECT ProductAvailabilityLarge,ProductSoldLarge FROM Product WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							$rs2=DB::query($sqlcmd);
							$row2=$rs2->fetch_object();
							$avail=$row2->ProductAvailabilityLarge;
							$sold=$row2->ProductSoldLarge;
							$quantity=$row->CartQuantity;
							// the update
							$sqlcmd="UPDATE Product SET ProductAvailabilityLarge=".($avail-$quantity).", ProductSoldLarge=".($sold+$quantity)." WHERE ProductID=".$row->ProductId;
		//					echo "on line".__LINE__.": ".$sqlcmd."<br />";
							DB::query($sqlcmd);
							break;
					}
					//insert purchaseLine incuding purchaseID
					//$insertline="INSERT INTO PurchasedLine(PurchasedId,CartID,Quantity,Size) VALUES($pid,".$pids[$i].",".$quantity.",'".$row->CartItemSize."')";
					$insertline="INSERT INTO PurchasedLine(PurchasedId,CartID) VALUES($pid,".$pids[$i].")";
		//			echo "on line".__LINE__.": ".$insertline."<br />";
					DB::query($insertline);
					//update cart
					//DB::query("UPDATE Cart SET PurchasedID=".$pid." WHERE CartID=".$row->CartID);
				}
				//------
				//change purchase to true where false
				$sqlcmd="UPDATE Cart AS c SET c.CartPurchased=1 WHERE c.CartPurchased=0 AND $pidquery AND c.UserAccountID=".$_SESSION['authID'];
		//		echo "on line".__LINE__.": ".$sqlcmd."<br />";
				DB::query($sqlcmd);
			//	setcookie("paid","paid",time()+20,"/");
			}
		}
		else{ 
			$w = unserialize( $_POST["pid2"]);
			foreach ($w as $value) {
				$q="SELECT CartID FROM Cart WHERE CartID=".DB::esc($value)." AND UserAccountID=".$_SESSION["authID"];
			//	echo "on line".__LINE__.": ".$q;
			DB::query($q);
			if(DB::getNumRows()){
				$chk_item[]=DB::esc($value);
			}
		}
		if(sizeof($_POST)==0)
			$msg="Please select cart";
		else{
			//htmlentities(serialize($chk_item));
			$docc=0;
			//header("Location: fillcheckout.php");
		}
		}
	}
	/*else
		header("Location: index.php");*/
/*	setcookie("cardrr",$cardrr,time()+20,"/");
	setcookie("expirerr",$expirerr,time()+20,"/");
	setcookie("securerr",$securerr,time()+20,"/");
	setcookie("card",$card,time()+20,"/");
	setcookie("expire",$expire,time()+20,"/");
	setcookie("secure",$secure,time()+20,"/");*/
//	header("Location: ../mycart.php?".$_SERVER ['QUERY_STRING']);
?>

<?php
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------
//	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
//	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	//$p=$_GET['page'];
//	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
	if($docc==3){
			echo "<center><div class='main_body'><br />";
				//	setcookie("paid","",time()-10,"/");?>
					<h1>Thanks for shopping!</h1>
					</div></center>
<?php }else	if($docc){
?>
	<center>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
	<?php
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ 
				FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID 
				WHERE c.CartPurchased=0 AND c.UserAccountID=".$_SESSION['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			?>
			<div class="menu2" style="margin-top:0px;"><br />
				<span style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['authFn']." ".$_SESSION['authLn']?></span>
				<span style="font-size:25px"><b>YOUR CART</b></span>
				<span style="float:right">UNPURCHASE TOTAL: &#8369;<?php echo ($row->total_>0)?$row->total_:0?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</div>

		<div class="main_body"><br />
<div style="background:rgba(0,0,0,.1); height:1030px;">
		<?php
			/*$sqlcmd="SELECT c.CartPurchased,c.CartID,c.UserAccountID,c.CartItemSize,c.CartQuantity,
							p.ProductAttactment,p.ProductID,p.ProductName,p.ProductPrice,p.ProductBrand
								FROM Cart AS c
								JOIN Product AS p ON c.ProductID=p.ProductID
								JOIN PurchasedLine AS pl ON c.CartID=pl.CartID
								JOIN Purchased AS pp ON pp.PurchasedID=pl.PurchasedID
								WHERE c.UserAccountID=".$_SESSION['authID']." 
								GROUP BY c.ProductID,c.CartItemSize,CartPurchased,CartDateAdded
								ORDER BY c.CartPurchased";
FROM Purchased AS pur
						JOIN PurchasedLine AS pl ON pl.PurchasedId=pur.PurchasedId
						JOIN Cart AS c ON c.CartID=pl.CartID
								*/
				$sqlcmd="SELECT pro.ProductAttactment,pro.ProductID,pro.ProductName,pro.ProductPrice,pro.ProductBrand,
						c.CartPurchased,c.CartID,c.UserAccountID,c.CartItemSize,c.CartQuantity
						FROM Cart AS c
						JOIN Product AS pro ON c.ProductID=pro.ProductID
						WHERE c.UserAccountID=".$_SESSION['authID']."
						ORDER BY c.CartPurchased";
				DB::query($sqlcmd);
				echo "Result: ".DB::getNumROws()."<br />";
				$nxt=(isset($_GET["page"]))?DB::esc($_GET["page"]):1;
					$result=DB::query($sqlcmd." LIMIT ".(($nxt-1)*9).",9");
					if(DB::getNumRows() > 0){		$chk=0;		?>
						
				<!--		<?php //if(isset($_COOKIE['tmp'])){ echo $_COOKIE['tmp']; setcookie("tmp","",time()-5,"/");}?> -->
				<?php echo $msg; ?>
						<table id="table_">
						<tr class="tableRow">
						
				<?php 	for($int = 1; $row = $result->fetch_object(); $int++)
						{
							$del=0;
							if($row->CartPurchased){ 
								$rs1=DB::query("SELECT p.PurchasedDelivered,p.PurchasedID
									FROM PurchasedLine AS pl
									JOIN Purchased AS p ON pl.PurchasedID=p.PurchasedID
									WHERE pl.CartID=".$row->CartID);
								$row1=$rs1->fetch_object();
								$del=$row1->PurchasedDelivered;
							}
							 ?>
							<td class="tableData">
								<div class="mardagz" style="background: url('<?php echo  $ri->h("img/product/".$row->ProductAttactment,700); ?>');background-repeat: no-repeat; background-size: cover;">
									<div class="details">
										<a href="<?php echo  $ri->h("img/product/".$row->ProductAttactment,700); ?>" class='fresco'
											data-fresco-group="product"
											data-fresco-caption="<?php echo $int?> Name: <?php echo  $row->ProductName; ?> <br />
											Price: &#8369;<?php echo  $row->ProductPrice; ?>" >
											<div class="name tddiv">
												<span>ZOOM IMAGE</span>
											</div>
										</a>
								<?php 	if($del){
											$rs2=DB::query("SELECT PurchasedApprovedStatus FROM PurchasedApproved WHERE PurchasedID=".$row1->PurchasedID);
											$row2=$rs2->fetch_object();
											if($row2->PurchasedApprovedStatus){	?>
												<div class="purchased tddiv">
													<span>DELIVERED</span>
												</div>
								<?php		}
											else{ ?>
												<div class="purchased tddiv">
													<span>CANCELED</span>
												</div>
						<?php				}
										}
										else if($row->CartPurchased){	$chk=0;	?>
											<div class="purchased tddiv">
												<span>PENDING</span>
											</div>
								<?php 	}
										else{	$chk=1;	?>
											<a href="php/delete_cart.php?<?php echo $_SERVER ['QUERY_STRING']?>&del=<?php echo $row->CartID?>">
												<div class="cart tddiv">
													<span>REMOVE TO CART</span>
												</div>
											</a>
								<?php 	}			?>
										<br />
										<p style="font-size:13px;float:left">
											&nbsp;&nbsp;<?php echo $int?>:
											<span style="color:red;">
												 <?php echo  $row->ProductBrand?> &nbsp;</span><br />
											<b>	&nbsp; <?php echo  $row->ProductName?> &nbsp;<br />
												&nbsp; &#8369;<?php echo  $row->ProductPrice?></b>
										</p>
										<p style="color:white;float:right;font-size:13px">
											<?php echo $row->CartItemSize?>(<?php echo $row->CartQuantity?>)<br />
											<?php if($chk) echo "CHECKOUT<input type='checkbox' name='chk".$int."' value='".$row->CartID."'>";?></p>
									</div>
								</div>
							</td>
							<?php 
							if($int % 3 == 0)
								echo "</tr><tr class='tableRow'>";
						}
						echo "</tr></table>";
					}
					else
					{
						echo "No product";
					}
					?>
			</div>
			<div style="height:40px;width:900px;background-color:">
				<?php if($nxt-1>0){ ?>
				<a href="mycart.php?page=<?php echo $nxt-1; ?><?php //echo $_SERVER ['QUERY_STRING']?>">
				<div style="float:left; background-color:red; width:150px; height:40px;">
					<p>PREV</p>
				</div>
				</a>
				<?php }?>
				<a href="mycart.php?page=<?php echo $nxt+1; ?><?php //echo $_SERVER ['QUERY_STRING']?>">
				<div style="float:right; background-color:red; width:150px; height:40px;">
					<p>NEXT</p>
				</div>
				</a>
			</div>
			<div style="background-color:; height:50px; margin-top:-16px;">
				<a href="store.php?query=all<?php //echo $_SERVER ['QUERY_STRING']?>">
					<div style="float:left; background-color:#D14719; width:150px; height:50px;">
						<p>BACK TO SHOP</p>
					</div>
				</a>
				<?php

					DB::query("SELECT CartPurchased as a FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION["authID"]."'");
					if(DB::getNumRows()>0){
				?>
						
							<div >
						<!--	<input type="hidden" value="<?php// echo htmlentities(serialize($chk_item)); ?>" name="checkout">-->
								<p><input style="float:right; background-color:#990033; width:150px; height:50px;" type="submit" value="CHECKOUT"></p>
							</div>
						
				<?php		//echo "<a href='".htmlspecialchars($_SERVER["PHP_SELF"])."?".$q.$srch.$c."page=".$p."&purchase=yes'>";
					}
				?>
			</div>
		</div>
		</form>
	</center>


<?php
	}
	else{ ?>

<center>
			<div class="main_body"><br />
			<?php
						//include"config.php";
						DB::query("SELECT CartPurchased as a FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION["authID"]."'");
						if(DB::getNumRows()>0){
							$rss=DB::query("SELECT * FROM UserAccount WHERE UserAccountID=".$_SESSION["authID"]);
							$roww=$rss->fetch_object();
			?>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>?<?php echo $_SERVER ['QUERY_STRING']; ?>" method="post">
				<input type="hidden" name="pid" value="<?php echo htmlentities(serialize($chk_item)); ?>" />
				<input type="hidden" value="chk" name="chk">
					<table>
						<tr>
							<td>Email</td><td><?php echo $roww->UserAccountEmail; ?></td>
						</tr>
						<tr>
							<td>Contact</td><td><?php echo $roww->UserAccountMobile; ?></td>
						</tr>
						<tr>
							<td>Shipping Address</td><td><input type="text" name="shipping" value="<?php echo $shipping; ?>" ></td>
							<td><span id="err"><?php echo $shippingrr; ?></span></td>
						</tr>
						<tr>
							<td>Credit Card Number:</td><td><input type="text" name="card" value="<?php echo $card; ?>" ></td>
							<td><span id="err"><?php echo $cardrr; ?></span></td>
						</tr>
						<tr>
							<td>Expiration Date:</td><td><input type="date" id="datepicker" name="expire" value="<?php echo $expire; ?>" ></td>
							<td><span id="err"><?php echo $expirerr; ?></span></td>
						</tr>
						<tr>
							<td>Card Security Code:</td><td><input type="text" name="secure" value="<?php echo $secure; ?>" ></td>
							<td><span id="err"><?php echo $securerr; ?></span></td>
						</tr>
						<tr>
							<td></td><td><input type="submit" value="CHECKOUT"></td>
						</tr>
					</table>
					<br />
			<?php
				//$chk_item=array();
				//$chk_item=unserialize($chk_item);
			?>
			<input type="hidden" name="pid2" value="<?php echo htmlentities(serialize($chk_item)); ?>">
<table><tr>

			<?php $total=0;
				for ($i=0;$i<sizeof($chk_item);$i++) {
					$rs=DB::query("SELECT c.*,p.ProductAttactment,p.ProductName,p.ProductPrice,(c.CartQuantity*p.ProductPrice) AS total,
						(p.ProductAvailabilitySmall+p.ProductAvailabilityMedium+p.ProductAvailabilityLarge) AS alltotal,
						(CASE c.CartItemSize WHEN 'small' THEN p.ProductAvailabilitySmall 
											WHEN 'medium' THEN p.ProductAvailabilityMedium
											WHEN 'large' THEN p.ProductAvailabilityLarge END ) AS stock 
					FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartID=".$chk_item[$i]);
					$row=$rs->fetch_object();
					$total+=$row->total;
					?><td> <img src="<?php echo  $ri->wh("img/product/".$row->ProductAttactment,100,100); ?>"/> <?php echo "<p>".$row->ProductName."<br />"
					.$row->CartItemSize."(".$row->CartQuantity.")".
					((0==$row->alltotal)?"<span style='color:red'>out of stock</span>":(($row->CartQuantity>$row->stock)?"only<span style='color:red'>".$row->stock."</span>":""))
					."<br />&#8369;".$row->ProductPrice."</p>" ?></td><?php

				}

			?>
</tr></table><?php echo "Total: ".$total; ?>
				</form>
		<?php 			}
						else
							header("Location: index.php");
				 ?>
			</div>
		</center>




<?php

	}
	include 'php/footer.php';
?>