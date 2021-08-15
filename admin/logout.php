<?php
    //Include the constants.php for SITEURL
    include('../config/constants.php');
    //1. Destroy the Session
    session_destroy(); //unset $_SESSION['user']
    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');


?>