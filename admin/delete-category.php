<?php
    //include constants.php
    include('../config/constants.php');
    //check whether the id and image_name value passed or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //Get the value and delete
        //echo "Deleted succesfully";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //Remove the physical image file if available
        if($image_name != ""){
            //image is available.So delete it
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);
            //if failed to remove image then add an error message
            if($remove==false){
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
                //redirect to manage-category.php
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //check whether data is delete from database or not
        if($res==true){
            //set success message and redirect
            //set the session message
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //redirect to manage-category.php
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            //set error message and redirect
            //set the session message
            $_SESSION['delete'] = "<div class='error'>Failed to remove category!</div>";
            //redirect to manage-category.php
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage-category.php
        header('location:'.SITEURL.'admin/manage-category.php');
    }else{
        //Redirect to the manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }



?>