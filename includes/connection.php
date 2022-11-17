<?php
session_start();
date_default_timezone_set("Asia/Karachi");
 
$con=mysqli_connect('localhost','root','');
$db=mysqli_select_db($con,'blog');

?>