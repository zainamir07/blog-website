<?php 
require "includes/connection.php";
require "includes/functions.php";
  
if(isset($_GET['msgID']) && $_GET['msgID'] != ""){
 $msgID = $_GET['msgID'];


  $sql = "SELECT * FROM `tbl_contact` WHERE `contact_id` = '$msgID'";
 
  $result = mysqli_query($con,$sql);
  if($result){
      if(mysqli_num_rows($result) == 1){
          if($row = mysqli_fetch_array($result)){
 
              $sql = "DELETE FROM `tbl_contact` WHERE `contact_id` = '$msgID'";
              $result = mysqli_query($con,$sql);
              if($result){
                $_SESSION['successMessage'] = "Message has been Deleted Successfully.";
                header("location:messages.php");
                exit();
              }
          }
  
      }else{
          $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
          header("location:messages.php");
          exit();
      }
        }
      }


    if(isset($_GET['readMSG']) && $_GET['readMSG'] != ""){
     $readMSG = $_GET['readMSG'];
     
      if(isset($_GET['readMSG']) && $_GET['readMSG'] != ""){
        $readMSG = $_GET['readMSG'];
        $sql = "UPDATE `tbl_contact` SET `contact_status` = 'R' WHERE `contact_id` = '$readMSG' ";
               $result = mysqli_query($con,$sql);
  
              if($result){
                $_SESSION['successMessage'] = "Message Marked As Read Successfully.";
                  header("location:messages.php");
                  exit();
              }
  
            }else{
              $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
              header("location:messages.php");
              exit();
          }
  
    }
    

?>