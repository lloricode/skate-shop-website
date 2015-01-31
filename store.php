<?php
	include 'main_style.php';
	include 'fresco_style.php';
	include 'header.php';
	include 'menu.php';
	include("config.php");
?>
		
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
			    <table ><!--id="t3">-->
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
				<div style="background-color:; height:1010px;">
					<? 		
					$dir=$q="";
					if(isset($_GET['query'])) 
						$q=$dir=$_GET['query'];
					if(isset($_GET['cat'])) 
						$dir=$dir.">".$_GET['cat'];
					if(isset($_GET['search']))
						$dir="product name searched";

					echo $dir."<BR>";
					if(isset($_COOKIE['sqle_error']))
						echo $_COOKIE['sqle_error'];
					
					include 'store_query.php';
					
					
					$prev=(isset($_GET['page']))?$_GET['page']:0;
					$nxt=($prev==0)?9:$prev*9;
					$prev=$nxt-9;

					$result =DB::query($query);
					$total_result=DB::getNumRows();
					if($total_result>0) echo ($prev+1)."-".(($total_result<$nxt)?$total_result:$nxt)." of ";echo "$total_result result.<BR>";
					
					$cat=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";   $q=(isset($_GET['query']))?"query=".$_GET['query']."&":""; 
				 	$page=(isset($_GET['page']))?$_GET['page']:1; 
				 	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":""; 
					if($ready){
						$query.=" ORDER BY ProductID LIMIT $prev,9";
						//echo "$query<BR>";
						$result =DB::query($query);
						
						if($brand){
							while($row=$result->fetch_object())
								echo $row->Brand."<BR>";
						}
						else{
							if(DB::getNumRows() > 0)
							{
								echo "<table id='table_'>";
								echo "<tr class='tableRow'>";
								for($int = 1; $row = $result->fetch_object(); $int++)
								{
									 ?>
									<td class="tableData">
										<div class="mardagz" style="background: url('img/product/<?= $row->ProductAttactment; ?>');background-repeat: no-repeat; background-size: cover;">
											<div class="details">
												<a href="img/product/<?= $row->ProductAttactment; ?>" class='fresco'
													data-fresco-group="product"
													data-fresco-caption="Name: <?= $row->ProductName; ?> <br />
													Price: &#8369;<?= $row->ProductPrice; ?>" >
													<div class="name tddiv">
														<span>ZOOM IMAGE</span>
													</div>
												</a>
												<a href="cart.php?<?=$q;?><?=$cat?><?=$srch?>file=<?= $row->ProductID?>&page=<?=$page?>">
													<div class="cart tddiv">
														<span>ADD TO CART</span>
													</div>
												</a>	<BR>
												<p style="color:white;">&nbsp;&nbsp;&nbsp;&nbsp; <?= $row->ProductID?>&nbsp;&nbsp; <?= $row->ProductName?> &nbsp;<b>|&nbsp; &#8369;<?= $row->ProductPrice?></b></p>
											</div>
										</div>
									</td>
									<?php
									if($int % 3 == 0)
										echo "</tr><tr class='tableRow'>";	
								}	
								echo "</tr></table>";
							}
							else
							{
								echo "No product";
								if(isset($_GET['search']))
									echo "<BR>for name \"".$_GET['search']."\".";
							}
						}
					} ?>
				</div>
				<div style="background-color:; height:30px; margin-top:50px;">
					<a href="cart.php?<?=$q;?><?=$cat?><?=$srch?>page=<?=$page?>">
						<div style="float:bottom; background-color:green; width:150px; height:50px;">
							<p>VIEW CART</p>
						</div>
					</a>
				</div>
				<div style="background-color:; height:30px; margin-top:5px;">
		<?php 		if(0==$prev) {?>
					<!--	<div style="float:left; background-color:orange; width:120px; height:45px">
							<p>PREV PAGE</p>
						</div> -->
		<?php 		}
					else{		?>
						<a href="store.php?<?=$q.$cat."page=".($page-1);?>">
							<div style="float:left; background-color:orange; width:120px; height:45px">
								<p>PREV PAGE</p>
							</div>
						</a>
			<?php 	}	
						

			 		if($total_result<=$nxt) {?>
				<!--		<div style="float:right; background-color:orange; width:120px; height:45px">
							<p>NEXT PAGE</p>
						</div>-->
		<?php 		}
					else{		?>
						<a href="store.php?<?=$q.$cat."page=".($page+1);?>">
							<div style="float:right; background-color:orange; width:120px; height:45px">
								<p>NEXT PAGE</p>
							</div>
						</a>
			<?php 	}	
						?>
				</div>
			</div>
		</center>
<?php
	include 'footer.php';
?>