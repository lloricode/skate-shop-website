<?php

//security 
	if(!isset($_COOKIE['authID']))
		header("Location: login.php");

	$sqlcmd1=$sqlcmd2=$sqlcmd3="";
	$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	$p=$_GET['page'];
	$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
	function check($data){
		return htmlspecialchars(trim(stripcslashes($data)));
	}
	if( isset($_COOKIE['prodID']) and isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		require_once('config.php');
		$sq=$mq=$lq=$size="";
		$ok1=$ok2=$ok3=$error=0;
		$valid = array("small","medium","large" );

		$sq=check($_POST['small_quant']);
		$mq=check($_POST['medium_quant']);
		$lq=check($_POST['large_quant']);
		

		//if(!empty($_POST['quant'])) $quant=$_POST['quant']; else{ setcookie("qrr","quantity required",time()+20,"/"); $error++;}
		if(empty($_POST['size_small']) and empty($_POST['size_medium']) and empty($_POST['size_large'])){ setcookie("sizerr","size required",time()+20,"/"); $error++;}
		//validation
		else if(in_array($size, $valid) and ( !empty($_POST['size_small']) or !empty($_POST['size_medium']) or !empty($_POST['size_large'])) ) { //------
			setcookie("sizerr","this is for human.",time()+20,"/"); $error++;}													//-----------
		else {
			if(isset($_POST['size_small'])){
				if(preg_match("/^[0-9]*$/",$sq)){
					$sqlcmd1="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$sq','small','0')";
					$ok1=1;
				}
				else{
					setcookie("qrr","quantity required",time()+20,"/");
					$error++;
				}
			}
			if(isset($_POST['size_medium'])){
				if(preg_match("/^[0-9]*$/",$mq)){
					$sqlcmd2="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$mq','medium','0')";
					$ok2=1;
				}
				else{
					setcookie("qrr","quantity required",time()+20,"/");
					$error++;
				}
			}
			if(isset($_POST['size_large'])){
				if(preg_match("/^[0-9]*$/",$lq)){
					$sqlcmd3="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$lq','large','0')";
					$ok3=1;
				}
				else{
					setcookie("qrr","quantity required",time()+20,"/");
					$error++;
				}
			}
		}

		//$price=check($_POST['']);

		
		if($error==0){
			if($ok1)
				DB::query($sqlcmd1);
			if($ok2)
				DB::query($sqlcmd2);
			if($ok3)
				DB::query($sqlcmd3);
			setcookie("tmp","added to you cart!",time()+5,"/");
		}
		else
			setcookie("tmp","failed to add to your cart.",time()+5,"/");
	}
	else
		setcookie("tmp","error in post",time()+5,"/");

 	header("Location: cart.php?$q$c$srch file=".$_GET['file']."&page=$p");
?>