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
	if( /*isset($_COOKIE['prodID']) and*/ isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		require_once('config.php');
		$sq=$mq=$lq=$size="";
		$ok1=$ok2=$ok3=$error=0;

		$sq=check($_POST['small_quant']);
		$mq=check($_POST['medium_quant']);
		$lq=check($_POST['large_quant']);
		

		//if(!empty($_POST['quant'])) $quant=$_POST['quant']; else{ setcookie("qrr","quantity required",time()+20,"/"); $error++;}
		if(empty($_POST['size_small']) and empty($_POST['size_medium']) and empty($_POST['size_large'])){ 
			setcookie("sizerr","size required",time()+20,"/"); 
			$error++;
		}
		
		//check if injected
		if(isset($_POST['size_small'])){ //------
			if($_POST['size_small']!="small"){
				setcookie("sizerr","this is for human.",time()+20,"/"); 
				$error++;											//-----------
			}
		}
		if(isset($_POST['size_medium'])){ //------
			if($_POST['size_medium']!="medium"){
				setcookie("sizerr","this is for human.",time()+20,"/"); 
				$error++;											//-----------
			}
		}
		if(isset($_POST['size_large'])){ //------
			if($_POST['size_large']!="large"){
				setcookie("sizerr","this is for human.",time()+20,"/"); 
				$error++;											//-----------
			}
		}

		if($error==0) {
			if(isset($_POST['size_small'])){
				if(preg_match("/^[0-9]*$/",$sq)){
					if($sq!=""){
						$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_COOKIE['authID']."' AND ProductID='".$_COOKIE['prodID']."' AND CartItemSize='small'";
						$rs=DB::query($check_query);
						if(DB::getNumRows()>0){
							$row = $rs->fetch_object();
							$cartid=$row->CartID;
							$val=$row->CartQuantity;
							$sqlcmd1="UPDATE Cart SET CartQuantity=".($val+$sq)." WHERE CartPurchased=0 AND CartID=$cartid";
						}
						else
							$sqlcmd1="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$sq','small','0')";
						$ok1=1;
					}
					else{
						setcookie("qrr","quantity required",time()+20,"/");
						$error++;
					}
				}
				else{
					setcookie("qrr","invalid quantity",time()+20,"/");
					$error++;
				}
			}
			if(isset($_POST['size_medium'])){
				if(preg_match("/^[0-9]*$/",$mq)){
					if($mq!=""){
						$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_COOKIE['authID']."' AND ProductID='".$_COOKIE['prodID']."' AND CartItemSize='medium'";
						$rs=DB::query($check_query);
						if(DB::getNumRows()>0){
							$row = $rs->fetch_object();
							$cartid=$row->CartID;
							$val=$row->CartQuantity;
							$sqlcmd2="UPDATE Cart SET CartQuantity=".($val+$mq)." WHERE CartPurchased=0 AND CartID=$cartid";
						}
						else
							$sqlcmd2="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$mq','medium','0')";
						$ok2=1;
					}
					else{
						setcookie("qrr","quantity required",time()+20,"/");
						$error++;
					}
				}
				else{
					setcookie("qrr","invalid quantity",time()+20,"/");
					$error++;
				}
			}
			if(isset($_POST['size_large'])){
				if(preg_match("/^[0-9]*$/",$lq)){
					if($lq!=""){
						$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_COOKIE['authID']."' AND ProductID='".$_COOKIE['prodID']."' AND CartItemSize='large'";
						$rs=DB::query($check_query);
						if(DB::getNumRows()>0){
							$row = $rs->fetch_object();
							$cartid=$row->CartID;
							$val=$row->CartQuantity;
							$sqlcmd3="UPDATE Cart SET CartQuantity=".($val+$lq)." WHERE CartPurchased=0 AND CartID=$cartid";
						}
						else
							$sqlcmd3="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_COOKIE['authID']."','".$_COOKIE['prodID']."','$lq','large','0')";
						$ok3=1;
					}
					else{
						setcookie("qrr","quantity required",time()+20,"/");
						$error++;
					}
				}
				else{
					setcookie("qrr","invalid quantity",time()+20,"/");
					$error++;
				}
			}
		}
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