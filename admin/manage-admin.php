<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
    <!-----Main content Section Starts------>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
        <!--button to add admin--->
            <br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['error_fcp'])){
                echo $_SESSION['error_fcp'];
                unset($_SESSION['error_fcp']);
            }
            if(isset($_SESSION['error_pdnm'])){
                echo $_SESSION['error_pdnm'];
                unset($_SESSION['error_pdnm']);
            }
                if(isset($_SESSION['error_cpnm'])){
                echo $_SESSION['error_cpnm'];
                unset($_SESSION['error_cpnm']);
            }
//
            if(isset($_SESSION['changed_pass'])){
                echo $_SESSION['changed_pass'];
                unset($_SESSION['changed_pass']);
            }
            ?>

            <br>
            <br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn,$sql);
                    $sn = 1;//Serial Number
                    if($res==TRUE){
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                        $no_result = '<span class="error">No Admin Found In Database! </span>';
                        $add_some = '<a class="success" href="'.SITEURL.'admin/add-admin.php'.'">Lets add some Admin.</a>';
                        ?>
                        <tr>
                            <td class="error"><?php echo $no_result.$add_some; ?></td>
                        </tr>
                        <?php
                        }
                    }

                ?>
                
            </table>
        </div>
    </div>
    <!-----Main content Section Ends-------->
    <?php include('partials/footer-admin.php'); ?>
