<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
    <!-----Main content Section Starts------>
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br><br>
            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>
            <div class="col-4 text-center">
                <?php 
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                 ?>
                <h1><?php echo $count; ?></h1><br>
                Categories
            </div>
            <div class="col-4 text-center">
                <?php 
                    $sql2 = "SELECT * FROM tbl_food";
                    $res2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);
                 ?>
                <h1><?php echo $count2; ?></h1><br>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php 
                    $sql3 = "SELECT * FROM tbl_order";
                    $res3 = mysqli_query($conn,$sql3);
                    $count3 = mysqli_num_rows($res3);
                 ?>
                <h1><?php echo $count3; ?></h1><br>
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php 
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    $res4 = mysqli_query($conn,$sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    $total = $row4['Total'];

                    //second query
                    $sql5 = "SELECT currency_sign,currency_rate FROM tbl_setting_currency WHERE status='active'";
                    $res5 = mysqli_query($conn,$sql5);
                    $row5 = mysqli_fetch_assoc($res5);
                    $currency_sign = $row5['currency_sign'];
                    $currency_rate = $row5['currency_rate'];
                 ?>
                <h1><?php echo $currency_sign; ?> <?php echo $total*$currency_rate; ?></h1><br>
                Total Revenue
            </div>
            <div class="clear-fix"></div>
        </div>
        <div class="wrapper"></div>
    </div>
    <!-----Main content Section Ends-------->
    <?php include('partials/footer-admin.php'); ?>
