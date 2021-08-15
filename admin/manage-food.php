 <?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
<!-----Main content Section Starts-------->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }   
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['remove-failed'])){
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }
            
            if(isset($_SESSION['no-food-found'])){
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }
            if(isset($_SESSION['update-food'])){
                echo $_SESSION['update-food'];
                unset($_SESSION['update-food']);
            }
            
        ?>
        <br><br>
        <!--button to add food--->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
                //Query to get all category from databse
                $sql = "SELECT * FROM tbl_food";
                //Execute the query 
                $res = mysqli_query($conn,$sql);
                //count rows
                $count = mysqli_num_rows($res);
                //create Serial number
                $sn = 1;
                //check whether there is noting in databse
                if($count>0){
                    //We have data
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $title; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $price; ?></td>

                <td>
                    <?php 
                                //check whether image is available or not
                                if($image_name!=""){
                                    //display the image name
                                    //echo $image_name;
                                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name;?>" width="100px">
                    <?php
                                }else{
                                    //display the message
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?>
                </td>

                <td>
                    <?php
                        //Create php script to display all active category from databse
                        //1.Create sql query to get category data
                        $sqlc = "SELECT * FROM tbl_category WHERE id='$category_id'";
                        //execute the query
                        $resc = mysqli_query($conn,$sqlc);
                        //Count rows to check whether we have categoty or not
                        $countc = mysqli_num_rows($resc);
                        //If count>0 then we have category
                        if($countc == 1){
                            //we have categories
                            while($rowc=mysqli_fetch_assoc($resc)){
                                //get the details of category
                                $title = $rowc['title'];

                                echo $title; 

                            }
                        }else{
                            //we do not have categories
                            ?>
                    <option value="0">No Category Found</option>
                    <?php
                        }
                        //2.Display the dropdown
                    ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&category_id=<?php echo $category_id; ?>" class="btn-secondary">Update Food</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                </td>
            </tr>
            <?php
                    }
                }else{
                    //We do not have data
                    //display message inside table
                    ?>
            <tr>
                <td colspan="6">
                    <div class="error">No Food Added</div>
                </td>
            </tr>
            <?php
                }
                     ?>

        </table>
    </div>
</div>
<!-----Main content Section Ends-------->
<?php include('partials/footer-admin.php'); ?>