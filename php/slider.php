<?php include"../top-cache.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sale</title>
        <link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
		<script src="../js/bootstrap/jquery.min.js"></script>
		<script src="../js/bootstrap/bootstrap.min.js"></script> 
       	<meta name="robots" content="noindex,nofollow" />
	</head>
	<body>
		<div style="width:350px; padding-top:20px; ">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<?php
					$tmp_dir="../";
					include("../config.php");
					$sqlcmd="SELECT ProductAttactment,ProductName FROM Product WHERE ProductSale=1";
					$rs=DB::query($sqlcmd);
					if(DB::getNumRows()>0){
						echo "<ol class='carousel-indicators'><li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
						for ($i=1; $i < DB::getNumRows(); $i++) 
							echo "<li data-target='#myCarousel' data-slide-to='$i'></li>";
						echo "</ol><div class='carousel-inner' role='listbox'>";
						for ($ii=0; $row = $rs->fetch_object(); $ii++){
							if($ii!=0)
								echo"<div class='item'>";
							else
								echo "<div class='item active'>";
							echo "<img src='". $ri->h("../img/product/".$row->ProductAttactment,260,"../")."' alt='$row->ProductName'></div>";
						}
						echo "</div>";
					}
				?>
			</div>
		</div>
	</body>
</html>
<?php include"../bottom-cache.php"; ?>