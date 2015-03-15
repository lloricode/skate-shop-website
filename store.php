<?php
	$docfile="store";
	include 'php/main_style.php';
	include 'php/fresco_style.php';
	include 'php/header.php';
	include 'php/menu.php';
	//include "config.php";
?>
		
		<center>
			<div class="menu2" >
            	<ul id="navlist2" style="padding-top:9px;">
	            <?php if(isset($_GET['query'])) 
						$qq=$_GET['query'];
					else
						$qq="";?>
					<li id="mainmenu2" <?php if(isset($qq)){ if($qq=="sale") echo "class='active_menu2'"; }?> ><a href="store.php?query=sale" >SALE</a></li>
					<li id="mainmenu2" <?php if(isset($qq)){ if($qq=="male") echo "class='active_menu2'"; }?> ><a href="store.php?query=male">MALE</a></li>
					<li id="mainmenu2" <?php if(isset($qq)){ if($qq=="female") echo "class='active_menu2'"; }?> ><a href="store.php?query=female">FEMALE</a></li>
				<!--	<li id="mainmenu2" <?php if(isset($qq)){ if($qq=="brand") echo "class='active_menu2'"; }?> ><a href="store.php?query=brands">MISC</a></li>
				--></ul>
			</div>
			<?php
				$actualURL = isset($_GET["query"]) ? "query=" . $_GET["query"] : "query=all";
			?>
			<div class="menu3">
	            <ul id="navlist3" style="margin-top:0px; padding-top:8px;">
	            <?php if(isset($_GET['cat'])) 
						$qq=$_GET['cat'];
					else
						$qq="";
					?>

					<li id="mainmenu3" ><a <?php if(isset($qq)){ if($qq=="shoes") echo "class='active_menu3'"; }?> href="store.php?<?php echo  $actualURL; ?>&cat=shoes">SHOES</a></li>
					<li id="mainmenu3" ><a <?php if(isset($qq)){ if($qq=="jackets") echo "class='active_menu3'"; }?> href="store.php?<?php echo  $actualURL; ?>&cat=jackets">JACKETS</a></li>
					<li id="mainmenu3" ><a <?php if(isset($qq)){ if($qq=="tees") echo "class='active_menu3'"; }?> href="store.php?<?php echo  $actualURL; ?>&cat=tees">TEES</a></li>
					<li id="mainmenu3" ><a <?php if(isset($qq)){ if($qq=="jeans") echo "class='active_menu3'"; }?> href="store.php?<?php echo  $actualURL; ?>&cat=jeans">JEANS</a></li>
					<li id="mainmenu3" ><a <?php if(isset($qq)){ if($qq=="shorts") echo "class='active_menu3'"; }?> href="store.php?<?php echo  $actualURL; ?>&cat=shorts">SHORTS</a></li>
				</ul>
			</div>
			<div class="main_body">
				<div style="background-color:; height:1010px;">
					<?php 		
					$dir=$q="";
					if(isset($_GET['query'])) 
						$q=$dir=$_GET['query'];
					if(isset($_GET['cat'])) 
						$dir=$dir.">".$_GET['cat'];
					if(isset($_GET['search']))
						$dir="product name searched";

					echo $dir."<br />";
					if(isset($_COOKIE['sqle_error']))
						echo $_COOKIE['sqle_error'];
					
					include 'php/store_query.php';
					
					
					$prev=(isset($_GET['page']))?$_GET['page']:0;
					$nxt=($prev==0)?9:$prev*9;
					$prev=$nxt-9;

					$result =DB::query($query);
					$total_result=DB::getNumRows();
					if($total_result>0) echo ($prev+1)."-".(($total_result<$nxt)?$total_result:$nxt)." of ";echo "$total_result result.<br />";
					
					$cat=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";   $q=(isset($_GET['query']))?"query=".$_GET['query']."&":""; 
				 	$page=(isset($_GET['page']))?$_GET['page']:1; 
				 	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":""; 
					if($ready){
						$query.=" ORDER BY ProductID LIMIT $prev,9";
						//echo "$query<br />";
						$result =DB::query($query);
						
						if($brand){
							while($row=$result->fetch_object())
								echo $row->Brand."<br />";
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
										<div class="mardagz" style="background: url('<?php echo  $ri->h("img/product/".$row->ProductAttactment,260); ?>');background-repeat: no-repeat; background-size: cover;">
											<div class="details">
												<a href="<?php echo $ri->h("img/product/".$row->ProductAttactment,700);?>" alt="awawaw" class='fresco'
													data-fresco-group="product"
													data-fresco-caption="Name: <?php echo  $row->ProductName; ?> <br />
													Price: &#8369;<?php echo  $row->ProductPrice; ?>" >
													<div class="name tddiv">
														<span>ZOOM IMAGE</span>
													</div>
												</a>
									<?php 		if($row->ProductStatus=="Close"){     ?>
													<div class="cart tddiv">
														<span>CLOSE</span>
													</div>
									<?php 		}
												else if($row->ProductStatus=="Out of Stock"){     ?>
													<div class="cart tddiv">
														<span>OUT OF STOCK</span>
													</div>
									<?php 		}
												else if(($row->ProductAvailabilitySmall+$row->ProductAvailabilityMedium+$row->ProductAvailabilityLarge)>0){     ?>
													<a href="cart.php?<?php echo $_SERVER ['QUERY_STRING']."&file=".$row->ProductID?>">
														<div class="cart tddiv">
															<span>ADD TO CART</span>
														</div>
													</a>	
									<?php 		}
												else{  		?>
													<div class="cart tddiv">
														<span>OUT OF STOCK</span>
													</div>
									<?php 		}		?>
												<br />
												<p style="font-size:13px;">
												<span style="color:red;">	
													&nbsp;&nbsp; <?php echo  $row->ProductBrand?> &nbsp;</span><br />
												<b>	&nbsp;&nbsp; <?php echo  $row->ProductName?> &nbsp;<br />
													&nbsp;&nbsp; &#8369;<?php echo  $row->ProductPrice?></b>
												</p>
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
									echo "<br />for name \"".$_GET['search']."\".";
							}
						}
					} ?>
				</div>
				<div style="background-color:; height:30px; margin-top:50px;">
						<div style="float:bottom; background-color:#990033; width:150px; height:50px;">
					<a href="mycart.php?<?php echo $_SERVER ['QUERY_STRING']?>">
							<p style="padding: 13px 13px">VIEW CART</p>
					</a>
						</div>
				</div>
				<div style="background-color:; height:30px; margin-top:5px;">
		<?php 		if(0!=$prev){		?>
						<a href="store.php?<?php echo $q.$cat."page=".($page-1);?>">
							<div style="float:left; background-color:#D14719; width:120px; height:45px">
								<p>PREV PAGE</p>
							</div>
						</a>
			<?php 	}
			 		if($total_result>$nxt){		?>
						<a href="store.php?<?php echo $q.$cat."page=".($page+1);?>">
							<div style="float:right; background-color:#D14719; width:120px; height:45px">
								<p>NEXT PAGE</p>
							</div>
						</a>
			<?php 	}
						?>
				</div>
			</div>
		</center>
<?php
	include 'php/footer.php';
?>