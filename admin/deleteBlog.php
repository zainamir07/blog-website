<?php 
require "includes/connection.php";
require "includes/functions.php";

if(isset($_GET['blogID']) && $_GET['blogID'] != ""){
  $blogID = $_GET['blogID'];

  $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_id` = '$blogID'";
  $result = mysqli_query($con,$sql);
  if($result){
      if(mysqli_num_rows($result) == 1){
          if($row = mysqli_fetch_array($result)){
            //   $image = $row['blog_image'];
            //   if($image != "" && file_exists($image)){
            //     unlink($image);
            //   }

              $sql = "DELETE FROM `tbl_blogs` WHERE `blog_id` = '$blogID'";
              $result = mysqli_query($con,$sql);
              if($result){
                $_SESSION['successMessage'] = "Blog has been Deleted Successfully.";
                header("location:viewAllBlogs.php");
                exit();
              }
          }
  
      }else{
          $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
          header("location:viewAllBlogs.php");
          exit();
      }
        }
      }
    //   else{
    //     $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
    //     header("location:viewAllBlogs.php");
    //     exit();
    // }


    if(isset($_GET['cateID']) && $_GET['cateID'] != ""){
      $cateID = $_GET['cateID'];
    
      $sql = "SELECT * FROM `tbl_category` WHERE `cate_id` = '$cateID'";
      $result = mysqli_query($con,$sql);
      if($result){
          if(mysqli_num_rows($result) == 1){
              if($row = mysqli_fetch_array($result)){
                //   $image = $row['blog_image'];
                //   if($image != "" && file_exists($image)){
                //     unlink($image);
                //   }
    
                 $sql = "DELETE FROM `tbl_category` WHERE `cate_id` = '$cateID'";
                 
                  $result = mysqli_query($con,$sql);
                  if($result){
                    $_SESSION['successMessage'] = "Blog has been Deleted Successfully.";
                    header("location:categories.php");
                    exit();
                  }
              }
      
          }else{
              $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
              header("location:categories.php");
              exit();
          }
            }
          }else{
            $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
            header("location:categories.php");
            exit();
        }



?>