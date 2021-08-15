<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
    <div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-----Add category start---->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
             <tr>
                <td>Title: </td>
                <td><input type="text" name="title" placeholder="Title of Food"></td>
             </tr>
             <tr>
                <td>Description: </td>
                <td><textarea type="text" name="description" placeholder="Description of the food"></textarea></td>
             </tr>
             <tr>
                <td>Price: </td>
                <td><input type="number" name="price" placeholder="Price of the food"></td>
             </tr>
             <tr>
                <td>Select Image: </td>
                <td><input type="file" name="image"></td>
             </tr>
             <tr>
             <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                    <?php
                        //Create php script to display all active category from databse
                        //1.Create sql query to get category data
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        //execute the query
                        $res = mysqli_query($conn,$sql);
                        //Count rows to check whether we have categoty or not
                        $count = mysqli_num_rows($res);
                        //If count>0 then we have category
                        if($count > 0){
                            //we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                //get the details of category
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                
                                <?php
                            }
                        }else{
                            //we do not have categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                        //2.Display the dropdown
                    ?>
                    </select>
                </td>
             </tr>
             <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
             </tr>
             <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
             </tr>
             <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
                
             </tr>
            </table>
        </form>
        
        <?php

            //check whether the submit button is click or not
            if(isset($_POST['submit'])){
                //Add the food into database
                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $price = $_POST['price'];
                //check whether radio button is checked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";//default value if nothing selected
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";//default value if nothing selected
                }
                //2.Upload the image if selected
                //check whether select image is clicked or not
                if(isset($_FILES['image']['name'])){
                    //get the details of selected image
                    $image_name = $_FILES['image']['name'];
                    //check whether select image is clicked or not
                    //upload image if only selected
                    if($image_name != ""){
                        //IMAGE IS SELECTED
                        //A. Rename the image
                        //get the extension of selsected image
                        $black_x_ext = end(explode('.',$image_name));

                        //Create new name for the image
                        $image_name = "Food-name-".rand(0000,9999).".".$black_x_ext;

                        //B. Upload the image
                        //Get the source path
                        $black_x_sorc = $_FILES['image']['tmp_name'];
                        //Get the destination path
                        $black_x_dest = "..//images/food/".$image_name;
                        //Finally Uploaded
                        $black_x_upload = move_uploaded_file($black_x_sorc,$black_x_dest);
                        //check whether image is uploaded or not
                        if($black_x_upload==false){
                            //Failed to uploaded the image
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            //Redirect to manage food page with success message
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }
                }else{
                    $image_name = "";//Deafult value if image is not uploaded
                }

                //3. Insert into database
                //create a sql query to insert data into databse
                //category_id is numeric value
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //4. Redirect manage food page with message
                //check whether the data is inserted or not
                if($res2 == true){
                    //Data Inserted successfully
                    //Successfully uploaded the image
                    $_SESSION['add'] = "<div class='success'>Food Added succesfully</div>";
                    //Redirect to manage food page with success message
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    //Failed to insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to added food!</div>";
                    //Redirect to manage food page with success message
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
    </div>


    <?php include('partials/footer-admin.php'); ?>