
			
			
				
					
						<?php
								$ready=1;$brand=0;
							if(isset($_GET['query']) ){	
								if(isset($_GET['cat'])){
									if($_GET['cat']=="shoes"){
										if(isset($_GET['query'])){
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
										else{
											echo "error query";
											$ready=0;
										}
									}
									else if($_GET['cat']=="jackets"){
										if(isset($_GET['query'])){
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
										else{
											echo "error query";
											$ready=0;
										}
									}
									else if($_GET['cat']=="tees"){
										if(isset($_GET['query'])){
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
										else{
											echo "error query";
											$ready=0;
										}
									}
									else if($_GET['cat']=="jeans"){
										if(isset($_GET['query'])){
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
										else{
											echo "error query";
											$ready=0;
										}
									}
									else if($_GET['cat']=="shorts"){
										if(isset($_GET['query'])){
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
										else{
											echo "error query";
											$ready=0;
										}
									}
									else{
										echo "error query";
										$ready=0;
									}
								}
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
							}
							else if(isset($_GET['search'])){
									$query="SELECT * FROM Product WHERE ProductName='".htmlspecialchars(stripcslashes(trim($_GET['search'])))."'";
							}
							else{
								echo "error query";
								$ready=0;
							}
								
							
						?>
						
					
		