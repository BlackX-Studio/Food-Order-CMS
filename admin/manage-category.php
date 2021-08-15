<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
<!-----Main content Section Starts-------->
<div class="main-content">
<div class="wrapper">
    <h1>Manage Category</h1>
    <!--button to add category--->
    <br><br>
    <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                //Query to get all category from databse
                $sql = "SELECT * FROM tbl_category";
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
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                            <td>
                            <?php 
                                //check whether image is available or not
                                if($image_name!=""){
                                    //display the image name
                                    //echo $image_name;
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $image_name;?>" width="100px">
                                    <?php
                                }else{
                                    //display the message
                                    echo "<div class='error'>Image not added.</div>";
                                }
                            ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Category</a>                        
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    //We do not have data
                    //display message inside table
                    ?>
                    <tr>
                        <td colspan="6"><div class="error">No Category Added</div></td>
                    </tr>
                    <?php
                }
                     ?>
                
            </table>
    </div>
</div>
<!-----Main content Section Ends-------->
<?php include('partials/footer-admin.php'); ?>