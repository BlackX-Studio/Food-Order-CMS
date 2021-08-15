<?php
    include('partials-front/menu.php');
?>

<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- Order messege start -->
    <br><br>
            <?php 
                if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
            ?>
    <br><br>
    <!-- Order messege end -->
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //create sql query to display category from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res = mysqli_query($conn,$sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);
                if ($count>0) {
                    //categories available
                    while ($row=mysqli_fetch_assoc($res)) {
                        //Get data like id,title,image
                        //Display the categories
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                            //check image is available or not
                                if ($image_name=="") {
                                    //display messege
                                    //image not available
                                    echo "<div class='error'>Image not Available</div>";
                                }else{
                                    //image is available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;  ?>" alt="<?php echo $image_name;  ?>" class="img-responsive img-curve">
                                    <?php
                                }
                             ?>
                            
 
                        <h3 class="float-text text-white"><?php echo $title;  ?></h3>
                     </div>
                    </a>

                        <?php
                        
                    }
                }else{
                    //categories are not available
                    echo "<div class='error'>Category Not Added</div>";

                }
             ?>

            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //create sql query to display food from database thats are active and featured
                $sql1 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //execute the query
                $res1 = mysqli_query($conn,$sql1);
                //count rows to check whether the category is available or not
                $count1 = mysqli_num_rows($res1);
                if($count1>0) {
                    //categories available
                    while ($row=mysqli_fetch_assoc($res1)) {
                        //Get data like id,title,description,price,image
                        //Display the Featured Food
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        ?>
                    <div class="food-menu-box">
                         <div class="food-menu-img">
                        <?php 
                            //check image is available or not
                            if ($image_name=="") {
                                    //display messege
                                    //image not available
                                    echo "<div class='error'>Image not Available</div>";
                                }else{
                                    //image is available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;  ?>" alt="<?php echo $image_name;  ?>" class="img-responsive img-curve">
                                   <?php
                                }
                        ?>
                    </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;  ?></h4>
                            <p class="food-price"><?php echo $price;  ?></p>
                            <p class="food-detail">
                            <?php echo $description;  ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                        <?php
                        }
                }else{
                    //Featured Food are not available
                    echo "<div class='error'>Featured Food Not Available</div>";
                }

                ?>

 



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php
    include('partials-front/footer.php');
?>