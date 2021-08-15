<?php include('partials/header-admin.php'); ?>
<?php include('partials/menu-admin.php'); ?>
    <div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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
                <td><input type="text" name="title" placeholder="Category Title"></td>
             </tr>
             <tr>
                <td>Select Image: </td>
                <td><input type="file" name="image"></td>
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
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
                
             </tr>
            </table>
        </form>
        <!-----Add category end---->
        <?php 
            //check whether the submit button is clicked or not
            if(isset($_POST['submit'])){
                //Get the value from Category form
                $title = $_POST['title'];
                //check whether radio button is clicked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    //set the default value
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    //set the default value
                    $active = "No";
                }
                //check whether image is selected or not and 
                //Set the value for image name accordingly
                //print_r($_FILES['image']);
                if(isset($_FILES['image']['name'])){
                    //upload image
                    //To upload image we need image name,source path and destination path
                    $image_name = $_FILES['image']['name'];
                    //upload the image if selected
                    if($image_name != ""){
                        //Auto rename image whicjh is exists
                        //Get the extension of our image(jpg,png,gif etc) e.g. "something.jpg"
                        $ext = end(explode('.',$image_name));
                        //Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;//e.g. "Food_Category_432.jpg"

                        //FInally Upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is upload or not
                        //And if the image is not uploaded then stop the process and redirect with error message
                        if($upload==false){
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            //redirect to
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop process
                            die();
                        }
                     }
                }else{
                    //dont upload image and set null 
                    $image_name = "";
                }
                //die();//break the code here

                //2. Create sql query to insert data into database
                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3. execute the query and save the data to database
                $res = mysqli_query($conn,$sql);
                //check whether the query executed or not
                if($res==true){
                    //query executed
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    //Redirect to Manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }else{
                    //query not executed
                    $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                    //Redirect to Manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }else{

            }
        
        
        ?>

    </div>
    </div>
<?php  include('partials/footer-admin.php'); ?>