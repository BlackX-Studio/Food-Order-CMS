<?php
        include('partials/header-admin.php');
        include('partials/menu-admin.php');
?>
    <!-----Main content Section Starts-------->
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br>
            <br>
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                      <tr hidden>
                        <td>Id :</td>
                        <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="current_password" placeholder="Current Password" required></td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password" placeholder="New Password"  required></td>
                    </tr>
                    <tr>
                        <td>Confirm New Password:</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"  required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="change_pass" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-----Main content Section Ends-------->

<?php

    //Current Password empty
    //$_SESSION['error_cp'] = "<div class='error'>Current Password is wrong</div>";

    //check change button work or not
    if(isset($_POST['change_pass'])){
            //get form data
                $id = $_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                //make sql query to check current password
                $sql = "SELECT id,password FROM tbl_admin WHERE id = $id AND password = '$current_password'";
                //check whether $sql is work or not
                //mysqli_query
                $res = mysqli_query($conn,$sql);
                   if($res == TRUE){
                        $count = mysqli_num_rows($res);
                                        if($count == 1){
                                                    if($new_password == $confirm_password){
                                                        $sql_pu = "UPDATE tbl_admin
                                                        SET password = '$new_password'
                                                        WHERE id = $id";
                                                        $res_pu = mysqli_query($conn,$sql_pu);
                                                                if($res_pu == TRUE){
                                                                    $_SESSION['changed_pass'] = "<div class='success'>Password Changed Successfully</div>";
                                                                    header("location:".SITEURL.'admin/manage-admin.php');
                                                                }else{
                                                                    $_SESSION['error_fcp'] = "<div class='error'>Failed to change password!/div>";
                                                                    header("location:".SITEURL.'admin/manage-admin.php');
                                                                }
                                                    }else{
                                                        $_SESSION['error_pdnm'] = "<div class='error'>Password Did not match!</div>";
                                                        header("location:".SITEURL.'admin/manage-admin.php');
                                                    }
                                        }else{
                                                $_SESSION['error_cpnm'] = "<div class='error'>Current Password is wrong!</div>";
                                                header("location:".SITEURL.'admin/manage-admin.php');
                                            }
                   }
    }

?>
 <?php include('partials/footer-admin.php'); ?>