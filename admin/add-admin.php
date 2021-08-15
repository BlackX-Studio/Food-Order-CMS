<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
    <!-----Main content Section Starts-------->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
                <br>
                <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
                <br>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>
                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="username" placeholder="Enter User Name"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <!-----Main content Section Ends-------->
<?php include('partials/footer-admin.php'); ?>
<?php
    //Process the value from form and database
    //checked whether the submit click or not
    if(isset($_POST['submit'])){
       if(!(empty($_POST['full_name'])) and (!(empty($_POST['username'])) and !(empty($_POST['password']))) ){
        //Button CLicked
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL query to save the data to database
        $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //CHeck whether $res is true or false

        if($res==TRUE){
            //Data Inserted
            //echo'Data Inserted';
            //Session To display messege
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirect page to mange admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            //Data Failed TO Insert
            //echo'Data Failed TO Insert';
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

       }
       else{
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        //redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
       }
    }

?>