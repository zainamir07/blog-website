<?php include "includes/head.php"; 
if(checkLogin() == false){
  header('location: index.php');
  exit();
}
?>
<?php  

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
    $_SESSION['errors'] = array();
  }
  
  $confirmPassword = $newPassword  =  $oldPassword = $memberID = "";
  $userID = $_SESSION['uID'];
  
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
      $result = mysqli_query($con,$sql);
      if ($result) {
        $_SESSION['successMessage'] = "Password Updated Successfully, Please Login with new Password";
        header("location:logout.php");
        exit();
      }
    }
  
  }
  

?>
<body>
    <?php include "includes/header.php"; ?>

    <main class="site-main">
        <!--================Hero Banner start =================-->
        <!-- <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h3>Tours & Travels</h3>
            <h1>Amazing Places on earth</h1>
            <h4>December 12, 2018</h4>
          </div>
        </div>
      </div>
    </section> -->
        <!--================Hero Banner end =================-->

        <!--================ Blog slider start =================-->

        <!--================ Blog slider end =================-->

        <!--================ Start Blog Post Area =================-->
        <section class="blog-post-area section-margin mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                    <?php 
							if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
								$errors = $_SESSION['errors'];
								foreach($errors as $error){
									?>
                                <div class="alert alert-danger ">
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
                                      
                                    </form>
                    </div>
                    <!-- Start Blog Post Siddebar -->
                    <?php include "includes/sidebar.php"; ?>
                    <!-- End Blog Post Siddebar -->
                </div>
        </section>
        <!--================ End Blog Post Area =================-->
    </main>
    <?php include "includes/footer.php"; ?>
    <?php include "includes/jsfiles.php"; ?>


</body>

</html>