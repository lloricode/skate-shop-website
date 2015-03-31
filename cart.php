<?php
	$docfile="cart";
	include 'php/main_style.php';
	include 'php/fresco_style.php';
	include 'php/header.php';
	if(!isset($_SESSION['authID']))
		header("Location: login.php?".DB::esc(basename($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING']));
	include 'php/menu.php';
	//include("config.php");



//	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
//	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	//$p=$_GET['page'];
//	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
?>
	<center>
			<div  class="menu2" style="margin-top:0px;">
				add cart
			</div>
	

		<div class="main_body"><br />
<div style="background:rgba(0,0,0,.1); height:1030px;">
		<?php
				
					$sqlcmd="SELECT * FROM Product WHERE ProductID='".DB::esc($_GET['file']) ."'";
					$rs=DB::query($sqlcmd);
					if($row=$rs->fetch_object()){			?>
						<?php if(isset($_COOKIE['tmp'])){ echo $_COOKIE['tmp']; setcookie("tmp","",time()-5,"/");}?>
						<form action="php/add_cart.php?file=<?php echo $row->ProductID; ?>" method="post" >
						<input type="hidden" name="prodID" value="<?php echo $row->ProductID;?>">
							<table>
								<tr>
									<td rowspan="8"><img src="<?php echo  $ri->w("img/product/".$row->ProductAttactment,300); ?>" ></td>
								</tr>
								<tr>
									<td><h2><?php echo $row->ProductName?></h2></td>
									<?php //security later?>
									
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
				?>
			</div>
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
			<div style="background-color:; height:50px; margin-top:33px;">
				<a href="store.php?<?php echo $_SERVER ['QUERY_STRING']?>">
					<div style="float:left; background-color:#D14719; width:150px; height:50px;">
						<p>BACK TO SHOP</p>
					</div>
				</a>
				
					<a href="mycart.php">
						<div style="float:right; background-color:#990033; width:150px; height:50px;">
							<p>VIEW CART</p>
						</div>
					</a>
				
			</div>
		</div>
		
	</center>
<?php
	include 'php/footer.php';
?>