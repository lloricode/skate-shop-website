<?php
	$docfile="cart";
	if(!isset($_COOKIE['authID'])) header("Location: login.php");
	include 'php/main_style.php';
	include 'php/fresco_style.php';
	include 'php/header.php';
	include 'php/menu.php';
	include("config.php");

	if(isset($_GET['del']) and $_SERVER["REQUEST_METHOD"]=="GET"){
		$id=trim(stripcslashes(htmlspecialchars($_GET['del'])));
		$sqlcmd="DELETE FROM Cart Where CartID=$id";
		DB::query($sqlcmd);
	}
	if(isset($_GET['purchase']) and $_SERVER["REQUEST_METHOD"]=="GET"){
		if($_GET['purchase']=="yes"){
			//total purchanse in all item
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$amount=$row->total_;
			//total quantity in all purchase
			$sql="SELECT SUM(CartQuantity) AS total_Q FROM Cart WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$quant=$row->total_Q;
			//insert purchase including 2 above
			$sqlcmd="INSERT INTO Purchased(PurchasedAmount,PurchasedQuantity,UserAccountID,PurchasedDelivered) VALUES($amount,$quant,".$_COOKIE['authID'].",0)";
			DB::query($sqlcmd);
			//slect purchaseID for purchaseLine
			$sql="SELECT PurchasedId FROM Purchased ORDER BY PurchasedId DESC LIMIT 0,1";
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$pid=$row->PurchasedId;
			//select all item to be insert in purchaseLine WHERE purchase=0
			$sql="SELECT ProductId,CartQuantity,CartItemSize FROM Cart WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID']; 
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
			$sqlcmd="UPDATE Cart SET CartPurchased=1 WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID']; 
			DB::query($sqlcmd);
		}
	}

	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
?>
	<center><?php
		if(isset($_GET['file'])){ ?>
			<div  class="menu2" style="margin-top:0px;">
				add cart
			</div>
	<?php }
		else{
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			?>
			<div class="menu2" style="margin-top:0px;"><br />
				<span style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_COOKIE['authFn']." ".$_COOKIE['authLn']?></span>
				<span style="font-size:25px"><b>YOUR CART</b></span>
				<span style="float:right">UNPURCHASE TOTAL: &#8369;<?php echo ($row->total_>0)?$row->total_:0?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</div>
	<?php }
	?>
		<div class="main_body"><br />
<div style="background:rgba(0,0,0,.1); height:1030px;">
		<?php 	
				if(isset($_GET['file'])){
					$sqlcmd="SELECT * FROM Product WHERE ProductID='".htmlspecialchars(trim(stripcslashes($_GET['file']))) ."'";
					$rs=DB::query($sqlcmd);
					if($row=$rs->fetch_object()){

						?>
						
						<?php if(isset($_COOKIE['tmp'])){ echo $_COOKIE['tmp']; setcookie("tmp","",time()-5,"/");}?>
						<form action="php/add_cart.php?<?php echo $q?><?php echo $srch?><?php echo $c?>page=<?php echo $p?>&file=<?php echo $_GET['file']?>" method="post" >
							<table>
								<tr>
									<td rowspan="8"><img src="img/product/<?php echo $row->ProductAttactment?>" width="300" ></td>
									
								</tr>
								<tr>
									<td><h2><?php echo $row->ProductName?></h2></td>
									<?php //security later?>
									<?php setcookie("prodID",$row->ProductID,time()+20,"/");?>
								</tr>
								<tr>
									<td>Brand: <b><?php echo $row->ProductBrand?></b></td>
								</tr>
								<tr>
									<td>Price: &#8369;<b><?php echo $row->ProductPrice?></b></td>
								</tr>
								<tr>
									<td>Gender: <b><?php echo $row->ProductGender?></b></td>
								</tr>
								<tr>
									<td>
										<table>
											<tr>
												<td colspan="2">
													<span class="err"><?php if(isset($_COOKIE['sizerr'])){ echo $_COOKIE['sizerr']."<br />"; setcookie("sizerr","",time()-5,"/");}?></span>
													<span class="err"><?php if(isset($_COOKIE['qrr'])){ echo $_COOKIE['qrr']; setcookie("qrr","",time()-5,"/");}?></span>
													<span class="oos"><?php if(isset($_COOKIE['oosS'])){ echo $_COOKIE['oosS']; setcookie("oosS","",time()-5,"/");}?></span>
													<span class="oos"><?php if(isset($_COOKIE['oosM'])){ echo $_COOKIE['oosM']; setcookie("oosM","",time()-5,"/");}?></span>
													<span class="oos"><?php if(isset($_COOKIE['oosL'])){ echo $_COOKIE['oosL']; setcookie("oosL","",time()-5,"/");}?></span>
												</td>
											</tr>
											<tr>
											<?php if($row->ProductAvailabilitySmall>0){?>
													<td><input type="checkbox" name="size_small" value="small">small</td>
													<td><input type="text" name="small_quant" placeholder="quantity of small" value="1"></td>
											<?php }
												else{	?>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;small</td>
													<td>Out Of Stock</td>
											<?php }	?>
											</tr>
											<tr>
											<?php if($row->ProductAvailabilityMedium>0){?>
													<td><input type="checkbox" name="size_medium" value="medium">medium</td>
													<td><input type="text" name="medium_quant" placeholder="quantity of medium" value="1"></td>
											<?php }
												else{	?>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;medium</td>
													<td>Out Of Stock</td>
											<?php }	?>
											</tr>
											<tr>
											<?php if($row->ProductAvailabilityLarge>0){?>
													<td><input type="checkbox" name="size_large" value="large">large</td>
													<td><input type="text" name="large_quant" placeholder="quantity of large" value="1"></td>
											<?php }
												else{	?>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;large</td>
													<td>Out Of Stock</td>
											<?php }	?>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="add to cart"></td>
								</tr>
							</table>
						</form>
			<?php 	
					}
					else
						echo "invalid";
				}else{  

					$sqlcmd="SELECT c.CartPurchased,c.CartID,c.UserAccountID,p.ProductAttactment,p.ProductID,p.ProductName,c.CartItemSize,c.CartQuantity,p.ProductPrice
								FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE UserAccountID=".$_COOKIE['authID']." GROUP BY c.ProductID,c.CartItemSize,CartPurchased,CartDateAdded";
							
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0){				?>
						<table id="table_">
						<tr class="tableRow">
				<?php 	for($int = 1; $row = $result->fetch_object(); $int++)
						{
							 ?>
							<td class="tableData">
								<div class="mardagz" style="background: url('img/product/<?php echo  $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
									<div class="details">
										<a href="img/product/<?php echo  $row->ProductAttactment; ?>" class='fresco'
											data-fresco-group="product"
											data-fresco-caption="<?php echo $int?> Name: <?php echo  $row->ProductName; ?> <br />
											Price: &#8369;<?php echo  $row->ProductPrice; ?>" >
											<div class="name tddiv">
												<span>ZOOM IMAGE</span>
											</div>
										</a>
								<?php 	if($row->CartPurchased){		?>
											<div class="purchased tddiv">
												<span>PURCHASED</span>
											</div>
								<?php 	}
										else{		?>
											<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>?<?php echo $q?><?php echo $srch?><?php echo $c?>page=<?php echo $p?>&del=<?php echo $row->CartID?>">
												<div class="cart tddiv">
													<span>REMOVE TO CART</span>
												</div>
											</a>
								<?php 	}			?>	
										<br />
										<p style="color:white;"><?php echo $int?>:&nbsp;<?php echo $row->CartItemSize?>:<?php echo $row->CartQuantity?>&nbsp;&nbsp;<?php echo  $row->ProductName?> <b><br /> &#8369;<?php echo  $row->ProductPrice?></b></p>
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
				}	?>
			
			
			</div>
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
			<div style="background-color:; height:50px; margin-top:33px;">
				<a href="store.php?<?php echo $q?><?php echo $srch?><?php echo $c?>page=<?php echo $p?>">
					<div style="float:left; background-color:#D14719; width:150px; height:50px;">
						<p>BACK TO SHOP</p>
					</div>
				</a>
				<?if(!isset($_GET['file'])){?>
				<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>?<?php echo $q?><?php echo $srch?><?php echo $c?>page=<?php echo $p?>&purchase=yes">
					<div style="float:right; background-color:#990033; width:150px; height:50px;">
						<p>PURCHASE</p>
					</div>
				</a>
				<?}
				else{?>
					<a href="cart.php?<?php echo $q;?><?php echo $cat?><?php echo $srch?>page=<?php echo $page?>">
						<div style="float:right; background-color:#990033; width:150px; height:50px;">
							<p>VIEW CART</p>
						</div>
					</a>
				<?}?>
			</div>
		</div>
	</center>
<?php
	include 'php/footer.php';
?>