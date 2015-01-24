<?php
include 'main_style.php';
include 'bootstrap_style.php';
include 'header.php';
?>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu" >
			    	<table id="t1">
		                <tr style="font-size:30px; ">
		                    <td id="tdpad">
		                    	<a href="index.php" ><div id="menuH">HOME</div> </a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="store.php?query=all"><div id="menuH">STORE</div> </a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="contact.php"><div id="menuH">CONTACT</div> </a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="about.php"><div id="menuH">ABOUT</div> </a>
		                    </td>
		                </tr>
		            </table>
					<form action="" >
						<span style="float:right">
							<input type="text" id="input" height="100px" value="PRODUCT NAME..">
						</span>
					</form>
				</div>
			</center>
		</div>
		<center>
			<div class="main_body" style="margin-top:1px;">
			<!--            ##################################################-->
				<div class="container">
					<div class="jumbotron">
			            <h1>My First Bootstrap Page</h1>
			            <p>Resize this responsive page to see the effect!</p> 
			        </div>

					<div id="myCarousel" class="carousel slide" data-ride="carousel">
				 
						<?php
							include("config.php");
							$sqlcmd="SELECT * FROM Product LIMIT 2";
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
							}
						?>
					</div>
				 	
				</div>
				  <!--             #############################################-->
			</div>
		</center>

<?php
include 'footer.php';
?>