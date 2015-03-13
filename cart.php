<?php
	$docfile="cart";
	include 'php/main_style.php';
	if(!isset($_SESSION['authID'])){
		header("Location: login.php");
	}
	include 'php/fresco_style.php';
	include 'php/header.php';
	include 'php/menu.php';
	//include("config.php");

	if(isset($_GET['del']) and $_SERVER["REQUEST_METHOD"]=="GET"){
		$id=trim(stripcslashes(htmlspecialchars($_GET['del'])));
		$sqlcmd="DELETE FROM Cart Where CartID=$id";
		DB::query($sqlcmd);
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
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_SESSION['authID'];  
			$rs=DB::query($sql);
			$row = $rs->fetch_object();
			?>
			<div class="menu2" style="margin-top:0px;"><br />
				<span style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['authFn']." ".$_SESSION['authLn']?></span>
				<span style="font-size:25px"><b>YOUR CART</b></span>
				<span style="float:right">UNPURCHASE TOTAL: &#8369;<?php echo ($row->total_>0)?$row->total_:0?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</div>
	<?php }
	?>
		<div class="main_body"><br />
<div style="background:rgba(0,0,0,.1); height:1030px;">
		<?php
				if(isset($_GET['file'])){
					$sqlcmd="SELECT * FROM Product WHERE ProductID='".DB::esc($_GET['file']) ."'";
					$rs=DB::query($sqlcmd);
					if($row=$rs->fetch_object()){			?>
						<?php if(isset($_COOKIE['tmp'])){ echo $_COOKIE['tmp']; setcookie("tmp","",time()-5,"/");}?>
						<form action="php/add_cart.php?<?php echo $q?><?php echo $srch?><?php echo $c?>page=<?php echo $p?>&file=<?php echo $_GET['file']?>" method="post" >
							<table>
								<tr>
									<td rowspan="8"><img src="img/product/<?php echo $row->ProductAttactment?>" width="300" ></td>
								</tr>
								<tr>
									<td><h2><?php echo $row->ProductName?></h2></td>
									<?php //security later?>
									<input type="hidden" name="prodID" value="<?php echo $row->ProductID;?>">
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
					$sqlcmd="SELECT c.CartPurchased,c.CartID,c.UserAccountID,p.ProductAttactment,p.ProductID,p.ProductName,c.CartItemSize,c.CartQuantity,p.ProductPrice,p.ProductBrand
								FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE UserAccountID=".$_SESSION['authID']." GROUP BY c.ProductID,c.CartItemSize,CartPurchased,CartDateAdded ORDER BY CartPurchased";
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0){				?>
						<table id="table_">
						<tr class="tableRow">
				<?php 	for($int = 1; $row = $result->fetch_object(); $int++)
						{
							 ?>
							<td class="tableData">
								<div class="mardagz" style="background: url('<?php echo  $ri->h("img/product/".$row->ProductAttactment,260); ?>');background-repeat: no-repeat; background-size: cover;">
									<div class="details">
										<a href="<?php echo  $ri->h("img/product/".$row->ProductAttactment,700); ?>" class='fresco'
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
										<p style="font-size:13px;float:left">
											&nbsp;&nbsp;<?php echo $int?>:
											<span style="color:red;">	
												 <?php echo  $row->ProductBrand?> &nbsp;</span><br />
											<b>	&nbsp;&nbsp; <?php echo  $row->ProductName?> &nbsp;<br />
												&nbsp;&nbsp; &#8369;<?php echo  $row->ProductPrice?></b>
										</p>
										<p style="color:white;float:right">
											<?php echo $row->CartItemSize?>(<?php echo $row->CartQuantity?>)
										</p>
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
				<?php if(!isset($_GET['file'])){

					DB::query("SELECT CartPurchased as a FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION["authID"]."'");
					if(DB::getNumRows()>0){
				?>
						<a href="fillcheckout.php">
							<div style="float:right; background-color:#990033; width:150px; height:50px;">
								<p>CHECKOUT</p>
							</div>
						</a>
				<?php		//echo "<a href='".htmlspecialchars($_SERVER["PHP_SELF"])."?".$q.$srch.$c."page=".$p."&purchase=yes'>";
					}
				 }
				else{?>
					<a href="cart.php?<?php echo $q;?><?php echo $c?><?php echo $srch?>page=<?php echo $p?>">
						<div style="float:right; background-color:#990033; width:150px; height:50px;">
							<p>VIEW CART</p>
						</div>
					</a>
				<?php }?>
			</div>
		</div>
	</center>
<?php
	include 'php/footer.php';
?>