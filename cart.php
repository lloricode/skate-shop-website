<?php
	if(!isset($_COOKIE['authID'])) header("Location: login.php");
	include 'main_style.php';
	include 'fresco_style.php';
	include 'header.php';
	include 'menu.php';
	include("config.php");

	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
?>
	<center>
		<div class="main_body"><BR>
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
			<?		
					}
					else
						echo "invalid";
				}else{  

					$sqlcmd="SELECT c.UserAccountID,p.ProductAttactment,p.ProductID,p.ProductName,c.CartItemSize,c.CartQuantity,p.ProductPrice
FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE UserAccountID=".$_COOKIE['authID']." GROUP BY c.ProductID,c.CartItemSize";
							
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0)
							{				?>
								
								<table >
									<tr>
										<td><?=$_COOKIE['authFn']?></td>
										<th><h2>My Cart</h2></th>
									</tr>
								</table>
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
												<a href="#">
													<div class="cart tddiv">
														<span>REMOVE TO CART</span>
													</div>
												</a>	<BR>
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
			
			<div style="background-color:; height:30px; margin-top:10px;">
			<? ?>
				<a href="store.php?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>">
					<div style="float:bottom; background-color:green; width:150px; height:50px;">
						<p>BACK TO SHOP</p>
					</div>
				</a>
			</div>
		</div>
	</center>
<?php
	include 'footer.php';
?>