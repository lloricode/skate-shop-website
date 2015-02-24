<?php
	$docfile="setting";
	include 'php/main_style.php';
	include 'php/header.php';
	include 'php/menu.php';
?>
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
						echo "<form action='php/updateimage.php' method='post' enctype='multipart/form-data'>
							<label>Browse image</label><input type='file' name='imgfile'>
							<input type='submit' value='update image'>
						</form>";
					}
					else
						header("Location: index.php") 
				?>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>