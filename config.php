<?php
 
    /**
     * @author Lloric Garcia
     * @copyright 2015
     */

    define('DB_SERVER', 'localhost');       //by mardags
    define('DB_USER', 'root');                      //
    define('DB_PASSWD', 'mnmn');                        //
    define('DB_NAME', 'MyShopDB');
     
    define("DIR_NAME", (dirname(__FILE__)));
     
    foreach (glob(DIR_NAME."/class/*.php") as $filename) {
        include $filename;
    }
   
   $ri = new IMG(isset($tmp_dir)?$tmp_dir:"");
    DB::init();
?>

