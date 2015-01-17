<?php
 
    /**
     * @author Lloric Garcia
     * @copyright 2015
     */

    define('DB_SERVER', 'localhost');       //hostname sql.byethost11.org
    define('DB_USER', 'root');                      //database username mardagzc_admin
    define('DB_PASSWD', 'thoor');                        //database password qezephekaFr&$=
    define('DB_NAME', 'MyShopDB');
     
    define("DIR_NAME", (dirname(__FILE__)));
     
    foreach (glob(DIR_NAME."/class/*.php") as $filename) {
        include $filename;
    }
   
   
    DB::init();
?>

