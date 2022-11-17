<?php

require "includes/connection.php";
require "includes/functions.php";



if(isset($_GET['subID']) && $_GET['subID'] != ""){
    $subID = $_GET['subID'];
  
    $sql = "SELECT * FROM `tbl_newsletter` WHERE `newsletter_id` = '$subID'";
    $result = mysqli_query($con,$sql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                // $image = $row['user_image'];
                // if($image != "" && file_exists($image)){
                //   unlink($image);
                // } 
  
                $sql = "DELETE FROM `tbl_newsletter` WHERE `newsletter_id` = '$subID'";
                $result = mysqli_query($con,$sql);
                if($result){
                  $_SESSION['successMessage'] = "User has been Deleted Successfully.";
                  header("location:subscribers.php");
                  exit();
                }
            }
    
        }else{
            $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
            header("location:subscribers.php");
            exit();
        }
          }
        }else{
          $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
          header("location:subscribers.php");
          exit();
      }



?>