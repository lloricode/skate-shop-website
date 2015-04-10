<?php
	include 'php/header.php';
	if(!isset($_SESSION['auth_accountID']))
		header("Location: index.php");
	//include"../config.php";
	$d1=$d2=$d3=$d4="";
	$v1=$v2=$v3=$v4="";
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=5");
	$row=$rs->fetch_object();
	$d1=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=6");
	$row=$rs->fetch_object();
	$d2=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=7");
	$row=$rs->fetch_object();
	$d3=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=8");
	$row=$rs->fetch_object();
	$d4=$row->DocumentValue;

	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=10");
	$row=$rs->fetch_object();
	$v1=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=11");
	$row=$rs->fetch_object();
	$v2=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=12");
	$row=$rs->fetch_object();
	$v3=$row->DocumentValue;
	$rs=DB::query("SELECT DocumentValue FROM Document WHERE DocumentID=13");
	$row=$rs->fetch_object();
	$v4=$row->DocumentValue;
	if( isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		$d1=DB::esc($_POST["d1"]);
		$d2=DB::esc($_POST["d2"]);
		$d3=DB::esc($_POST["d3"]);
		$d4=DB::esc($_POST["d4"]);
		$v1=DB::esc($_POST["v1"]);
		$v2=DB::esc($_POST["v2"]);
		$v3=DB::esc($_POST["v3"]);
		$v4=DB::esc($_POST["v4"]);
		DB::query("UPDATE Document SET DocumentValue='$d1' WHERE DocumentID=5");
		DB::query("UPDATE Document SET DocumentValue='$d2' WHERE DocumentID=6");
		DB::query("UPDATE Document SET DocumentValue='$d3' WHERE DocumentID=7");
		DB::query("UPDATE Document SET DocumentValue='$d4' WHERE DocumentID=8");
		DB::query("UPDATE Document SET DocumentValue='$v1' WHERE DocumentID=10");
		DB::query("UPDATE Document SET DocumentValue='$v2' WHERE DocumentID=11");
		DB::query("UPDATE Document SET DocumentValue='$v3' WHERE DocumentID=12");
		DB::query("UPDATE Document SET DocumentValue='$v4' WHERE DocumentID=13");
	}

?>
		<div class="d">
			<a href="index.php"><button class="btn">back to main</button></a>
			<form action="" method="post">
				<table>
					<tr>
						<td>value1</td><td><input class="text" type="text" name="d1" value="<?php echo $d1; ?>"><br />
						<textarea placeholder="value1" rows="3" cols="48" name="v1" ><?php echo $v1; ?></textarea></td>
					</tr>
					<tr>
						<td>value2</td><td><input class="text" type="text" name="d2" value="<?php echo $d2; ?>"><br />
						<textarea placeholder="value2" rows="3" cols="48" name="v2" ><?php echo $v2; ?></textarea></td>
					</tr>
					<tr>
						<td>value3</td><td><input class="text" type="text" name="d3" value="<?php echo $d3; ?>"><br />
						<textarea placeholder="value3" rows="3" cols="48" name="v3" ><?php echo $v3; ?></textarea></td>
					</tr>
					<tr>
						<td>value4</td><td><input class="text" type="text" name="d4" value="<?php echo $d4; ?>"><br />
						<textarea placeholder="value4" rows="3" cols="48" name="v4" ><?php echo $v4; ?></textarea></td>
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