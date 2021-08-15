<?php
    //include constants.php
    include('../config/constants.php');
    //1.get the id of admin to deleted
    $id = $_GET['id'];
    //2.Create query to delete admin
     $sql = "DELETE FROM tbl_admin WHERE id=$id";

     //execute query
     $res = mysqli_query($conn,$sql);
     //check whether the query executed successfully
     //3.Redirect to manage admin page with success/error messege
     if($res==TRUE){
         //query executed and admin deleted
         //echo 'Admin deleted!';
         $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
         header("location:".SITEURL.'admin/manage-admin.php');
     }else{
         //Failed to delete admin
         //echo 'Failed to delete Admin!';
         $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
         header("location:".SITEURL.'admin/manage-admin.php');
     }


?>