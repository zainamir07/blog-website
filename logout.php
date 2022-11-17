<?php 
session_start();
unset($_SESSION['uID']);
unset($_SESSION['uFullName']);
unset($_SESSION['uEmail']);
unset($_SESSION['uType']);

header("location:login.php");
exit();
?>