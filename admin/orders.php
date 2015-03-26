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
			<a href="index.php"><button>back to main</button></a><br />
			<?php
				$rs=DB::query("SELECT p.PurchasedID,u.UserAccountFisrtName,u.UseraccountLastName,p.PurchasedDate
					FROM Purchased AS p LEFT JOIN Useraccount AS u ON p.UseraccountID=u.UseraccountID WHERE p.PurchasedDelivered=0 ORDER BY PurchasedDate");
				if(DB::getNumRows()>0){
					echo "<table class='grid' border=1><tr><td></td><td>Official recite</td><td>Clients</td><td>Date</td></tr>";
					for ($i=1;$row=$rs->fetch_object();$i++) {
						echo "<tr><td>".$i."</td><td>".$row->PurchasedID."</td><td><a href='view_orders.php?pid=$row->PurchasedID'>".$row->UserAccountFisrtName." ".$row->UseraccountLastName."</a></td><td>".$row->PurchasedDate."</td></tr>";
					}
					echo "</table>";
				}
				else
					echo "no orders.";
			?>
			</div>
			<?php
		}
	?>
	</body>
</html>
