<?php
	$docfile="about";
	include 'php/main_style.php';
	include 'php/header.php';
	include 'php/menu.php';
?>
			<!--              -->
	<!-- <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=980016378690875&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
-->
		
	<!--              -->
		<center>
			<div class="main_body" >
				<div class="aboutUp">
					<div class="aleft">
						<br />
						<h1 style="float:left">&nbsp;&nbsp;&nbsp;WHO ARE WE?</h1>
						<img src="<?php echo $ri->w("img/about.jpg",300) ?>" >
						
						
					</div>
					<div class="aright">
						<br /><br /><br /><br />
						<p>
							<?php
								$file=fopen("text file/about.txt","r") or die("Unable to open file!.");
								echo fread($file, filesize("text file/about.txt"));
								fclose($file);
							?>
						</p>
						<p>
							<?php
								$file=fopen("text file/about2.txt","r") or die("Unable to open file!.");
								echo fread($file, filesize("text file/about2.txt"));
								fclose($file);
							?>
						</p>
						<!-- fb like-->
						<div class="fb-like" data-href="/webdev/index.php" data-layout="standard" data-action="like" data-show-faces="true" data-share="true">
			
						</div>
					</div>
				</div>
				<div>
						<div class="anamel">
							<p style="font-size:25px; margin-top:10px;">LLORIC <b>GARCIA</b></p>
						</div>

						<div class="anamer">
							<p style="font-size:25px; margin-top:10px;">MEGAN HAYRANA <b>TORLAO</b></p>
						</div>
				</div>
				<div > 
					<div class="aleft" style="background-color:#363636">
						<img src="<?php echo $ri->w("img/icon2.jpg",300) ?>" style="margin-top:30px;">
						<p>
							<?php
								$file=fopen("text file/lloric.txt","r") or die("Unable to open file!.");
								echo fread($file, filesize("text file/lloric.txt"));
								fclose($file);
							?>
						</p>
					</div>
					<div class="aright" style="background:#252525; ">
						<img src="<?php echo $ri->w("img/samurai.jpg",300) ?>" style="margin-top:30px;">
						<p>
							<?php
								$file=fopen("text file/megan.txt","r") or die("Unable to open file!.");
								echo fread($file, filesize("text file/megan.txt"));
								fclose($file);
							?>
						</p>
					</div>
				</div>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>