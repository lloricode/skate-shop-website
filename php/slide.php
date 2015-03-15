<?php include"../top-cache.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Skate Apparel</title>
        <link href="../img/icon.jpg" rel="shortcut icon" type="image/x-icon" />
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/slider/style.css" type="text/css">
		<script src="../js/slider/jquery.js"></script>
	  	<script src="../js/slider/script.js"></script>
	  	<?php $slide=6; $tmp_dir="../"; include"../config.php"; ?>
	</head>
	<body>
	   	<div class="sheet">
			<header class="header">
				<div class="slider slidecontainerheader" data-width="900" data-height="350">
				    <div class="slider-inner">
				    <?php
				    	for ($i=1; $i <=$slide ; $i++) {?>
				    		<a class="slide-item slideheader<?php echo ($i-1); ?>">
								<img src="<?php echo $ri->wh("../img/slide images/".$i.".jpg",800,350);?>" >
							</a>
				 <?php  }
				    ?>
						
				    </div>
				</div>
				<div class="slidenavigator slidenavigatorheader" data-left="177.5">
					<?php
						for ($i=0; $i <$slide ; $i++) {?>
							<a href="#" class="slidenavigatoritem"></a>
					<?php	}
					?>
				</div>
			</header>
		</div>
	</body>
</html>
<?php include"../bottom-cache.php"; ?>