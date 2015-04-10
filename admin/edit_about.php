<?php
	include 'php/header.php';
	if(!isset($_SESSION['auth_accountID']))
		header("Location: index.php");
	//include"../config.php";
	$lloric=$megan=$a1=$a2=$a3="";
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=14");
	$row=$rs->fetch_object();
	$a3=$row->DocumentValue;

	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=1");
	$row=$rs->fetch_object();
	$a1=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=2");
	$row=$rs->fetch_object();
	$a2=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=3");
	$row=$rs->fetch_object();
	$lloric=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=4");
	$row=$rs->fetch_object();
	$megan=$row->DocumentValue;
	if( isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		$a1=DB::esc($_POST["about1"]);
		$a2=DB::esc($_POST["about2"]);
		$a3=DB::esc($_POST["about3"]);
		$lloric=DB::esc($_POST["lloric"]);
		$megan=DB::esc($_POST["megan"]);
		DB::query("UPDATE Document SET DocumentValue='$a1' WHERE DocumentID=1");
		DB::query("UPDATE Document SET DocumentValue='$a2' WHERE DocumentID=2");
		DB::query("UPDATE Document SET DocumentValue='$a3' WHERE DocumentID=14");
		DB::query("UPDATE Document SET DocumentValue='$lloric' WHERE DocumentID=3");
		DB::query("UPDATE Document SET DocumentValue='$megan' WHERE DocumentID=4");
	}

?>
		<div class="d">
			<a href="index.php"><button class="btn">back to main</button></a>
			<form action="" method="post">
				<table>
					<tr>
						<td>about1</td><td><textarea placeholder="about1" rows="3" cols="48" name="about1" ><?php echo $a1; ?></textarea></td>
					</tr>
					<tr>
						<td>about2</td><td><textarea placeholder="about2" rows="3" cols="48" name="about2" ><?php echo $a2; ?></textarea></td>
					</tr>
					<tr>
						<td>about3</td><td><textarea placeholder="about3" rows="3" cols="48" name="about3" ><?php echo $a3; ?></textarea></td>
					</tr>
					<tr>
						<td>Lloric</td><td><textarea placeholder="lloric" rows="3" cols="48" name="lloric" ><?php echo $lloric; ?></textarea></td>
					</tr>
					<tr>
						<td>Megan</td><td><textarea placeholder="megan" rows="3" cols="48" name="megan" ><?php echo $megan; ?></textarea></td>
					</tr>
					<tr>
						<td></td><td><input class="btn" type="submit"  value="submit" required></td>
					</tr>
				</table>
			</form>
		</div>
<?php
	include"php/footer.php";
?>