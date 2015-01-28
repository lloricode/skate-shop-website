<?php
	$con=mysqli_connect("localhost","root","mnbv","MyShopDB");
	if(mysqli_connect_errno())
		echo "falied to cnnect db<BR>".mysqli_connect_error();
	else
		echo "connected to db!<BR>";
	   $sale=($_POST['psale']=="yes")?1:0;
            $query = "UDPATE Product SET
                                    Sale=$sale,
                                    ProductName='". $_POST['pname'] . "',
                                    Brand='". $_POST['pbrand'] . "',
                                    ProductPrice=". $_POST['pprice'] . ",
                                    ProductType='". $_POST['ptype'] . "',
                                    ProductStatus='". $_POST['pstatus'] . "',
                                    ProductAvailability=". $_POST['pstock'] . ",
                                    ProductGender='". $_POST['pgender'] . "',
                                    AdminAccountID='". $_COOKIE['auth_accountID'] . "' WHERE ProductID=".$_GET['id']."
                                    ";
                             //   echo $query;
                            //   DB::query($query);
                                echo "ok!!!";
    $rs=mysql_query($query);
/*	$total_rows=mysql_num_rows($rs);

	$pager_option=array(
		'mode'       => 'Sliding',
		'perPage'    => 10,
		'delta'      => 4,
		'totalItems' => $total_rows,
	);

	//----------------------


	 $page = filter_input ( 
	 	INPUT_GET,
	  	'page',
	  	FILTER_VALIDATE_INT,
	  	array('options'=>array('min_range' => 1))
	  	);
	 $page = (isset($_GET['page']) && intval($_GET['page'] != 0) ? intval($_GET['page']) : 1);

	if(!$page==0){
		$offset = 3;
		$limit = ($page - 1) * $offset;
		$onset = $limit + $offset;
	}

	$md_query = "SELECT count(md_id) FROM tbl_content";

	$totalpages = ceil($db->ExecuteScalar($md_query) / $offset);

    $next = $page + 1;

    $prev = $page - 1;

   

    $content_query = "SELECT * FROM tbl_content WHERE md_publish = 0 ORDER BY md_id DESC LIMIT $limit, $onset";*/
?>


