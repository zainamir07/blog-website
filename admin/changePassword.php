<?php  
include "includes/connection.php";
include "includes/functions.php";

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
    $_SESSION['errors'] = array();
  }
  
  $confirmPassword = $newPassword  =  $oldPassword = $memberID = "";
  $userID = $_SESSION['userID'];
  
  if (isset($_POST['updatePasswordBtn'])) {

    if (empty($_POST['oldPassword'])) {
      array_push($_SESSION['errors'], "Club Old Password is required");
    }else{
      $oldPassword = mysqli_real_escape_string($con,$_POST['oldPassword']);
      if (checkUserOldPassword($oldPassword,$userID) == false) {
          array_push($_SESSION['errors'], "Old Password Not Matched.");
        }
    }
    
     if (empty($_POST['confirmPassword'])) {
        array_push($_SESSION['errors'], "Confirm Password is required");
      }else{
        $confirmPassword =mysqli_real_escape_string($con, $_POST['confirmPassword']);
        
      }
  
      if (empty($_POST['newPassword'])) {
        array_push($_SESSION['errors'], "New Password is required");
      }else{
        $newPassword =mysqli_real_escape_string($con, $_POST['newPassword']);
      }
  
  
      if ($confirmPassword == $newPassword) {
        $newPassword = md5($newPassword);
      }else{
        array_push($_SESSION['errors'], "Password Not Matched");
  
      }
      
  
    if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
      $sql = "UPDATE `tbl_users` SET `user_password` = '$newPassword'  WHERE `user_id` = '$userID'";
    //  die;
      $result = mysqli_query($con,$sql);
      if ($result) {
        $_SESSION['successMessage'] = "Password Updated Successfully, Please Login with new Password";
        header("location:logout.php");
        exit();
      }
    }
  
  }
  

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <?php 
             if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
                  $errors = $_SESSION['errors'];
                  foreach($errors as $error){
                    ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php
                  }
                  unset($_SESSION['errors']);
                }
          ?>

        <?php if(isset($_SESSION['successMessage'])){
            ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); ?>
        </div>
        <?php
          } ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Update Password</h1>
                                    </div>

                                    <form class="user" action="changePassword.php" method="POST">
                                    <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="oldPassword" id="oldPassword"  placeholder="Enter Old Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="newPassword" id="newPassword" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="confirmPassword" id="confirmPassword"  placeholder="Enter Confirm Password">
                                        </div>
                                   
                   
                        <!-- Submit button -->
                        <button type="submit" name="updatePasswordBtn" class="btn btn-primary btn-block mb-4">Update Password</button>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <!-- <button type="submit" name='loginbtn'
                                            class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button> -->
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>