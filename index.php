<?php
	$docfile="index";
include 'php/main_style.php';
//include 'php/bootstrap_style.php';
include 'php/header.php';
include 'php/menu.php';
?>
		
		<center>
			<div class="main_body">
				<div style="width:350px; padding-top:20px; ">
			<!--            ################################################ 
				

					<div id="myCarousel" class="carousel slide" data-ride="carousel">
				 
						<?php
						/*
							include("config.php");
							$sqlcmd="SELECT * FROM Product ";
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
									echo "<img src='img/product/".$row->ProductAttactment."' alt='image not found'></div>";
								}
								echo "</div>";
							}*/
						?>
				 	</div>
			#############################################-->
				</div>
			</div>
		</center>

<?php
include 'php/footer.php';
?>