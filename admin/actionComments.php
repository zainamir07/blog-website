<?php

require "includes/connection.php";
require "includes/functions.php";



if(isset($_GET['comID']) && $_GET['comID'] != ""){
    $comID = $_GET['comID'];
  
    $sql = "SELECT * FROM `tbl_comments` WHERE `com_id` = '$comID'";
    $result = mysqli_query($con,$sql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                // $image = $row['user_image'];
                // if($image != "" && file_exists($image)){
                //   unlink($image);
                // } 
  
                $sql = "DELETE FROM `tbl_comments` WHERE `com_id` = '$comID'";
                $result = mysqli_query($con,$sql);
                if($result){
                  $_SESSION['successMessage'] = "Comments has been Deleted Successfully.";
                  header("location:comments.php");
                  exit();
                }
            }
    
        }else{
            $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
            header("location:comments.php");
            exit();
        }
          }
        }

        if(isset($_GET['approveID']) && $_GET['approveID'] != ""){
          $approveID = $_GET['approveID'];
        
          $sql = "SELECT * FROM `tbl_comments` WHERE `com_id` = '$approveID'";
          $result = mysqli_query($con,$sql);
          if($result){
              if(mysqli_num_rows($result) == 1){
                  if($row = mysqli_fetch_array($result)){
                      // $image = $row['user_image'];
                      // if($image != "" && file_exists($image)){
                      //   unlink($image);
                      // } 
                      $sql = "UPDATE `tbl_comments` SET `com_status` = 'A' WHERE `com_id` = '$approveID' ";

                      $result = mysqli_query($con,$sql);
                      if($result){
                        $_SESSION['successMessage'] = "Comments has been Published Successfully.";
                        header("location:comments.php");
                        exit();
                      }
                  }
          
              }else{
                  $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
                  header("location:comments.php");
                  exit();
              }
                }
              }
      //   else{
      //     $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
      //     header("location:comments.php");
      //     exit();
      // }



?>