<?php
/**
 * @author Lloric Garcia
 * @copyright 2015
 */


		include 'php/header.php';
		if(!isset($_SESSION['auth_accountID']))
		{
			?>
			<form method="POST" action="php/login.php">
				<input type="text" placeholder="Username" name="user" />
				<input type="password" placeholder="Password" name="pass" />
				<input type="submit" value="Login" />
			</form>
			<?php
		}
		else
		{?>
			<div  class="d">
			<a href="visit.php"><button>view visit</button></a><br />
			<a href="orders.php"><button>view orders</button></a><br />
			<a href="delivered.php"><button>view delivered Status</button></a><br />
			<a href="solds.php"><button>view product solds</button></a><br />
			<a href="view_accounts.php"><button>view accounts</button></a><br />
			<a href="view_product.php"><button>view product</button></a><br />
			<a href="edit_about.php"><button>add/edit document in ABOUT</button></a><br />
			<a href="edit_contact.php"><button>add/edit document in CONTACT</button></a><br />
			<a href="../SKATESHOP.pdf" target="blank_"><button>view documentation</button></a><br />
			<a href="php/tt.php"><button>linisin!!</button></a>
			</div>
			<?php
		}
	?>
	</body>
</html>
