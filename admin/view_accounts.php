
		<?php
		include 'php/header.php';
		require_once('../config.php');
		?>

		<?php
			if(isset($_SESSION['auth_accountID'])){ ?>
				<div  class="d">
				<a href="index.php"><button>back to main</button></a>
			<?php 

				if($_SESSION['auth_permission']=="admin"){ 		 ?>
				<a href="add_account.php"><button>add admin account</button></a>
		<?php		}
				//--------------------------
				$sqlcmd="SELECT u.UserAccountFirstName,COUNT(p.UserAccountID) AS NumberOfUploads 
					FROM Product AS p
					LEFT JOIN UserAccount AS u
					ON p.UserAccountID=u.UserAccountID
					GROUP BY u.UserAccountFirstName";
				$rs=DB::query($sqlcmd);
				if(DB::getNumRows()>0){
					echo "<table border='1'><caption>Uploads</caption>
					<tr><th>Admin</th><th>Uploads</th></tr>";
					while($row=$rs->fetch_object())
						echo "<tr><td>".$row->UserAccountFirstName."</td><td> ".$row->NumberOfUploads."</td></tr>";
					echo "</table>";
				}
				//-----------------------
				$sqlcmd="SELECT u.* FROM UserAccount AS u LEFT JOIN UserAccountType AS ut ON u.UserAccountID=ut.UserAccountID WHERE ut.UserAccountTypeValue='admin'";
				$rs=DB::query($sqlcmd);
				if(DB::getNumRows()>0){
					
					echo "<table class='grid' border=1><caption>Admins</caption><tr>";
					echo "<th>ID</th>";
					echo "<th colspan='2'>Full Name</th>";
					echo "<th>UserName</th>";
					echo "<th>Permission</th><tr>";
					while ($row=$rs->fetch_object()) {
						$rs1=DB::query("SELECT UserAccountAccessValue FROM UserAccountAccess WHERE UserAccountID=".$row->UserAccountID);
					$row1=$rs1->fetch_object();
						echo "<tr><td>".$row->UserAccountID."</td>";
						echo "<td>".$row->UserAccountFirstName."</td>";
						echo "<td>".$row->UserAccountLastName."</td>";
						echo "<td>".$row->UserAccountUserName."</td>";
						echo "<td>".$row1->UserAccountAccessValue."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				//------------------
				$sqlcmd="SELECT u.* FROM UserAccount AS u LEFT JOIN UserAccountType AS ut ON u.UserAccountID=ut.UserAccountID WHERE ut.UserAccountTypeValue='user'";
				$rs=DB::query($sqlcmd);
				if(DB::getNumRows()>0){
					echo "<table border=1><caption>Users</caption><tr>";
					echo "<th>ID</th>";
					echo "<th colspan='2'>Full Name</th>";
					echo "<th>UserName</th>";
					echo "<th>Email</th>";
					echo "<th>Gender</th></tr><tr>";
					while ($row=$rs->fetch_object()) {
						echo "<tr><td>".$row->UserAccountID."</td>";
						echo "<td>".$row->UserAccountFirstName."</td>";
						echo "<td>".$row->UserAccountLastName."</td>";
						echo "<td>".$row->UserAccountUserName."</td>";
						echo "<td>".$row->UserAccountEmail."</td>";
						echo "<td>".$row->UserAccountGender."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				echo "</div>";
			}
			else
				header("Location: index.php");
		?>
		
	</body>
</html>

