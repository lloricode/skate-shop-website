		<div style="background-color:#101010; height:90;">
			<center>
				<div class="menu">
		            <div style="float:left;margin-top:3px;">
		           	<ul id="navlist">
						<li id="mainmenu" <?php echo($docfile=="index")?"class='active_menu'":""?> ><a href="index.php" id="current">HOME</a></li>.
						<li id="mainmenu" <?php echo($docfile=="store")?"class='active_menu'":""?> ><a href="store.php?query=all">STORE</a></li>.
						<li id="mainmenu" <?php echo($docfile=="contact")?"class='active_menu'":""?> ><a href="contact.php">CONTACT</a></li>.
						<li id="mainmenu" <?php echo($docfile=="about")?"class='active_menu'":""?> ><a href="about.php">ABOUT</a></li>.
						<li id="mainmenu" <?php echo($docfile=="mycart")?"class='active_menu'":""?> ><a href="mycart.php">CART</a></li>
					</ul>
					</div>
					<form action="store.php" >
						<span style="float:right">
							<input type="text" class="txtF" height="100px" placeholder="SEARCH ITEM" name="search">
							<input style="margin-left:0px" type="submit" value="GO">
						</span>
					</form>
				</div>
			</center>
		</div>