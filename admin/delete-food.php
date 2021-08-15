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
            $path = "../images/food/".$image_name;
            //Remove the image
            $remove = unlink($path);
            //if failed to remove image then add an error message
            if($remove==false){
                //set the session message
                $_SESSION['upload'] = "<div class='error'>Failed to remove Food image</div>";
                //redirect to manage-food.php
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //check whether data is delete from database or not
        if($res==true){
            //set success message and redirect
            //set the session message
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            //redirect to manage-food.php
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            //set error message and redirect
            //set the session message
            $_SESSION['delete'] = "<div class='error'>Failed to remove Food!</div>";
            //redirect to manage-food.php
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }else{
        //set error message and redirect
            //set the session message
            $_SESSION['unauthorized'] = "<div class='error'>Unauthorize access.</div>";
        //Redirect to the manage-food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }



?>