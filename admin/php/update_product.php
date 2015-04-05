<?php

/**

 * @title Ajax Data for Uploading MP3

 * @author Marcelius 'mardagz' Dagpin

 * @copyright 2011

 */


session_start();
require_once('../../config.php');
$path = "../../img/product/";
	$err=0;
	$valid_formats = array("jpg","png");
	if(isset($_GET['id'])){
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
				$name = $_FILES['pimage']['name'];
				$size = $_FILES['pimage']['size'];

				if(strlen($name))
					{
						list($txt, $ext) = explode(".", $name);
						
						if(in_array($ext,$valid_formats))
						{
							if($size<(15728640))
							{
								$imgfile = md5($txt . time()) . "." . $ext;
	                            //$imgfile = $txt . "." . $ext;
								$tmp = $_FILES['pimage']['tmp_name'];
								if(move_uploaded_file($tmp, $path.$imgfile)) {	
									unlink($path.$_COOKIE['del']);
									$query = "UPDATE Product SET ProductAttactment='". $imgfile . "' WHERE ProductID=".$_GET['id'];
	                               DB::query($query);
								}
								else {
									setcookie("tmp","failed update image.",time()+5,"/");	
									$err++;
	                            }
							}
							else{
							  	setcookie("tmp","Image file size max 10 MB",time()+5,"/");			
							  	$err++;		
							}
						}
						else{
							setcookie("tmp","Invalid file format..",time()+5,"/");	
							$err++;
						}
					}
				if($err==0){
					$sale=($_POST['psale']=="yes")?1:0;
					$query = "UPDATE Product SET
										ProductSale=$sale,
										ProductName='". $_POST['pname'] . "',
										ProductBrand='". $_POST['pbrand'] . "',
										ProductPrice=". $_POST['pprice'] . ",
										ProductType='". $_POST['ptype'] . "',
										ProductStatus='". $_POST['pstatus'] . "',
										ProductGender='". $_POST['pgender'] . "',
										UserAccountID='". $_SESSION['auth_accountID'] . "' WHERE ProductID=".$_GET['id'];
	                               DB::query($query);

	                $query="UPDATE ProductInventory SET
							ProductInventoryStock=". $_POST['pstockS'] . ",ProductInventorySize='".$_POST['sizeone']."'
							WHERE ProductInventoryID='".$_POST['idone']."'";
	                DB::query($query);
	                $query="UPDATE ProductInventory SET
							ProductInventoryStock=". $_POST['pstockM'] . ",ProductInventorySize='".$_POST['sizetwo']."'
							WHERE ProductInventoryID='".$_POST['idtwo']."'";
	                DB::query($query);
	                $query="UPDATE ProductInventory SET
							ProductInventoryStock=". $_POST['pstockL'] . ",ProductInventorySize='".$_POST['sizethree']."'
							WHERE ProductInventoryID='".$_POST['idthree']."'";
	                DB::query($query);
	                               setcookie("tmp","update successfull!",time()+5,"/");	
	            }
				header("Location: ../edit.php?edit_product=".$_GET['id']);
				
		}
		else
			header("Location: ../view_product.php");
	}
	else
		header("Location: ../view_product.php");
?>