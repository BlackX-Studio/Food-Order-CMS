<?php
        //Start Session
        session_start();
        //creating Constants for non repeating value
        define('SITEURL','http://localhost:8080/2021/Restaurant/Food-order/');
        define('LOCALHOST','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','food_order');

        //Execut query and save data to database
        $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

?>