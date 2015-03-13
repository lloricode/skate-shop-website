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
				$rs=DB::query("SELECT *,(ProductSoldSmall+ProductSoldMedium+ProductSoldLarge) AS sold FROM Product ORDER BY sold DESC,ProductID ASC");
				if(DB::getNumRows()>0){
					echo "<table class='grid' border=1><tr><th>ProductID</th><th>image</th><th>ProductName</th><th>Sold</th></tr>";
					for ($i=1;$row=$rs->fetch_object();$i++) {
						echo "<tr><td>$row->ProductID</td><td><img src='../img/product/$row->ProductAttactment' width='100' /></td><td>$row->ProductName</td><td>$row->sold</td></tr>";
					}
					echo "</table>";
				}
			?>
			</div>
			<?php
		}
	?>
	</body>
</html>
