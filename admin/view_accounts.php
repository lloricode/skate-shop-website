<!DOCTYPE html>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			if(isset($_COOKIE['auth_account'])){ 
				require_once('../config.php');
				$sqlcmd="SELECT * FROM UserAccount";
				$rs=DB::query($sqlcmd);
				if(DB::getNumRows()>0){
					echo "<table border=1><tr>";
					echo "<th>ID</th>";
					echo "<th>First name</th>";
					echo "<th>Last name</th>";
					echo "<th>Gender</th></tr><tr>";
					while ($row=$rs->fetch_object()) {
						echo "<td>".$row->UserAccountID."</td>";
						echo "<td>".$row->UserAccountLastName."</td>";
						echo "<td>".$row->UserAccountFisrtName."</td>";
						echo "<td>".$row->UserAccountGender."</td>";
						echo "</tr><tr>";
					}
					echo "</tr></table>";
				}
			}
			else
				header("Location: index.php");
		?>
		<a href="index.php"><button>back to main</button></a>
	</body>
</html>

