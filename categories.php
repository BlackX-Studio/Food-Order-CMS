<?php
    include('partials-front/menu.php');
?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                //create sql query to display category from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                                    echo "<div class='error'>Image not found</div>";
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

<?php
    include('partials-front/footer.php');
?>