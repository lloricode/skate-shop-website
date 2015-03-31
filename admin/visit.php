<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */


		include 'php/header.php';
		if(!isset($_SESSION['auth_accountID']))
		{
			
			header("Location: index.php");
		}
		else
		{ //  include"../config.php"; 

			$rs=DB::query("SELECT * FROM Visit ORDER BY count DESC");
	?>
			<div  class="d"><a href="index.php"><button>back to main</button></a>
		<?php
			if(DB::getNumRows()){
				echo "<table>";
				while($row=$rs->fetch_object()){
					echo "<tr><td>$row->doc</td><td>$row->count</td></tr>";
				}
				echo"</table>";
			}
		?>
			</div>
			<?php
		}
	?>
	</body>
</html>
