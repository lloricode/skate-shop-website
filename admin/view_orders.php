<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */


		include 'php/header.php';
		if(!isset($_SESSION['auth_accountID']))
			header("Location: index.php");
		else
		{
			//include"../config.php";	?>
			<div  class="d">
			<a href="orders.php"><button class="btn">back</button></a><br />
			<?php
				if(!isset($_GET["pid"]))
					header("Location: orders.php");

				$rs=DB::query("SELECT pay.*,p.*,u.UserAccountFirstName,u.UseraccountLastName,u.UseraccountEmail,u.UseraccountMobile
					FROM Purchased AS p
					JOIN Useraccount AS u ON p.UseraccountID=u.UseraccountID
					JOIN Payment AS pay ON p.PurchasedID=pay.PurchasedID
					WHERE p.PurchasedDelivered=0 AND pay.PurchasedID=".DB::esc($_GET["pid"])." ORDER BY PurchasedDate");
				if(DB::getNumRows()>0){
					$row=$rs->fetch_object();
					?>
						<table class="grid" border=1>
							<tr>
								<td>Client Name</td>
								<td><?php echo $row->UserAccountFirstName." ".$row->UseraccountLastName; ?></td>
							</tr>
							<tr>
								<td>PurchasedID/Official Receipt</td>
								<td><?php echo $row->PurchasedID; ?></td>
							</tr>
							<tr>
								<td>total Amount</td>
								<td><?php echo "&#8369;".$row->PurchasedAmount; ?></td>
							</tr>
							<tr>
								<td>Total Quantity</td>
								<td><?php echo $row->PurchasedQuantity; ?></td>
							</tr>
							<tr>
								<td>Date Purchased</td>
								<td><?php echo $row->PurchasedDate; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $row->UseraccountEmail; ?></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><?php echo $row->UseraccountMobile; ?></td>
							</tr>
							<tr>
								<td>Card Number</td>
								<td><?php echo $row->PaymentCardNumber; ?></td>
							</tr>
							<tr>
								<td>Card Expiration</td>
								<td><?php echo $row->PaymentCardExpiration; ?></td>
							</tr>
							<tr>
								<td>Secure code</td>
								<td><?php echo $row->PaymentSecureCode; ?></td>
							</tr>
							<tr>
								<td>Shipping address</td>
								<td><?php echo $row->PaymentShippingAddress; ?></td>
							</tr> 
							<tr>
								<td colspan="2">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?pid=<?php echo $row->PurchasedID; ?>" method="post">
										<input type="hidden" value="<?php echo $row->PurchasedID; ?>" name="pid"><input class="btn" type="submit" value="DELIVER">
									</form>
									<?php
										if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ ?>
											<form action="php/deliver.php?pid=<?php echo $row->PurchasedID; ?>" method="post">
												Approve<input type="radio" name="approve" value="1"><br />
												Dis-Approved<input type="radio" name="approve" value="0"><br />
												<input type="hidden" value="<?php echo $row->PurchasedID; ?>" name="pid"><input class="btn" type="submit" value="SUBMIT">
											</form>
							<?php		}
									?>
								</td>
							</tr>
						</table>
<?php					$rs=DB::query("SELECT p.* ,pl.*,c.CartQuantity,c.CartItemSize
							FROM PurchasedLine AS pl
							JOIN Cart AS c ON c.CartID=pl.CartID
							JOIN Product AS p ON p.ProductID=c.ProductID
							WHERE pl.PurchasedID=".$_GET["pid"]);
						echo "<table class='grid' border=1><caption>Orders</caption><tr><th>ProductID</th><th>Price</th><th>ProductName</th><th>Image</th><th>Size</th><th>Quantity</th></tr>";
						for ($i=1;$row=$rs->fetch_object();$i++) {
							echo "<tr><td>$row->ProductID</td><td>&#8369;$row->ProductPrice</td><td>$row->ProductName</td><td><img src='../img/product/$row->ProductAttactment' width='100'/></td><td>$row->CartItemSize</td><td>$row->CartQuantity</td></tr>";
						}
						echo "</table>";

					}
					else
						header("Location: orders.php");
			?>
			</div>
			<?php
		}
	include"php/footer.php";
	?>
