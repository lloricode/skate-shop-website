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
							<input type="text" id="input" height="100px" placeholder="PRODUCT NAME.." name="search">
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
				$actualURL = /*"http://localhost/webdev/pages/store.php?".*/ isset($_GET["query"]) ? "query=" . $_GET["query"] : "query=all";
			?>
			<div class="menu3">
			    <table id="t3">
	                <tr style="font-size:25px">
	                    <td id="tdpad3">
	                        <a href="store.php?<?= $actualURL; ?>&cat=shoes" >
	                        	SHOES 
	                        </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="store.php?<?= $actualURL; ?>&cat=jackets">
	                        	JACKETS  
	                        </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="store.php?<?= $actualURL; ?>&cat=tees">
	                        	TEES 
	                        </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="store.php?<?= $actualURL; ?>&cat=jeans">
	                        	JEANS 
	                        </a>
	                    </td>
	                    <td id="tdpad3">
	                        <a href="store.php?<?= $actualURL; ?>&cat=shorts">
	                        	SHORTS 
	                        </a>
	                    </td>
	                </tr>
	            </table>
			</div>
			<div class="main_body">
			<p><? 		$dir="";
							if(isset($_GET['query'])) 
								$dir=$_GET['query'];
							if(isset($_GET['cat'])) 
								$dir=$dir.">".$_GET['cat'];
							if(isset($_GET['search']))
								$dir="product name searched";

							echo $dir;
					?></p>
				<BR>
				<div style="background-color:; height:1010px;">
					<table id="table_">
						<?php
								$ready=1;$brand=0;
								if(isset($_GET['cat'])){
									if($_GET['cat']=="shoes"){
										if($_GET['query']=="sale"){
											$query="SELECT * FROM Product WHERE Sale=1 AND ProductType='shoes'";
										}
										else if($_GET['query']=="male"){
											$query="SELECT * FROM Product WHERE ProductGender='male' AND ProductType='shoes'";
										}
										else if($_GET['query']=="female"){
											$query="SELECT * FROM Product WHERE ProductGender='female' AND ProductType='shoes'";
										}
										else if($_GET['query']=="all"){
											$query="SELECT * FROM Product WHERE ProductType='shoes'";
										}
										else{
											echo "error query";
											$ready=0;
										}
									}
									if($_GET['cat']=="jackets"){
										if($_GET['query']=="sale"){
											$query="SELECT * FROM Product WHERE Sale=1 AND ProductType='jackets'";
										}
										else if($_GET['query']=="male"){
											$query="SELECT * FROM Product WHERE ProductGender='male' AND ProductType='jackets'";
										}
										else if($_GET['query']=="female"){
											$query="SELECT * FROM Product WHERE ProductGender='female' AND ProductType='jackets'";
										}
										else if($_GET['query']=="all"){
											$query="SELECT * FROM Product WHERE ProductType='jackets'";
										}
										else{
											echo "error query";
											$ready=0;
										}
									}
									if($_GET['cat']=="tees"){
										if($_GET['query']=="sale"){
											$query="SELECT * FROM Product WHERE Sale=1 AND ProductType='tees'";
										}
										else if($_GET['query']=="male"){
											$query="SELECT * FROM Product WHERE ProductGender='male' AND ProductType='tees'";
										}
										else if($_GET['query']=="female"){
											$query="SELECT * FROM Product WHERE ProductGender='female' AND ProductType='tees'";
										}
										else if($_GET['query']=="all"){
											$query="SELECT * FROM Product WHERE ProductType='tees'";
										}
										else{
											echo "error query";
											$ready=0;
										}
									}
									if($_GET['cat']=="jeans"){
										if($_GET['query']=="sale"){
											$query="SELECT * FROM Product WHERE Sale=1 AND ProductType='jeans'";
										}
										else if($_GET['query']=="male"){
											$query="SELECT * FROM Product WHERE ProductGender='male' AND ProductType='jeans'";
										}
										else if($_GET['query']=="female"){
											$query="SELECT * FROM Product WHERE ProductGender='female' AND ProductType='jeans'";
										}
										else if($_GET['query']=="all"){
											$query="SELECT * FROM Product WHERE ProductType='jeans'";
										}
										else{
											echo "error query";
											$ready=0;
										}
									}
									if($_GET['cat']=="shorts"){
										if($_GET['query']=="sale"){
											$query="SELECT * FROM Product WHERE Sale=1 AND ProductType='shorts'";
										}
										else if($_GET['query']=="male"){
											$query="SELECT * FROM Product WHERE ProductGender='male' AND ProductType='shorts'";
										}
										else if($_GET['query']=="female"){
											$query="SELECT * FROM Product WHERE ProductGender='female' AND ProductType='shorts'";
										}
										else if($_GET['query']=="all"){
											$query="SELECT * FROM Product WHERE ProductType='shorts'";
										}
										else{
											echo "error query";
											$ready=0;
										}
									}
								}
								else if(isset($_GET['search']))
									$query="SELECT * FROM Product WHERE ProductName='".$_GET['search']."'";
								else{
									if($_GET['query']=="all"){
										$query="SELECT * FROM Product";
									}
									else if($_GET['query']=="sale"){
										$query="SELECT * FROM Product WHERE Sale=1";
									}
									else if($_GET['query']=="male"){
										$query="SELECT * FROM Product WHERE ProductGender='male'";
									}
									else if($_GET['query']=="female"){
										$query="SELECT * FROM Product WHERE ProductGender='female'";
									}
									else if($_GET['query']=="brands"){
										$query="SELECT DISTINCT Brand FROM Product";
										$brand=1;
									}
									else{
										echo "error query";
										$ready=0;
									}
								}

								if($ready){
									$result =DB::query($query);
									if($brand){
										while($row=$result->fetch_object()){
											echo $row->Brand."<BR>";
										}
									}
									else
									if(DB::getNumRows() > 0)
									{
										?>
										<tr class="tableRow">
											<?php
											for($int = 1; $row = $result->fetch_object(); $int++)
											{
												?>
										            <td class="tableData">
										                <div class="mardagz" style="background: url('img/product/<?= $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
										                    <div class="details">
										                    	 <a href="img/product/<?= $row->ProductAttactment; ?>" class='fresco'
																    data-fresco-group="product" 

										                        	data-fresco-caption="Name: <?= $row->ProductName; ?> <br /> 
										                        						Price: ₱<?= $row->ProductPrice; ?>" >
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
										if(isset($_GET['search']))
											echo "<BR>for name \"".$_GET['search']."\".";
									}
								}
							
						?>
						
					</table>
				</div>
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