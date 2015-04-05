<?php
	include 'php/header.php';
	require_once('../config.php');
?>
	<div class="d">
	<div style="margin-top:10px;">
	<a href="view_product.php"><button>back</button></a>
	</div>
	<?php
	if(isset($_SESSION['auth_accountID'])){
		if(isset($_GET['edit_product'])){
			if(isset($_COOKIE['tmp'])) echo $_COOKIE['tmp'];
			$rs=DB::query("SELECT * FROM Product WHERE ProductID='".trim(stripcslashes(htmlspecialchars($_GET['edit_product'])))."'");
			if(DB::getNumRows()){
				$row=$rs->fetch_object();
				setcookie("del",$row->ProductAttactment,time()+900,"/");
				echo "<form action='php/update_product.php?id=$row->ProductID' method='post' enctype='multipart/form-data'>";
	?>			<table>
				<tr>
					<td><img src="../img/product/<?php echo $row->ProductAttactment; ?>" width="200" ></td>
					<td>

					</td>
				</tr>
				<tr>
					<td>Browse Image</td>
					<td>
						<input type="file" name="pimage" id="idFile" />
					</td>
				</tr>
				<tr>
					<td>SALE</td>
					<td><?php $t=$row->ProductSale;?>
						<select name="psale">
							<option <?php if($t=="1") echo "selected";?>>yes</option>
							<option <?php if($t=="0") echo "selected";?>>no</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Name</td>
					<td><input type="text" placeholder="Product Name" name="pname" value="<?php echo $row->ProductName; ?>" /></td>
				</tr>
				<tr>
					<td>Brand Name</td>
					<td><input type="text" placeholder="Brand Name" name="pbrand" value="<?php echo $row->ProductBrand; ?>" /></td>
				</tr>
				<tr>
					<td>Product Price</td>
					<td><input type="text" placeholder="Product Price" name="pprice" value="<?=$row->ProductPrice; ?>" /></td>
				</tr>
				<tr>	
					<td>Product Type</td>
					<td>
					<?php $t=$row->ProductType;?>
						<select name="ptype">
							<option <?php if($t=="shoes") echo "selected";?>>shoes</option>
							<option <?php if($t=="jackets") echo "selected";?>>jackets</option>
							<option <?php if($t=="tees") echo "selected";?>>tees</option>
							<option <?php if($t=="jeans") echo "selected";?>>jeans</option>
							<option <?php if($t=="shorts") echo "selected";?>>shorts</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Product Status</td>
					<td><?php $t=$row->ProductStatus;?>
						<select name="pstatus">
							<option <?php if($t=="Available") echo "selected";?>>Available</option>
							<option <?php if($t=="Out of Stock<") echo "selected";?>>Out of Stock</option>
							<option <?php if($t=="Close") echo "selected";?>>Close</option>
						</select>
					</td>
				</tr>
				<tr>

				<?php
						$rs1=DB::query("SELECT ProductInventorySize,ProductInventoryID,ProductInventoryStock FROM ProductInventory WHERE ProductId=".$row->ProductID);
						$row1=$rs1->fetch_object();
				?>
					<td>Product Stock </td><td><input type="text" placeholder="size" name="sizeone" value="<?php echo  $row1->ProductInventorySize; ?>" /></td>
					<input type="hidden" name="size_one" value="<?php echo  $row1->ProductInventorySize; ?>">
					<td><input type="text" placeholder="Product Stock" name="pstockS" value="<?php echo $row1->ProductInventoryStock; ?>" /></td>
					<input type="hidden" name="idone" value="<?php echo  $row1->ProductInventoryID; ?>">
				</tr>
				<tr>
					<td>Product Stock <?php $row1=$rs1->fetch_object(); ?></td><td><input type="text" placeholder="size" name="sizetwo"  value="<?php echo  $row1->ProductInventorySize; ?>"/></td>
					<input type="hidden" name="size_two" value="<?php echo  $row1->ProductInventorySize; ?>">
					<td><input type="text" placeholder="Product Stock" name="pstockM" value="<?php echo $row1->ProductInventoryStock; ?>" /></td>
					<input type="hidden" name="idtwo" value="<?php echo  $row1->ProductInventoryID; ?>">
				</tr>
				<tr>
					<td>Product Stock <?php $row1=$rs1->fetch_object(); ?></td><td><input type="text" placeholder="size" name="sizethree"  value="<?php echo  $row1->ProductInventorySize; ?>"/></td>
					<input type="hidden" name="size_three" value="<?php echo  $row1->ProductInventorySize; ?>">
					<td><input type="text" placeholder="Product Stock" name="pstockL" value="<?php echo $row1->ProductInventoryStock; ?>" /></td>
					<input type="hidden" name="idthree" value="<?php echo  $row1->ProductInventoryID; ?>">
				</tr>
				<tr>
					<td>Product For</td>
					<td><?php $t=$row->ProductGender;?>
						<select name="pgender">
							<option <?php if($t=="male") echo "selected";?>>male</option>
							<option <?php if($t=="female") echo "selected";?>>female</option>
							<option <?php if($t=="both") echo "selected";?>>both</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<input type="submit" value="Update Item to Product" />
					</td>
				</tr>
			</table>
		</form>





<?php 		}
		}
	}
	else
		header("Location: index.php");

	?>
	</div>
	</body>
</html>
