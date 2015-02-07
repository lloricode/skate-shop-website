		<div style="background-color:black; height:90;">
			<center>
				<div class="menu">
		            <div style="float:left;margin-top:3px;">
		           	<ul id="navlist">
						<li id="mainmenu" <?=($docfile=="index")?"class='active_menu'":""?> ><a href="index.php" id="current">HOME</a></li>
						<li id="mainmenu" <?=($docfile=="store")?"class='active_menu'":""?> ><a href="store.php?query=all">STORE</a></li>
						<li id="mainmenu" <?=($docfile=="contact")?"class='active_menu'":""?> ><a href="contact.php">CONTACT</a></li>
						<li id="mainmenu" <?=($docfile=="about")?"class='active_menu'":""?> ><a href="about.php">ABOUT</a></li>
					</ul>
					</div>
					<form action="store.php" >
						<span style="float:right">
							<input type="text" id="input" height="100px" placeholder="PRODUCT NAME.." name="search">
						</span>
					</form>
				</div>
			</center>
		</div>