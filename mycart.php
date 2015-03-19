<?php
	$docfile="cart";
	$docc=1;
	include 'php/main_style.php';
	//include("config.php");
	$msg="";
	//$chk_item=array();


	if(isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		foreach ($_POST as $value) {
			DB::query("SELECT CartID FROM Cart WHERE CartID=".DB::esc($value)." AND UserAccountID=".$_SESSION["authID"]);
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
	else
		include"php/datepicker.php";
	include 'php/header.php';
	if(!isset($_SESSION['authID']))
		header("Location: login.php?".DB::esc(basename($_SERVER['PHP_SELF'])).(($_SERVER ['QUERY_STRING']=="")?"":"?".$_SERVER['QUERY_STRING']));
	include 'php/menu.php';
	


//	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
//	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	//$p=$_GET['page'];
//	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
	if(isset($_COOKIE["paid"])){
			echo "<center><div class='main_body'><br />";
					setcookie("paid","",time()-10,"/");?>
					<h1>Thanks for shopping!</h1>
					</div></center>
<?php }else	if($docc){
?>
	<center><?php
			$sql="SELECT SUM(p.ProductPrice*c.CartQuantity) AS total_ FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartPurchased=0 AND UserAccountID=".$_SESSION['authID'];  
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
					$sqlcmd="SELECT c.CartPurchased,c.CartID,c.UserAccountID,p.ProductAttactment,p.ProductID,p.ProductName,c.CartItemSize,c.CartQuantity,p.ProductPrice,p.ProductBrand
								FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE UserAccountID=".$_SESSION['authID']." GROUP BY c.ProductID,c.CartItemSize,CartPurchased,CartDateAdded ORDER BY CartPurchased";
					$result=DB::query($sqlcmd);
					if(DB::getNumRows() > 0){		$chk=0;		?>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?".$_SERVER ['QUERY_STRING'] ?>" method="post">
						<?php echo $msg;?>
						<table id="table_">
						<tr class="tableRow">
				<?php 	for($int = 1; $row = $result->fetch_object(); $int++)
						{
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
								<?php 	if($row->CartPurchased){	$chk=0;	?>
											<div class="purchased tddiv">
												<span>PURCHASED</span>
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
			?>
				<form action="php/checkout.php?<?php echo $_SERVER ['QUERY_STRING']; ?>" method="post">
				<input type="hidden" name="pid" value="<?php echo htmlentities(serialize($chk_item)); ?>" />
					<table>
						<tr>
							<td>Credit Card Number:</td><td><input type="text" name="card" value="<?php if(isset($_COOKIE["card"])){ echo $_COOKIE["card"]; setcookie("card","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["cardrr"])){ echo $_COOKIE["cardrr"]; setcookie("cardrr","",time()-10,"/");} ?></span></td>
						</tr>
						<tr>
							<td>Expiration Date:</td><td><input type="date" id="datepicker" name="expire" value="<?php if(isset($_COOKIE["expire"])){ echo $_COOKIE["expire"]; setcookie("expire","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["expirerr"])){ echo $_COOKIE["expirerr"]; setcookie("expirerr","",time()-10,"/");} ?></span></td>
						</tr>
						<tr>
							<td>Card Security Code:</td><td><input type="text" name="secure" value="<?php if(isset($_COOKIE["secure"])){ echo $_COOKIE["secure"]; setcookie("secure","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["securerr"])){ echo $_COOKIE["securerr"]; setcookie("securerr","",time()-10,"/");} ?></span></td>
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
<table><tr> 
			<?php
				for ($i=0;$i<sizeof($chk_item);$i++) {
					$rs=DB::query("SELECT c.*,p.ProductAttactment FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartID=".$chk_item[$i]);
					$row=$rs->fetch_object();
					?><td><img src="<?php echo  $ri->w("img/product/".$row->ProductAttactment,100); ?>"></td><?php
				}
			?>
</tr></table>
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