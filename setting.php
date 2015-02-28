<?php
	$docfile="setting";
	include 'php/main_style.php';
	include 'php/header.php';
	include 'php/menu.php';
?>
		<center>
			<div class="main_body" style="margin-top:1px;">
				<br /><br /><br />
				<?php
					if(isset($_SESSION['authFn'])){ ?>
						<p>Hello! <?php echo $_SESSION['authFn']." ".$_SESSION['authLn']?>!</p>
						<?php
						if(isset($_SESSION['tmp']))
							 echo $_SESSION['tmp']."<br />";
						echo "<img src='./img/UserImage/".$_SESSION['authImg']."' alt='' height='300' >";
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