<?php
	include 'header.php';

?>
	<div class="d">
	<a href="index.php"><button>back to main</button></a>
							<?php
								$file=fopen("text ../file/lloric.txt","r") or die("Unable to open file!.");
								echo fread($file, filesize("text file/lloric.txt"));
								fclose($file);
							?>

	</div>