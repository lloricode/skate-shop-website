<?php

//security 
	if(!isset($_COOKIE['authID']))
		header("Location: login.php");

	
	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
	function check($data){
		return htmlspecialchars(trim(stripcslashes($data)));
	}
	if( isset($_COOKIE['prodID']) and isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		require_once('config.php');
		$quant=$size="";
		$error=0;
		$valid = array("small","medium","large" );

		if(!empty($_POST['quant'])) $quant=$_POST['quant']; else{ setcookie("qrr","quantity required",time()+20,"/"); $error++;}
		if(empty($_POST['size'])){ setcookie("sizerr","size required",time()+20,"/"); $error++;}
		//validation
		else if(in_array($size, $valid) and !empty($_POST['size'])) { setcookie("sizerr","this is for human.",time()+20,"/"); $error++;}
		else $size=$_POST['size']; 

		$quant=check($quant);
		$size=check($size);
		if(!preg_match("/^[0-9]*$/", $quant)){
			setcookie("qrr","only 0-9 are allowed.",time()+20,"/"); 
			$error++;
		}
		//$price=check($_POST['']);

		$sqlcmd="INSERT INTO Cart(UserAccountID,ProductID,Quantity,Size,Purchased,price)
		  VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$quant','$size','0','".$_COOKIE['price']."')";
		if($error==0)
			setcookie("tmp","added to you cart!",time()+5,"/");//DB::query($sqlcmd);
		else
			setcookie("tmp","awts to you cart!",time()+5,"/");
	/*	if(DB::getNumRows()){
			setcookie("tmp","added to you cart!",time()+5,"/");
		}
		else
			setcookie("tmp","failed to add to your cart.",time()+5,"/");*/
	}
	else
		setcookie("tmp","you have no previlegde to do that.",time()+5,"/");

 	header("Location: cart.php?$q$c$srch file=".$_GET['file']."&page=$p");
?>