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
			include"../config.php";	?>
			<div  class="d">
			<a href="orders.php"><button>back</button></a><br />
			<?php
				if(!isset($_GET["pid"]))
					header("Location: orders.php");

				$rs=DB::query("SELECT p.*,u.UseraccountFisrtName,u.UseraccountLastName,u.UseraccountEmail,u.UseraccountShipping,u.UseraccountMobile FROM Purchased AS p LEFT JOIN Useraccount AS u ON p.UseraccountID=u.UseraccountID
					 WHERE p.PurchasedDelivered=0 AND p.PurchasedID=".DB::esc($_GET["pid"])." ORDER BY PurchasedDate");
				if(DB::getNumRows()>0){
					$row=$rs->fetch_object();
					?>
						<table class="grid" border=1>
							<tr>
								<td>Client Name</td>
								<td><?php echo $row->UseraccountFisrtName." ".$row->UseraccountLastName; ?></td>
							</tr>
							<tr>
								<td>PurchasedID</td>
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
								<td>Card Number</td>
								<td><?php echo $row->card_number; ?></td>
							</tr>
							<tr>
								<td>Card Expiration</td>
								<td><?php echo $row->card_expiration; ?></td>
							</tr>
							<tr>
								<td>Secure code</td>
								<td><?php echo $row->secure_code; ?></td>
							</tr>
							<tr>
								<td>Shipping address</td>
								<td><?php echo $row->UseraccountShipping; ?></td>
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
								<td colspan="2">
									<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>?pid=<?php echo $row->PurchasedID; ?>" method="post">
										Deliver it now!<input type="hidden" value="<?php echo $row->PurchasedID; ?>" name="pid"><input type="submit" value="OK">
									</form>
									<?php
										if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ ?>
											<form action="php/deliver.php?pid=<?php echo $row->PurchasedID; ?>" method="post">
												sure?<input type="hidden" value="<?php echo $row->PurchasedID; ?>" name="pid"><input type="submit" value="YES">
											</form>
							<?php		}
									?>
								</td>
							</tr>
						</table>
<?php					$rs=DB::query("SELECT p.* ,pl.*FROM PurchasedLine AS pl LEFT JOIN Product AS p ON pl.ProductID=p.ProductID WHERE pl.PurchasedID=".$_GET["pid"]);
						echo "<table class='grid' border=1><caption>Orders</caption><tr><th>ProductID</th><th>Price</th><th>ProductName</th><th>Image</th><th>Size</th><th>Quantity</th></tr>";
						for ($i=1;$row=$rs->fetch_object();$i++) {
							echo "<tr><td>$row->ProductID</td><td>&#8369;$row->ProductPrice</td><td>$row->ProductName</td><td><img src='../img/product/$row->ProductAttactment' width='100'/></td><td>$row->Size</td><td>$row->Quantity</td></tr>";
						}
						echo "</table>";

					}
					else
						header("Location: orders.php");
			?>
			</div>
			<?php
		}
	?>
	</body>
</html>
