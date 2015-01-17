<?php
	setcookie("authFn","",time()-3600,"/");
	setcookie("authLn","",time()-3600,"/");
	setcookie("authImg","",time()-3600,"/");
	setcookie("authID","",time()-3600,"/");
	header("Location: index.php");

?>