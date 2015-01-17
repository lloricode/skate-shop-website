<?php
	include 'header.php';
	include("config.php");
?>
		<div style="background-color:black; height:90;">
			<center>
				<div class="menu">
			    	<table id="t1">
		                <tr style="font-size:30px; ">
		                    <td id="tdpad">
		                    	<a href="index.php" >
		                    		<div id="menuH" >
		                    			HOME
		                    		</div> 
		                    	</a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="store.php?query=all">
		                    		<div id="menuH">
		                    			STORE
		                    		</div>
		                    	</a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="contact.php">
		                    		<div id="menuH">
		                    			CONTACT
		                    		</div>
		                    	</a>
		                    </td>
		                    <td id="tdpad">
		                    	<a href="about.php">
		                    		<div id="menuH">
		                    			ABOUT
		                    		</div> 
		                    	</a>
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
			<div class="menu2">
			    <table id="t2">
	                <tr style="font-size:30px">
	                    <td id="tdpad2">
	                        <a href="store.php?query=sale">
	                        	<div >
	                        		SALE
	                        	</div>
	                        </a>
	                    </td>
	                    <td id="tdpad2">
	                        <a href="store.php?query=male">
	                        	<div>
	                        		MALE
	                        	</div> 
	                        </a>
	                    </td>
	                    <td id="tdpad2">
	                        <a href="store.php?query=female">
	                        	<div>
	                        		FEMALE
	                        	</div>  
	                        </a>
	                    </td>
	                    <td id="tdpad2">
	                        <a href="store.php?query=brands">
		                        <div>
		                        	BRANDS
		                        </div>
	                        </a>
	                    </td>
	                </tr>
	            </table>
			</div>
			<?php
				$actualURL = "http://localhost/webdev/pages/store.php?". isset($_GET["query"]) ? "query=" . $_GET["query"] : "";
			?>
			<div class="menu3">
			    <table id="t3">
	                <tr style="font-size:25px">
	                    <td id="tdpad3">
	                        <a href="<?= $actualURL; ?>&cat=shoes">
	                        	SHOES 
	                        </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="<?= $actualURL; ?>&cat=jackets">JACKETS </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="<?= $actualURL; ?>&cat=tees">TEES </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="<?= $actualURL; ?>&cat=jeans">JEANS </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="<?= $actualURL; ?>&cat=shorts">SHORTS </a>
	                    </td>
	                </tr>
	            </table>
			</div>
			<div class="main_body">
			<p>aaaa</p>
				<BR>
				<table id="table_">
					<?php

						if($_GET)
						{
							$gender = $_GET["query"];
						}
							$query = "";
							if(isset($_GET["query"]))
							{
								$query = "SELECT * FROM Product WHERE ProductGender = '$gender'";
							}else if(isset($_GET["cat"]))
							{
								$cat = $_GET["cat"];
								$query = "SELECT * FROM Product WHERE ProductGender = '$gender' AND ProductType = '$cat'";
							}
							$result =DB::query($query);
							if(DB::getNumRows() > 0)
							{
								?>
								<tr class="tableRow">
									<?php
									for($int = 1; $row = $result->fetch_object(); $int++)
									{
										?>
								            <td class="tableData">
								                <div class="mardagz" style="background: url('../img/product/<?= $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
								                    <div class="details">

								                        <a href="../img/product/<?= $row->ProductAttactment; ?>"
														     class='fresco'
														     data-fresco-group='pages'
								                        	data-fresco-group='product' 
								                        	data-fresco-caption="Name: <?= $row->ProductName; ?> <br /> 
								                        						Price: ₱<?= $row->ProductPrice; ?> ">
								                        		 <div class="name tddiv">
									                            <span>ZOOM IMAGE</span>
									                        </div>
								                        </a>
								                        <div class="cart tddiv">
								                            <span>ADD TO CART</span>
								                        </div><BR>
								                        <p style="color:white;">&nbsp&nbsp&nbsp&nbsp <?= $row->ProductName?> &nbsp<b>|&nbsp ₱<?= $row->ProductPrice?></b></p>
								                    </div>
								                </div>
								            </td>
										<?php
										if($int % 3 == 0)
										{
											?>
												</tr><tr class="tableRow">	
											<?php
										}
										if($int==9)
											break;
									}	
							}
							else
							{
								echo "No product";
							}
						
					?>
					
				</table>
				<BR><BR><BR>
				<table style="margin-top:-10px">
					<tr style="font-size:25px;">
						<td id="nptdpad">
							<a href="#">
								<div class="prev tddiv">
									PREV
								</div>
							</a>
						</td>
						<td id="nptdpad">
							<a href="#">
								<div class="prev tddiv">
									VIEW CART
								</div>
							</a>
						</td>
						<td id="nptdpad">
							<a href="#">
								<div class="prev tddiv">
									NEXT
								</div>
							</a>
						</td>
					</tr>
				</table>
			</div>
		</center>
<?php
	include 'footer.php';
?>