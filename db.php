<?php
    $dbservername = 'sql302.epizy.com';
    $dbusername = 'epiz_32591153';
    $dbpassword = 'TstOZiKq2W9psF';
    $dbname = "epiz_32591153_schedule";
    $connection = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
      
    // Check connection
    if(!$connection){
        die('Database connection error : ' .mysql_error());
    }
    
?>