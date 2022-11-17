<?php
function checkLogin(){
	if (isset($_SESSION['uID']) && 
      $_SESSION['uID'] != "" &&
      isset($_SESSION['uFullName']) &&
      $_SESSION['uFullName'] != "" &&
      isset($_SESSION['uType']) && 
      $_SESSION['uType'] != "" && 
      isset($_SESSION['uEmail']) && 
      $_SESSION['uEmail'] != "" )
	{ 
		return true ;
	}
	else {
		return false;
	}

}

function checkUserType(){
    if(isset($_SESSION['userType']) && $_SESSION['userType'] != "" ){
        return $_SESSION['userType'];
    }else{
      return false;
    }
  }

  function getStatusTitle($status){
    if ($status == "A") {
      return "Active";
    }else if($status == "P"){
      return "Pending";
    }else if($status == "B"){
      return "Blocked";
    }else if($status == "R"){
      return "Rejected";
    }else{
      return "N/A";
    }
  }

  function getCategory($category){
    if ($category == "html") {
      return "HTML";
    }else if($category == "css"){
      return "CSS";
    }else if($category == "js"){
      return "JS";
    }else if($category == "python"){
      return "Python";
    }else if($category == "php"){
      return "PHP";
    }else if($category == "termux"){
      return "Termux";
    }else if($category == "hacking"){
      return "Hacking";
    }else{
      return "N/A";
    }
  }

  function getUserName($userName){
    global $con;
    $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userName' ";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)>0){
      if($row = mysqli_fetch_assoc($result)){
        return $userName = $row['user_name'];
      }
      
    }
    // if ($userType == "A") {
    //   return "Admin";
    // }else if($userType == "U"){
    //   return "User";
    // }
  }


  function timeago($date) {
    // echo $date;
    $timestamp = strtotime($date);
    
    $strTime = array("second", "minute", "hour", "day", "month", "year");
    $length = array("60","60","24","30","12","10");
  
    $currentTime = time();
    if($currentTime >= $timestamp) {
     $diff     = time()- $timestamp;
     for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
     $diff = $diff / $length[$i];
     }
  
     $diff = round($diff);
     return $diff . " " . $strTime[$i] . "(s) ago ";
    }
  }


  function checkUserOldPassword($oldPassword,$userID){
    global $con;
    $oldPassword = md5($oldPassword);
    $sql = "SELECT * FROM `tbl_users` WHERE `user_password` = '$oldPassword' AND `user_id` = '$userID'";
    
  
  $result=mysqli_query($con,$sql);
  if($result){
    if(mysqli_num_rows($result) == 1){
      return true;
    }else{
      return false;
    }
  }
}
?>