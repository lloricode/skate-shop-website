
<?php
	include "config.php";
	$t="";
	if(!empty($_SERVER ['QUERY_STRING'])) $t= "?".$_SERVER ['QUERY_STRING'];
	DB::query("SELECT doc FROM Visit WHERE doc='".DB::esc(basename($_SERVER['PHP_SELF'])).$t."'");
	if(DB::getNumRows()){
		$rs=DB::query("SELECT count FROM Visit WHERE doc='".DB::esc(basename($_SERVER['PHP_SELF'])).$t."'");
		$row=$rs->fetch_object();
		$count=$row->count;
		DB::query("UPDATE Visit SET count=".(++$count)." WHERE doc='".DB::esc(basename($_SERVER['PHP_SELF'])).$t."'");
	}
	else{
		DB::query("INSERT INTO Visit(doc,count) VALUES('".DB::esc(basename($_SERVER['PHP_SELF'])).$t."',1)");
	}
?>