<?php
	include 'main_style.php';
	include 'header.php';
	include 'menu.php';
	include("config.php");
	$sqlcmd="SELECT * FROM Product WHERE ProductID='".$_GET['file'] ."'";
	$rs=DB::query($sqlcmd);
?>
	<center>
		<div class="main_body">
			<div style="background-color:; height:1010px;">
		<?		if($row=$rs->fetch_object()){

					?>
					<div style="float:left; margin-left:50px; margin-top:50px; ">
						<img src="img/product/<?=$row->ProductAttactment?>" width="300" >
					</div>
					<div style="float:right; background-color:; width:450px; margin-top:50px;">
						<h2><?=$row->ProductName?></h2>
						<p>Brand: <b><?=$row->Brand?></b></p>
						<p>Price: &#8369;<b><?=$row->ProductPrice?></b></p>
						<p>Gender: <b><?=$row->ProductGender?></b></p>
					</div>
		<?		}
				else{
					header("Location: store.php?query=all");
				}

					?>
			</div>
			<div style="background-color:; height:30px; margin-top:50px;">
			<?$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";$p=$_GET['page'];
			$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":""; ?>
				<a href="store.php?<?=$q?><?=$srch?><?=$c?>page=<?=$p?>">
					<div style="float:bottom; background-color:green; width:150px; height:50px;">
						<p>BACK</p>
					</div>
				</a>
			</div>
		</div>
	</center>
<?php
	include 'footer.php';
?>