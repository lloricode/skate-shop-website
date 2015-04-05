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
				<a href="index.php"><button>back to main</button></a><br />
				<?php
					$rs=DB::query("SELECT u.UserAccountID,pa.PurchasedApprovedID,u.UserAccountFirstName,p.PurchasedID,pa.PurchasedApprovedID,u.UseraccountLastName,p.PurchasedDate,
								(CASE pa.PurchasedApprovedStatus WHEN 1 THEN 'YES' ELSE 'CANCELED' END) AS status
								FROM Purchased AS p
								JOIN Useraccount AS u ON p.UseraccountID=u.UseraccountID
								JOIN PurchasedApproved AS pa ON p.PurchasedID=pa.PurchasedID
								WHERE p.PurchasedDelivered=1
								ORDER BY PurchasedDate DESC");
					if(DB::getNumROws()){
						echo "<table class='grid' border='1'><caption>Delivered</caption>
								<tr><th>no</th><th>Official recite</th><th>Clients</th><th>Delivered Date</th><th>Admin</th>
								<th>Approved</th><th>Received Status</th><th colspan='2'></th></tr>";
							for ($i=1;$row=$rs->fetch_object();$i++) {
							$rs2=DB::query("SELECT u.UserAccountFirstName,u.UseraccountLastName FROM PurchasedApproved AS pa 
								JOIN UserAccount AS u ON pa.UseraccountID=u.UseraccountID WHERE pa.PurchasedApprovedID=".$row->PurchasedApprovedID);
							$row2=$rs2->fetch_object();
							echo "<tr><td>".$i."</td><td><a href='view_delivered.php?pid=$row->PurchasedID'>".$row->PurchasedID."</a></td>
							<td>".$row->UserAccountFirstName." ".$row->UseraccountLastName."</td><td>".$row->PurchasedDate."</td>
							<td>$row2->UserAccountFirstName $row2->UseraccountLastName</td><td>$row->status</td>
							<td>";

							$rs3=DB::query("SELECT (CASE ReceivedStatus WHEN 1 THEN 'Reveived' ELSE 'Not' END) AS status FROM Received
								WHERE PurchasedApprovedID=".$row->PurchasedApprovedID);
							$tmp=DB::getNumRows();
							if($tmp){
								$row3=$rs3->fetch_object();
								echo $row3->status;
							}
							else
								echo "on the way";


							echo"</td>";
							if(!$tmp){?>
								<form action="php/recieve.php" method="post">
								<input type="hidden" name="pi" value="<?php echo $row->PurchasedApprovedID; ?>">
			<?php					echo"	<td>yes<input type='radio'  value='y' name='rr' > no<input type='radio'  value='n' name='rr' ></td>
										<td><input type='submit' value='set'></td>";

										echo "</form>";
							}
							else
								echo "<td colspan='2'>.......</td>";
						echo"	</tr>";
						}
				?>
					</table>
			</div>
			<?php  }
					else
						echo "no data";
		}
	?>
	</body>
</html>
