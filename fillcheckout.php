<?php
	$docfile="fill";
	include 'php/main_style.php';
	include"php/datepicker.php";
	if(!isset($_SESSION['authID'])){
		header("Location: login.php");
	}
	include"php/header.php";
	include 'php/menu.php';


?>

				<center>
			<div class="main_body"><br />
			<?php
				if(isset($_COOKIE["paid"])){
					setcookie("paid","",time()-10,"/");?>
					<h1>Thanks for shopping!</h1>
		<?php	}
				else{
						//include"config.php";
						DB::query("SELECT CartPurchased as a FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION["authID"]."'");
						if(DB::getNumRows()>0){
			?>
				<form action="php/checkout.php" method="post">
					<table>
						<tr>
							<td>Credit Card Number:</td><td><input type="text" name="card" value="<?php if(isset($_COOKIE["card"])){ echo $_COOKIE["card"]; setcookie("card","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["cardrr"])){ echo $_COOKIE["cardrr"]; setcookie("cardrr","",time()-10,"/");} ?></span></td>
						</tr>
						<tr>
							<td>Expiration Date:</td><td><input type="date" id="datepicker" name="expire" value="<?php if(isset($_COOKIE["expire"])){ echo $_COOKIE["expire"]; setcookie("expire","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["expirerr"])){ echo $_COOKIE["expirerr"]; setcookie("expirerr","",time()-10,"/");} ?></span></td>
						</tr>
						<tr>
							<td>Card Security Code:</td><td><input type="text" name="secure" value="<?php if(isset($_COOKIE["secure"])){ echo $_COOKIE["secure"]; setcookie("secure","",time()-10,"/");} ?>" ></td>
							<td><span id="err"><?php if(isset($_COOKIE["securerr"])){ echo $_COOKIE["securerr"]; setcookie("securerr","",time()-10,"/");} ?></span></td>
						</tr>
						<tr>
							<td></td><td><input type="submit" value="CHECKOUT"></td>
						</tr>
					</table>
					<br />
<table><tr> <input type="hidden" name="ss" value="<?php echo $chk_item; ?>">
			<?php
				for ($i=0;$i<sizeof($chk_item);$i++) {
					$rs=DB::query("SELECT c.*,p.ProductAttactment FROM Cart AS c LEFT JOIN Product AS p ON c.ProductID=p.ProductID WHERE c.CartID=".$chk_item[$i]);
					$row=$rs->fetch_object();
					?><td><img src="<?php echo  $ri->w("img/product/".$row->ProductAttactment,100); ?>"></td><?php
				}
			?>
</tr></table>
				</form>
		<?php 			}
						else
							header("Location: index.php");
				} ?>
			</div>
		</center>

<?php
	include"php/footer.php";
?>