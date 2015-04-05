<?php
//security 
	session_start();
	if(!isset($_SESSION['authID']))
		header("Location: ../login.php");
	$sqlcmd1=$sqlcmd2=$sqlcmd3="";
	//$q=(isset($_GET['query']))?"query=".$_GET['query']."&":"";
	//$c=(isset($_GET['cat']))?"cat=".$_GET['cat']."&":"";
	//$p=$_GET['page'];
	//$srch=(isset($_GET['search']))?"search=".$_GET['search']."&":"";
	/*function check($data){
		return htmlspecialchars(trim(stripcslashes($data)));
	}*/
	if( isset($_POST['prodID']) and isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
		require_once('../config.php');
		$sq=$mq=$lq=$size="";
		$oos=$ok1=$ok2=$ok3=$error=0;
		//check the quantity in every sizes
		$sql="SELECT ProductInventoryStock,ProductInventorySize FROM ProductInventory WHERE ProductID=".DB::esc($_POST['prodID']);
		$rs=DB::query($sql);

		while(		$row=$rs->fetch_object()   ){

				$tmp[]=$row->ProductInventoryStock;

		}



		$sc=$tmp[0];
		$mc=$tmp[1];
		$lc=$tmp[2];
		$sq=DB::esc((isset($_POST['small_quant']))?$_POST['small_quant']:0);
		$mq=DB::esc((isset($_POST['medium_quant']))?$_POST['medium_quant']:0);
		$lq=DB::esc((isset($_POST['large_quant']))?$_POST['large_quant']:0);
		if(!empty($_POST['size_small'])){
			if(!empty($sq) and preg_match("/^[0-9]*$/",$sq)){
				if($sq>$sc){
					setcookie("oosS","small is only $sc.",time()+20,"/");
					$oos=1;
				}
			}
			else{
				setcookie("oosS","invalid value.",time()+20,"/");
				$oos=2;
			}
		}
		if(!empty($_POST['size_medium'])){
			if(!empty($mq) and preg_match("/^[0-9]*$/",$mq)){
				if($mq>$mc){
					setcookie("oosM","medium is only $mc.",time()+20,"/");
					$oos=1;
				}
			}
			else{
				setcookie("oosS","invalid value.",time()+20,"/");
				$oos=2;
			}
		}
		if(!empty($_POST['size_large'])){
			if(!empty($lq) and preg_match("/^[0-9]*$/",$lq)){
				if($lq>$lc){
					setcookie("oosL","large is only $lc.",time()+20,"/");
					$oos=1;
				}
			}
			else{
				setcookie("oosS","invalid value.",time()+20,"/");
				$oos=2;
			}
		}
		if(!$oos){
			//if(!empty($_POST['quant'])) $quant=$_POST['quant']; else{ setcookie("qrr","quantity required",time()+20,"/"); $error++;}
			if(empty($_POST['size_small']) and empty($_POST['size_medium']) and empty($_POST['size_large'])){ 
				setcookie("sizerr","size required",time()+20,"/"); 
				$error++;
			}
			//check if injected
		/*	if(isset($_POST['size_small'])){ //------
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
			}*/
			if($error==0) {
				if(isset($_POST['size_small'])){
					if(preg_match("/^[0-9]*$/",$sq)){
						if($sq!=""){
							$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION['authID']."' AND ProductID='".DB::esc($_POST['prodID'])."' AND CartItemSize='small'";
							$rs=DB::query($check_query);
							if(DB::getNumRows()>0){
								$row = $rs->fetch_object();
								$cartid=$row->CartID;
								$val=$row->CartQuantity;
								$sqlcmd1="UPDATE Cart SET CartQuantity=".($val+$sq)." WHERE CartPurchased=0 AND CartID=$cartid";
							}
							else
								$sqlcmd1="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_SESSION['authID']."','".DB::esc($_POST['prodID'])."','$sq','".DB::esc($_POST['sizeone'])."','0')";
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
							$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION['authID']."' AND ProductID='".DB::esc($_POST['prodID'])."' AND CartItemSize='medium'";
							$rs=DB::query($check_query);
							if(DB::getNumRows()>0){
								$row = $rs->fetch_object();
								$cartid=$row->CartID;
								$val=$row->CartQuantity;
								$sqlcmd2="UPDATE Cart SET CartQuantity=".($val+$mq)." WHERE CartPurchased=0 AND CartID=$cartid";
							}
							else
								$sqlcmd2="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_SESSION['authID']."','".DB::esc($_POST['prodID'])."','$mq','".DB::esc($_POST['sizetwo'])."','0')";
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
							$check_query="SELECT CartID,CartQuantity FROM Cart WHERE CartPurchased=0 AND UserAccountID='".$_SESSION['authID']."' AND ProductID='".DB::esc($_POST['prodID'])."' AND CartItemSize='large'";
							$rs=DB::query($check_query);
							if(DB::getNumRows()>0){
								$row = $rs->fetch_object();
								$cartid=$row->CartID;
								$val=$row->CartQuantity;
								$sqlcmd3="UPDATE Cart SET CartQuantity=".($val+$lq)." WHERE CartPurchased=0 AND CartID=$cartid";
							}
							else
								$sqlcmd3="INSERT INTO Cart(UserAccountID,ProductID,CartQuantity,CartItemSize,CartPurchased) VALUES('".$_SESSION['authID']."','".DB::esc($_POST['prodID'])."','$lq','".DB::esc($_POST['sizethree'])."','0')";
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
		else if($oos==2)
			setcookie("tmp","invalid quantity",time()+5,"/");
		else
			setcookie("tmp","quantity reach",time()+5,"/");
	}
	/*else echo "string";
		//setcookie("tmp","error in post",time()+5,"/");*/
	if($error!=0 or $oos==2 or $oos){
		header("Location: ../cart.php?".$_SERVER ['QUERY_STRING']);
	}
 	else{
		header("Location: ../mycart.php");
 	}
 	//header("Location: ../mycart.php");//.$_SERVER ['QUERY_STRING']);
?>