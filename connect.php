<?php

    //Give the value names according to your connection
    define("SERVER_NAME","localhost");
    define("USERNAME","root");
    define("DB_PASSWORD","usbw");
    define("DATABASE_NAME","medical_inventory");

          //Create new variable and give the values that you want
    $con = new mysqli(SERVER_NAME, USERNAME, DB_PASSWORD, DATABASE_NAME);


    if(!$con){
        echo "<h2>Displaying the Errors Connecting to the database</h2>";
        die();
    }
?>