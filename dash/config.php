<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'saaUser');
   define('DB_PASSWORD', 'D0gs_l1k3_art!'); //What ever the password is
   define('DB_DATABASE', 'saa');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //Global database to be used by all php scripts
   $version = "v1.0.0 ALPHA";

   function clean($string) { //
     return preg_replace('/[^A-Za-z0-9\-]:;/', '', $string);
   }
?>
