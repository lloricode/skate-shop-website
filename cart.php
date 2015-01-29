<?php
	if(!isset($_COOKIE['authID'])) header("Location: login.php");
	include 'main_style.php';
	include 'header.php';
	include 'menu.php';
	include("config.php");

	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
?>
	<center>
		<div class="main_body"><BR><BR>
		<?		
				if(isset($_GET['file'])){
					$sqlcmd="SELECT * FROM Product WHERE ProductID='".htmlspecialchars(trim(stripcslashes($_GET['file']))) ."'";
					$rs=DB::query($sqlcmd);
					if($row=$rs->fetch_object()){

						?>
						
						<?=(isset($_COOKIE['tmp']))?$_COOKIE['tmp']:""?>
						<form action="add_cart.php?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>&file=<?=$_GET['file']?>" method="post" >
						<table border="1">
							<tr>
								<td rowspan="8"><img src="img/product/<?=$row->ProductAttactment?>" width="300" ></td>
								
							</tr>
							<tr>
								
								<td><h2><?=$row->ProductName?></h2></td>

								<?//security later?>
								<?setcookie("prodID",htmlspecialchars(trim(stripcslashes($_GET['file']))) ,time()+20,"/");?>
							</tr>
							<tr>
								
								<td>Brand: <b><?=$row->Brand?></b></td>
							</tr>
							<tr>
								
								<td>Price: &#8369;<b><?=$row->ProductPrice?></b></td>
								<? setcookie("price",$row->ProductPrice,time()+20,"/")?>
							</tr>
							<tr>
								
								<td>Gender: <b><?=$row->ProductGender?></b></td>
							</tr>
							<tr>
								
								<td>
									<input type="radio" name="size" value="small">small<BR>
									<input type="radio" name="size" value="medium">medium<BR>
									<input type="radio" name="size" value="large">large<BR>
								</td>
								<td><span class="err"><?php if(isset($_COOKIE['sizerr'])) echo $_COOKIE['sizerr'];?></span></td>
							</tr>
							<tr>
								
								<td>quantity: <input type="text" name="quant" ></td>
								<td><span class="err"><?php if(isset($_COOKIE['qrr'])) echo $_COOKIE['qrr'];?></span></td>
							</tr>
							<tr>
								<td><input type="submit" value="add to cart"></td>
							</tr>
						</table>


			<?		}
					else
						echo "invalid";
				}else{  

					$sqlcmd="SELECT p.ProductAttactment,p.ProductName,c.Quantity,c.Size,c.price 
            			FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID 
            			WHERE c.UserAccountID=".$_COOKIE['authID']."  GROUP BY p.ProductAttactment";
							
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0)
							{	
								echo "<h2>My Cart</h2>";
								echo "<table id='table_'>";
								echo "<tr class='tableRow'>";
								for($int = 1; $row = $result->fetch_object(); $int++)
								{
									 ?>
									<td class="tableData">
										<div class="mardagz" style="background: url('img/product/<?= $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
											<div class="details">
												<a href="img/product/<?= $row->ProductAttactment; ?>" class='fresco'
													data-fresco-group="product"
													data-fresco-caption="Name: <?= $row->ProductName; ?> <br />
													Price: &#8369;<?= $row->price; ?>" >
													<div class="name tddiv">y
														<span>ZOOM IMAGE</span>
													</div>
												</a>
												<a href="#">
													<div class="cart tddiv">
														<span>ADD TO CART</span>
													</div>
												</a>	<BR>
												<p style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->ProductName?> &nbsp;<b>|&nbsp; &#8369;<?= $row->price?></b></p>
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
	setcookie("tmp","",time()-5,"/");
	setcookie("sizerr","",time()-5,"/");
	setcookie("qrr","",time()-5,"/");
	include 'footer.php';
?>