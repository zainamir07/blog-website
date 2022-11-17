<?php 
session_start();
unset($_SESSION['userID']);
unset($_SESSION['userFullName']);
unset($_SESSION['userEmail']);
unset($_SESSION['userType']);

header("location:login.php");
exit();
?>