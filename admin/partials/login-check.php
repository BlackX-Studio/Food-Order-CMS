<?php
	ob_start();
    //Authorization - Access Control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])){ //if user session not set
        //User is not logged in
        //Redirect to login page with messege
        $_SESSION['no-login-message'] ="<div class='error text-center'>Please login to access Admin Panel</div>";
        //Redirect to Login page
        header('location:'.SITEURL.'admin/login.php');
    }

    ob_end_flush();
 ?>