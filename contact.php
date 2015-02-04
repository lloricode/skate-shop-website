<?php
	include 'main_style.php';
	include 'header.php';
	include 'menu.php';
?>
		
		<center>
			<div class="main_body" >
				<div style="background:rgba(0,0,0,.2); height:1079px; width:750px;">
				<BR>
					<?php
						$file=fopen("text file/contact.txt","r") or die("Unable to open file!.");
						echo fread($file, filesize("text file/contact.txt"));
						fclose($file);
					?>
				</div>
				<div style="background:rgba(0,0,0,.6); height:70px; width:900px;">
					CHECK US OUT ON SOCIAL MEDIA:
					<table>
						<tr>
							<td class="social"><a href="#" target="blank_"><div class="media" style="background-color:#0066FF; ">facebook</div></a></td>
							<td class="social"><a href="#" target="blank_"><div class="media" style="background-color:#00FFFF; ">twitter</div></a></td>
							<td class="social"><a href="#" target="blank_"><div class="media" style="background-color:#CC0000; ">google plus</div></a></td>
						</tr>
					</table>
				</div>
			</div>
		</center>
<?php
	include 'footer.php';
?>