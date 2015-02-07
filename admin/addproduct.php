<?php

/**

 * @title Ajax Data for Uploading MP3

 * @author Marcelius 'mardagz' Dagpin

 * @copyright 2011

 */



require_once('../config.php');
$path = "../img/product/";

	$valid_formats = array("jpg","png");
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
								$sale=($_POST['psale']=="yes")?1:0;
								$query = "INSERT INTO Product(
									ProductSale,
									ProductName,
									ProductBrand,
									ProductPrice,
									ProductType,
									ProductStatus,
									ProductAvailability,
									ProductGender,
									ProductAttactment,
									AdminAccountID
									) VALUES(
									$sale,
									'". $_POST['pname'] . "',
									'". $_POST['pbrand'] . "',
									'". $_POST['pprice'] . "',
									'". $_POST['ptype'] . "',
									'". $_POST['pstatus'] . "',
									'". $_POST['pstock'] . "',
									'". $_POST['pgender'] . "',
									'". $imgfile . "',
									'". $_COOKIE['auth_accountID'] . "'
									)";
								echo $query;
                                DB::query($query);
								//echo "Success";
								header("Location: view_product.php");

							}else {
								echo "failed";
                            }
						}
						else
						  echo "Image file size max 10 MB";					
					}
					else
					  echo "Invalid file format..";	
				}
			else
				echo "please select a file.!";
			
	}
?>
<a href="view_product.php"><button>back</button></a>