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
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$amount=$row->total_;
			$sql="SELECT SUM(CartQuantity) AS total_Q FROM Cart WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$quant=$row->total_Q;
			$sqlcmd="INSERT INTO Purchased(PurchasedAmount,PurchasedQuantity,UserAccountID,PurchasedDelivered) VALUES($amount,$quant,".$_COOKIE['authID'].",0)";
			DB::query($sqlcmd);
			$sql="SELECT PurchasedId FROM Purchased ORDER BY PurchasedId DESC LIMIT 0,1";
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			$pid=$row->PurchasedId;
			//-------
			$sql="SELECT ProductId,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID']; 
			$rs=DB::query($sql);
			while($row = $rs->fetch_object()){
				$insertline="INSERT INTO PurchasedLine(PurchasedId,ProductID,Quantity) VALUES($pid,".$row->ProductId.",".$row->CartQuantity.")";
				DB::query($insertline);
			}
			//------
			$sqlcmd="UPDATE Cart SET CartPurchased=1 WHERE CartPurchased=0 AND UserAccountID=".$_COOKIE['authID']; 
			DB::query($sqlcmd);
		}
	}

	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
?>
	<center><?
		if(isset($_GET['file'])){ ?>
			<div  class="menu2">
				add cart
			</div>
	<?	}
		else{
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_COOKIE['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			?>
			<div class="menu2" style="margin-top:1px;"><BR>
				<span style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$_COOKIE['authFn']." ".$_COOKIE['authLn']?></span>
				<span style="font-size:25px"><b>YOUR CART</b></span>
				<span style="float:right">UNPURCHASE TOTAL: &#8369;<?=($row->total_>0)?$row->total_:0?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</div>
	<?	}
	?>
		<div class="main_body"><BR>
<div style="background:rgba(0,0,0,.1); height:1030px;">
		<?		
				if(isset($_GET['file'])){
					$sqlcmd="SELECT * FROM Product WHERE ProductID='".htmlspecialchars(trim(stripcslashes($_GET['file']))) ."'";
					$rs=DB::query($sqlcmd);
					if($row=$rs->fetch_object()){

						?>
						
						<? if(isset($_COOKIE['tmp'])){ echo $_COOKIE['tmp']; setcookie("tmp","",time()-5,"/");}?>
						<form action="add_cart.php?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>&file=<?=$_GET['file']?>" method="post" >
							<table>
								<tr>
									<td rowspan="8"><img src="img/product/<?=$row->ProductAttactment?>" width="300" ></td>
									
								</tr>
								<tr>
									<td><h2><?=$row->ProductName?></h2></td>
									<?//security later?>
									<?setcookie("prodID",$row->ProductID,time()+20,"/");?>
								</tr>
								<tr>
									<td>Brand: <b><?=$row->ProductBrand?></b></td>
								</tr>
								<tr>
									<td>Price: &#8369;<b><?=$row->ProductPrice?></b></td>
								</tr>
								<tr>
									<td>Gender: <b><?=$row->ProductGender?></b></td>
								</tr>
								<tr>
									<td>
										<table>
											<tr>
												<td colspan="2">
													<span class="err"><? if(isset($_COOKIE['sizerr'])){ echo $_COOKIE['sizerr']."<BR>"; setcookie("sizerr","",time()-5,"/");}?></span>
													<span class="err"><? if(isset($_COOKIE['qrr'])){ echo $_COOKIE['qrr']; setcookie("qrr","",time()-5,"/");}?></span>
												</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="size_small" value="small">small</td>
												<td><input type="text" name="small_quant" placeholder="quantity of small" value="1"></td>
											</tr>
											<tr>
												<td><input type="checkbox" name="size_medium" value="medium">medium</td>
												<td><input type="text" name="medium_quant" placeholder="quantity of medium" value="1"></td>
											</tr>
											<tr>
												<td><input type="checkbox" name="size_large" value="large">large</td>
												<td><input type="text" name="large_quant" placeholder="quantity of large" value="1"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td><input type="submit" value="add to cart"></td>
								</tr>
							</table>
						</form>
			<?		
					}
					else
						echo "invalid";
				}else{  

					$sqlcmd="SELECT c.CartPurchased,c.CartID,c.UserAccountID,p.ProductAttactment,p.ProductID,p.ProductName,c.CartItemSize,c.CartQuantity,p.ProductPrice
								FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE UserAccountID=".$_COOKIE['authID']." GROUP BY c.ProductID,c.CartItemSize,CartPurchased,CartDateAdded";
							
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0)
							{				?>
								
								<table id="table_">
								<tr class="tableRow">
						<?		for($int = 1; $row = $result->fetch_object(); $int++)
								{
									 ?>
									<td class="tableData">
										<div class="mardagz" style="background: url('img/product/<?= $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
											<div class="details">
												<a href="img/product/<?= $row->ProductAttactment; ?>" class='fresco'
													data-fresco-group="product"
													data-fresco-caption="<?=$int?> Name: <?= $row->ProductName; ?> <br />
													Price: &#8369;<?= $row->ProductPrice; ?>" >
													<div class="name tddiv">
														<span>ZOOM IMAGE</span>
													</div>
												</a>
										<?		if($row->CartPurchased){		?>
													<div class="purchased tddiv">
														<span>PURCHASED</span>
													</div>
										<?		}
												else{		?>
													<a href="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>&del=<?=$row->CartID?>">
														<div class="cart tddiv">
															<span>REMOVE TO CART</span>
														</div>
													</a>
										<?		}			?>	
												<BR>
												<p style="color:white;"><?=$int?>:&nbsp;<?=$row->CartItemSize?>:<?=$row->CartQuantity?>&nbsp;&nbsp;<?= $row->ProductName?> <b><BR> &#8369;<?= $row->ProductPrice?></b></p>
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
			}

					?>
			
			
			</div>
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
			<div style="background-color:; height:50px; margin-top:33px;">
				<a href="store.php?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>">
					<div style="float:left; background-color:#D14719; width:150px; height:50px;">
						<p>BACK TO SHOP</p>
					</div>
				</a>
				<?if(!isset($_GET['file'])){?>
				<a href="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>&purchase=yes">
					<div style="float:right; background-color:#990033; width:150px; height:50px;">
						<p>PURCHASE</p>
					</div>
				</a>
				<?}?>
			</div>
		</div>
	</center>
<?php
	include 'php/footer.php';
?>