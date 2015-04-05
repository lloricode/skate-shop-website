<?php
$tt=(isset($tmp_dir)?$tmp_dir:"");
if (!is_dir($tt.$cache_folder)) { //create a new folder if we need to
	    mkdir($tt.$cache_folder);
	}
// Cache the contents to a file
$cached = fopen($tt.$cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
 /*	######## Your Website Content Ends here #########

	if (!is_dir($cache_folder)) { //create a new folder if we need to
	    mkdir($cache_folder);
	}
	if(!$ignore){
	    $fp = fopen($cache_file, 'w');  //open file for writing
	    fwrite($fp, ob_get_contents()); //write contents of the output buffer in Cache file
	    fclose($fp); //Close file pointer
	}
	ob_end_flush(); //Flush and turn off output buffering*/
?>