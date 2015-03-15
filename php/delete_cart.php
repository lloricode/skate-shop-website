<?php
	if(isset($_GET) and $_SERVER["REQUEST_METHOD"]=="GET"){
		include"../config.php";
		DB::query("DELETE FROM Cart Where CartID=".DB::esc($_GET['del']));
		header("Location: ../mycart.php?".$_SERVER ['QUERY_STRING']);
	}
?>