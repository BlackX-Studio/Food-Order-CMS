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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //create sql query to display food from database thats are active and featured
                $sql1 = "SELECT * FROM tbl_food WHERE active='Yes'";
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
                    echo "<div class='error'>Food Not found</div>";
                }

            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php
    include('partials-front/footer.php');
?>