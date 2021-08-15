<?php include('partials/header.php'); ?>
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
                        <td>Currency Name:</td>
                        <td><input type="text" name="currency_name" placeholder="Enter Currency"></td>
                    </tr>
                    <tr>
                        <td>Currency Sign</td>
                        <td><input type="text" name="currency_sign" placeholder="Enter Currency Sign"></td>
                    </tr>
                    <tr>
                        <td>Currency Rate</td>
                        <td><input type="text" name="currency_rate" placeholder="Enter Currency Rate"></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="status" value="inactive">
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Currency" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <!-----Main content Section Ends-------->
<?php include('partials/footer.php'); ?>
<?php
    //Process the value from form and database
    //checked whether the submit click or not
    if(isset($_POST['submit'])){
       
                //Button CLicked
                $currency_name = $_POST['currency_name'];
                $currency_sign = $_POST['currency_sign'];
                $currency_rate = $_POST['currency_rate'];
                $status = $_POST['status'];

                //SQL query to save the data to database
                $sql = "INSERT INTO tbl_setting_currency SET
                currency_name = '$currency_name',
                currency_sign = '$currency_sign',
                currency_rate = $currency_rate,
                status = '$status'
                ";

                $res = mysqli_query($conn,$sql);

                //CHeck whether $res is true or false

                if($res==TRUE){
                    //Data Inserted
                    //echo'Data Inserted';
                    //Session To display messege
                    $_SESSION['add'] = "<div class='success'>Currency Added Successfully</div>";
                    //redirect page to mange admin
                    header("location:".SITEURL.'admin/setting/currency/currency_view.php');
                }else{
                    //Data Failed TO Insert
                    //echo'Data Failed TO Insert';
                    $_SESSION['add'] = "<div class='error'>Failed to Add Currency</div>";
                    //redirect page to add admin
                    header("location:".SITEURL.'admin/setting/currency/currency_view.php');
                }

       }

?>