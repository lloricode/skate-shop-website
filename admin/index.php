<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */


		include 'php/header.php';
		if(!isset($_SESSION['auth_accountID']))
		{
			?>
			<div class="d">
			<form method="POST" action="php/login.php">
				<input class="inputs" type="text" placeholder="Username" name="user" value="q"/>
				<input class="inputs" type="password" placeholder="Password" name="pass" value="q" />
				<input class="btn" type="submit" value="Login" />
			</form>
			</div>
			<?php
		}
		else
		{?>
			<div  class="d">
				<a href="visit.php"><button class="btn">view visit</button></a><br />
				<a href="orders.php"><button class="btn">view orders</button></a><br />
				<a href="delivered.php"><button class="btn">view delivered Status</button></a><br />
				<a href="solds.php"><button class="btn">view product solds</button></a><br />
				<a href="view_accounts.php"><button class="btn">view accounts</button></a><br />
				<a href="view_product.php"><button class="btn">view product</button></a><br />
				<a href="edit_about.php"><button class="btn">add/edit document in ABOUT</button></a><br />
				<a href="edit_contact.php"><button class="btn">add/edit document in CONTACT</button></a><br />
				<a href="../SKATESHOP.pdf" target="blank_"><button class="btn">view documentation</button></a><br />
				<a href="php/tt.php"><button class="btn">linisin!!</button></a>
			</div>
			<?php
		}
	include"php/footer.php";
	?>