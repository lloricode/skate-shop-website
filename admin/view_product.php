
	<?php
	include 'php/header.php';
	?>
		<div  class="d">
<a href="index.php"><button>back to main</button></a>
	<?
	 if(isset($_COOKIE['auth_accountID'])){ ?>
	<?php if($_COOKIE['auth_permission']=="admin"){ 		?>
		<p>add product</p>
		<form method="POST" action="php/addproduct.php" enctype="multipart/form-data">
			<table>
				<tr>
					<td>SALE</td>
					<td>
						<select name="psale">
							<option>---------</option>
							<option>yes</option>
							<option>no</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Name</td>
					<td><input type="text" placeholder="Product Name" name="pname" /></td>
				</tr>
				<tr>
					<td>Brand Name</td>
					<td><input type="text" placeholder="Brand Name" name="pbrand" /></td>
				</tr>
				<tr>
					<td>Product Price</td>
					<td><input type="text" placeholder="Product Price" name="pprice" /></td>
				</tr>
				<tr>	
					<td>Product Type</td>
					<td>
						<select name="ptype">
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
						<select name="pstatus">
							<option>---------</option>
							<option>Available</option>
							<option>Out of Stock</option>
							<option>Close</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Stock Small</td>
					<td><input type="text" placeholder="SMALL" name="pstockS" /></td>
				</tr>
				<tr>
					<td>Product Stock Medium</td>
					<td><input type="text" placeholder="MEDIUM" name="pstockM" /></td>
				</tr>
				<tr>
					<td>Product Stock Large</td>
					<td><input type="text" placeholder="LARGE" name="pstockL" /></td>
				</tr>
				<tr>
					<td>Product For</td>
					<td>
						<select name="pgender">
							<option>---------</option>
							<option>Male</option>
							<option>Female</option>
							<option>Both</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Browse Image</td>
					<td>
						<input type="file" name="pimage" id="idFile" />
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<input type="submit" value="Add Item to Product" />
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
		<fieldset>
			<legend>Datagrid View</legend>
			<table class="grid" style="text-align:center">
				<?php
				require_once('../config.php');
			/*	$query = "SELECT p.ProductID,p.ProductSale,p.ProductName, p.ProductBrand ,p.ProductPrice,p.ProductType, 
				p.ProductStatus,p.ProductAvailability,p.ProductGender,p.ProductAttactment, 
				a.AdminAccountName,p.ProductDateAdded */
				$query=" SELECT p.*,a.AdminAccountName,(CASE ProductSale WHEN 1 THEN 'Sale' ELSE 'Not sale' END) AS sale
				FROM Product AS p INNER JOIN AdminAccount AS a ON p.AdminAccountID = a.AdminAccountID ORDER BY ProductID";

				$result = DB::query($query);
				if(DB::getNumRows() > 0){
					for($i=0;$row = $result->fetch_object();$i++)	{
						if($i%7==0){		?>
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
							<td rowspan="4"><?=($i+1)?></td>
							<td rowspan="4"><?= $row->ProductID; ?></td>
							<td rowspan="4"><?= $row->sale; ?></td>
							<td rowspan="4"><?= $row->ProductName; ?></td>
							<td rowspan="4"><?= $row->ProductBrand; ?></td>
							<td rowspan="4"><?= "&#8369; ".$row->ProductPrice; ?></td>
							<td rowspan="4"><?= $row->ProductType; ?></td>
							<td rowspan="4"><?= $row->ProductStatus; ?></td>

							<td><b>S</b></td>
							<td><?= $row->ProductAvailabilitySmall; ?></td>

							<td rowspan="4"><?= $row->ProductGender; ?></td>
							<td rowspan="4">
								<a href="edit.php?edit_product=<?= $row->ProductID; ?>"><img src="../img/product/<?= $row->ProductAttactment; ?>" width="100" /></a>
							</td>
							<td rowspan="4"><?= $row->AdminAccountName; ?></td>
							<td rowspan="4"><?= $row->ProductDateAdded; ?></td>
						</tr>
						<tr>
							<td><b>M</b></td>
							<td><?= $row->ProductAvailabilityMedium; ?></td>
						</tr>
						<tr>
							<td><b>L</b></td>
							<td><?= $row->ProductAvailabilityLarge; ?></td>
						</tr>
						<tr>
							<td><b>+</b></td>
							<td><?=( $row->ProductAvailabilitySmall+$row->ProductAvailabilityMedium+$row->ProductAvailabilityLarge)?></td>
						</tr>
		<?php 		}
				}
				?>
			</table>
			<?}
			else
				header("Location: index.php");?>
		</fieldset>
	</body>
	</html>
	