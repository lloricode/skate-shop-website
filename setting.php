<?php
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
				<BR><BR><BR>
				<?php
					if(isset($_COOKIE['authFn'])){ ?>
						<p>Hello! <?=$_COOKIE['authFn']." ".$_COOKIE['authLn']?>!</p>
						<?php 
						if(isset($_COOKIE['tmp']))
							 echo $_COOKIE['tmp']."<BR>";
						echo "<img src='./img/UserImage/".$_COOKIE['authImg']."' alt='' height='300' >";
						echo "<form action='updateimage.php' method='post' enctype='multipart/form-data'>
							<label>Browse image</label><input type='file' name='imgfile'>
							<input type='submit' value='update image'>
						</form>";
					}
					else
						echo "please log in first.."; 
				?>
			</div>
		</center>
<?php
	include 'footer.php';
?>