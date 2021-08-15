<?php
include('../config/constants.php');
?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!--------login start------->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter your name"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter your password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
            </form>
            <!--------login end------->
            <p class="text-center">Created By - <a href="https://mhmiyazi.com">MH Miyazi</a></p>
        </div>
    </body>
</html>

<?php
    //Check whether the Submit button is Clicked or not
    if(isset($_POST['submit'])){
    //process for login
    //1. get the date from login form
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $get_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn,$get_password);

    //2. sql to check whether the user with username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
     
    //3.Exe3cute the query
    $res = mysqli_query($conn,$sql);

    //4.count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
        //user available and Login Success
        $_SESSION['login'] = "<div class='success'>login successfully</div>";
        //to check whether the user is login or not
        //It will be unset after logout
        $_SESSION['user'] = $username;
        //redirect to home page /dashbord
        header('location:'.SITEURL.'admin/');
    }else{
        //user not available and Login failed
        $_SESSION['login'] = "<div class='error text-center'>Username or password did not match</div>";
        //redirect to login page /login page
        header('location:'.SITEURL.'admin/login.php');
    }
    }
?>