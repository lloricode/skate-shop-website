	<?php
	include 'php/header.php';
	?>
		<div  class="d">
	<a href="index.php"><button class="btn">back to main</button></a>
	<?php 
	 if(isset($_SESSION['auth_accountID'])){ ?>
	<?php if($_SESSION['auth_permission']=="admin"){ 		?>
		<p>add product</p>
		<form method="POST" action="php/addproduct.php" enctype="multipart/form-data">
			<table>
				<tr>
					<td>SALE</td>
					<td>
						<select class="inputs" name="psale">
							<option>---------</option>
							<option>yes</option>
							<option>no</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Name</td>
					<td><input class="inputs" type="text" placeholder="Product Name" name="pname" /></td>
				</tr>
				<tr>
					<td>Brand Name</td>
					<td><input class="inputs" type="text" placeholder="Brand Name" name="pbrand" /></td>
				</tr>
				<tr>
					<td>Product Price</td>
					<td><input class="inputs" type="text" placeholder="Product Price" name="pprice" /></td>
				</tr>
				<tr>	
					<td>Product Type</td>
					<td>
						<select class="inputs" name="ptype">
							<option>---------</option>
							<option>shoes</option>
							<option>jackets</option>
							<option>tees</option>
							<option>jeans</option>
							<option>shorts</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Status</td>
					<td>
						<select class="inputs" name="pstatus">
							<option>---------</option>
							<option>Available</option>
							<option>Out of Stock</option>
							<option>Close</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product size</td>
					<td><input class="inputs" type="text" placeholder="size" name="pstockSv" /></td>
					<td>Product Stock</td>
					<td><input class="inputs" type="text" placeholder="value" name="pstockS" /></td>
				</tr>
				<tr>
					<td>Product size</td>
					<td><input class="inputs" type="text" placeholder="size" name="pstockMv" /></td>
					<td>Product Stock</td>
					<td><input class="inputs" type="text" placeholder="value" name="pstockM" /></td>
				</tr>
				<tr>
					<td>Product size</td>
					<td><input class="inputs" type="text" placeholder="size" name="pstockLv" /></td>
					<td>Product Stock</td>
					<td><input class="inputs" type="text" placeholder="value" name="pstockL" /></td>
				</tr>
				<tr>
					<td>Product For</td>
					<td>
						<select class="inputs" name="pgender">
							<option>---------</option>
							<option>Male</option>
							<option>Female</option>
							<option>Both</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Browse Image</td>
					<td colspan="3">
						<input class="inputs" type="file" name="pimage" id="idFile" />
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<input class="btn" type="submit" value="Add Item to Product" />
					</td>
				</tr>
			</table>
		</form>
<?php }		?>
		</div>
		<br /> <br />
		<hr />
		<style type="text/css">
			.grid{
				width: 100%;
				border-collapse: collapse; 
			}
			.grid tr td{
				border:solid 1px white;
			}
		</style>

		<?php
		$tmpsql="";
		if(isset($_GET["query"])){
			switch ($_GET["query"]){
				case 'sale':
					$tmpsql="p.ProductSale=1";
					break;
				case 'male':
					$tmpsql="p.ProductGender='male'";
					break;
				case 'female':
					$tmpsql="p.ProductGender='female'";
					break;
				
				default:
					$tmpsql="";
					break;
			}
		}
		$tmpsql2="";
		if(isset($_GET["cat"])){
			switch ($_GET["cat"]){
				case 'shoes':
					$tmpsql2="p.ProductType='shoes'";
					break;
				case 'jackets':
					$tmpsql2="p.ProductType='jackets'";
					break;
				case 'tees':
					$tmpsql2="p.ProductType='tees'";
					break;
				case 'jeans':
					$tmpsql2="p.ProductType='jeans'";
					break;
				case 'shorts':
					$tmpsql2="p.ProductType='shorts'";
					break;
				
				default:
					$tmpsql2="";
					break;
			}
		}
			$nxt=(isset($_GET["page"]))?$_GET["page"]:1;

			require_once('../config.php');
			$query="SELECT p.*,u.UserAccountFirstName,(CASE ProductSale WHEN 1 THEN 'Sale' ELSE 'Not sale' END) AS sale
			FROM Product AS p INNER JOIN UserAccount AS u ON p.UserAccountID = u.UserAccountID ";
				
			if(isset($_GET["search"])){
				if(preg_match("/^[0-9]*$/", $_GET['search']))
					$tmpsql=" WHERE p.ProductID= ".DB::esc($_GET["search"]);
				else
					$tmpsql= " WHERE p.ProductBrand LIKE '".DB::esc($_GET['search'])."%'
						OR p.ProductName LIKE '".DB::esc($_GET['search'])."%'";
			}
			else{
			$tmpsql=	((isset($_GET["query"]) or isset($_GET["cat"]))?"WHERE":"")."
			 ".$tmpsql."

			 			".((isset($_GET["query"]) and isset($_GET["cat"]))?"AND":"")."
				 ".$tmpsql2." ";
			}
			DB::query($query.$tmpsql);
			$totalresult=DB::getNumRows();

		/*	$query = "SELECT p.ProductID,p.ProductSale,p.ProductName, p.ProductBrand ,p.ProductPrice,p.ProductType, 
			p.ProductStatus,p.ProductAvailability,p.ProductGender,p.ProductAttactment, 
			a.AdminAccountName,p.ProductDateAdded */
		echo	$query="$query $tmpsql ORDER BY ProductID LIMIT ".($nxt*9-9).",9";

		?>
		<div class="d">
		<form style="float:right" action="" method="get">
			<input class="inputs" placeholder="SEARCH ITEM" value="<?php echo (isset($_GET["search"]))?$_GET["search"]:"" ?>" type="txt" name="search"><input class="btn" type="submit" value="GO">
		</form><br /><br />
			<center>
			<?php if(isset($_GET['query'])) 
						$qq=$_GET['query'];
					else
						$qq="";?>
				<ul>
					<li><a  href="view_product.php" ><span  <?php if(isset($qq)){ if($qq=="") echo "class='actve'"; }?> >ALL</span></a></li>
					<li><a  href="view_product.php?query=sale" ><span  <?php if(isset($qq)){ if($qq=="sale") echo "class='actve'"; }?> >SALE</span></a></li>
					<li><a href="view_product.php?query=male"><span  <?php if(isset($qq)){ if($qq=="male") echo "class='actve'"; }?> >MALE</span></a></li>
					<li><a href="view_product.php?query=female"><span  <?php if(isset($qq)){ if($qq=="female") echo "class='actve'"; }?> >FEMALE</span></a></li>
				</ul>
				<?php if(isset($_GET['cat'])) 
						$cc=$_GET['cat'];
					else
						$cc="";
					?>


			<?php
				$actualURL = isset($_GET["query"]) ? "query=" . $_GET["query"] : "";
			?>

				<ul>
					<li><a href="view_product.php?<?php echo  $actualURL; ?>&cat=shoes"><span <?php if(isset($cc)){ if($cc=="shoes") echo "class='actve'"; }?> >SHOES</span></a></li>
					<li><a href="view_product.php?<?php echo  $actualURL; ?>&cat=jackets"><span <?php if(isset($cc)){ if($cc=="jackets") echo "class='actve'"; }?> >JACKETS</span></a></li>
					<li><a href="view_product.php?<?php echo  $actualURL; ?>&cat=tees"><span <?php if(isset($cc)){ if($cc=="tees") echo "class='actve'"; }?> >TEES</span></a></li>
					<li><a href="view_product.php?<?php echo  $actualURL; ?>&cat=jeans"><span <?php if(isset($cc)){ if($cc=="jeans") echo "class='actve'"; }?> >JEANS</span></a></li>
					<li><a href="view_product.php?<?php echo  $actualURL; ?>&cat=shorts"><span <?php if(isset($cc)){ if($cc=="shorts") echo "class='actve'"; }?> >SHORTS</span></a></li>
				</ul>
			<br />
			<?php echo "Result: $totalresult"; ?>
			<br />
			</center>
			<div>
			<?php
				if($nxt>1){
			?>
				<a class="btn" style="float:left" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".($nxt-1); ?>">Previous</a>
			<?php
				}
				if(($nxt*9)<$totalresult){
			?>
				<a class="btn" style="float:right" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?".
				(isset($_GET["query"])?"query=".$_GET["query"]."&":"").
				(isset($_GET["cat"])?"cat=".$_GET["cat"]."&":"")
				."page=".($nxt+1); ?>">NEXT</a>
			<?php
				}
			?>
			</div>
			<br />
			<br />
			<fieldset>
				<legend>Datagrid View</legend>
				<table class="grid" style="text-align:center">
					<?php

					$result = DB::query($query);
					if(DB::getNumRows() > 0){
						for($i=($nxt*9-9);$row = $result->fetch_object();$i++)	{
							if($i%3==0){		?>
								<tr>
									<th>no.</th>
									<th>ID</th>
									<th>Sale</th>
									<th>Name</th>
									<th>Brand</th>
									<th>Price</th>
									<th>Type</th>
									<th>StatusSet</th>
									<th colspan="2">Stocks</th>
									<th>Gender</th>
									<th>Picture</th>
									<th>Added by</th>
									<th>Date Added</th>
								</tr>
						<?php }	?>	
							<tr>
								<td rowspan="4"><?php echo ($i+1)?></td>
								<td rowspan="4"><?php echo  $row->ProductID; ?></td>
								<td rowspan="4"><?php echo  $row->sale; ?></td>
								<td rowspan="4"><?php echo  $row->ProductName; ?></td>
								<td rowspan="4"><?php echo  $row->ProductBrand; ?></td>
								<td rowspan="4"><?php echo  "&#8369; ".$row->ProductPrice; ?></td>
								<td rowspan="4"><?php echo  $row->ProductType; ?></td>
								<td rowspan="4"><?php echo  $row->ProductStatus; ?></td>
	<?php 
		$rs1=DB::query("SELECT ProductInventorySize,ProductInventoryStock FROM ProductInventory WHERE ProductId=".$row->ProductID);
		$row1=$rs1->fetch_object();
		$total=0;
		$total+=$row1->ProductInventoryStock;
	 ?>
								<td><b><?php echo  $row1->ProductInventorySize; ?></b></td>
								<td <?php if($row1->ProductInventoryStock<10) echo "style='color:darkred'" ?> ><?php echo  $row1->ProductInventoryStock; ?></td>

								<td rowspan="4"><?php echo  $row->ProductGender;?></td>
								<td rowspan="4"> <?php $row1=$rs1->fetch_object();  $total+=$row1->ProductInventoryStock;  ?>
									<a href="edit.php?edit_product=<?php echo  $row->ProductID; ?>"><img src="<?php echo  $ri->w("../img/product/".$row->ProductAttactment,100); ?>"  /></a>
								</td>
								<td rowspan="4"><?php echo  $row->UserAccountFirstName; ?></td>
								<td rowspan="4"><?php echo  $row->ProductDateAdded; ?></td>
							</tr>
							<tr>
								<td><b><?php echo  $row1->ProductInventorySize; ?></b></td>
								<td <?php if($row1->ProductInventoryStock<10) echo "style='color:darkred'" ?> ><?php echo  $row1->ProductInventoryStock; ?></td>
							</tr>
							<tr>  <?php $row1=$rs1->fetch_object();  $total+=$row1->ProductInventoryStock;  ?>
								<td><b><?php echo  $row1->ProductInventorySize; ?></b></td>
								<td <?php if($row1->ProductInventoryStock<10) echo "style='color:darkred'" ?> ><?php echo  $row1->ProductInventoryStock; ?></td>
							</tr>
							<tr>
								<td><b>+</b></td>
								<td <?php if(( $total)<10) echo "style='color:darkred'" ?> ><?php echo ( $total)?></td>
							</tr>
			<?php 		}
					}
					?>
				</table>
				<?php }
				else
					header("Location: index.php");?>
			</fieldset>
			<br />
			<div>
			<?php
				if($nxt>1){
			?>
				<a class="btn" style="float:left" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".($nxt-1); ?>">Previous</a>
			<?php
				}
				if(($nxt*9)<$totalresult){
			?>
				<a class="btn" style="float:right" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".($nxt+1); ?>">NEXT</a>
			<?php
				}
			?>
			</div>
			<br />
		</div>
		<?php
			include"php/footer.php";
		?>