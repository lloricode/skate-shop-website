<?php
	if(!isset($_COOKIE['auth_accountID']))
		header("Location: index.php");

	include 'header.php';?> <link rel="stylesheet" type="text/css" href="../css/style.css"><?
	if( isset($_COOKIE['auth_accountID']) and isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
		$contact_file="";
		if(isset($_POST['contact_file']))
			$contact_file=$_POST['contact_file'];//trim(stripcslashes(htmlspecialchars($_POST['contact_file'])));
		$file_=fopen("../text file/contact.txt", "w");
		fwrite($file_,$contact_file);
		fclose($file_);
	}
?>
	<div class="d">
		<a href="index.php"><button>back to main</button></a><BR>
		<div style="background:rgba(0,0,0,.4); height:698; width:750px; float:left;">
		<BR>
			<?php
				$file=fopen("../text file/contact.txt","r+") or die("Unable to open file!.");
				$afile=fread($file, filesize("../text file/contact.txt"));
				echo "$afile<BR>";
			?>
		</div>
		<div style="float:right;">
			<form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<textarea name="contact_file" rows="50" cols="80"><?=$afile;?></textarea><BR>
				<input type="submit" value="update">
			</form>
			<?fclose($file);?>
		</div>
	</div>