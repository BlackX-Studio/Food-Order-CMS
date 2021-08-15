<?php
    include('partials-front/menu.php');
?>
<?php
    //check whether clicked or not in home page
    if (isset($_GET['category_id'])) {
        //get the cat title based on cat id
        $category_id = $_GET['category_id']; 
        //create query to get cat title
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //Get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }else{
        //redirct to the homepage
        header('location:'.SITEURL.'categories.php');
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
        <?php 
                //Get the id from home page
                //$cat_id = $_GET['category_id'];
                //create sql query to display food from database thats are active and featured
                $sql1 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                //execute the query
                $res1 = mysqli_query($conn,$sql1);
                //count rows to check whether the category is available or not
                $count1 = mysqli_num_rows($res1);
                if($count1>0) {
                    //categories available
                    while ($row1=mysqli_fetch_assoc($res1)) {
                        //Get data like id,title,description,price,image
                        //Display the Featured Food
                        $id = $row1['id'];
                        $title = $row1['title'];
                        $description = $row1['description'];
                        $price = $row1['price'];
                        $image_name = $row1['image_name'];

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
                    echo "<div class='error'>Selected Category have no food</div>";
                    echo "<br><br>";
                    echo "<div class='error'><a href='".SITEURL."categories.php'>Click Here to check another category</a></div>";
                }

            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php
    include('partials-front/footer.php');
?>