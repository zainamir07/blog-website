<?php include "includes/head.php"; ?>
<?php 
/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }
  $userName = $userEmail = $userPassword = $userConfirmPassword0 = $userType = $userStatus = $userCreatedDate = '';

if(isset($_POST['registerbtn'])){

    if(empty($_POST['userFullName'])){
        array_push($_SESSION['errors'], 'Name is require');
    }else{
        $userName = mysqli_real_escape_string($con, $_POST['userFullName']);
    }
    
    if(empty($_POST['userEmail'])){
        array_push($_SESSION['errors'], 'Email is require');
    }else{
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
    }
    
    // if(empty($_POST['userPassword'])){
    //     array_push($_SESSION['errors'], 'Password is require');
    // }else{
    //     $userPassword =  md5($_POST['userPassword']);
    // }
    
    // if(empty($_POST['userConfirmPassword'])){
    //     array_push($_SESSION['errors'], 'Confirm Password is require');
    // }else{
    //     $userConfirmPassword = md5($_POST['userPassword']);
    // }
    if (empty($_POST['userPassword'])) {
		array_push($_SESSION['errors'],'Password is Required');
	}else{
		$userPassword = $_POST['userPassword'];
	}

	if (empty($_POST['userConfirmPassword'])) {
		array_push($_SESSION['errors'],'Confirm Password is Required');
	}else{
		$userConfirmPassword = $_POST['userConfirmPassword'];
	}

	if($userPassword != $userConfirmPassword){
		array_push($_SESSION['errors'],'Confirm Password are not match ');
	}else{
		$userPassword = md5($_POST['userPassword']);
	}


    if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
       $userType = 'U';
       $userStatus = 'P';
       $userCreatedDate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `tbl_users` (`user_name`,`user_email`, `user_password`, `user_type`, `user_status`, `user_createdDate`) VALUES('$userName', '$userEmail', '$userPassword', '$userType', '$userStatus', '$userCreatedDate')";
        $result = mysqli_query($con, $sql);
        if($result){

            $_SESSION['successMessage'] = "Thanks for registerd. Your Mebership is Pending";
            header("location:register.php");
            exit();
            // if(mysqli_num_rows($result)>0){
            //     if($row = mysqli_fetch_assoc($result)){
                    
            //     }
            // }
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
                        <form action="register.php" method="post">
                            <div class="conteiner">
                                <div class="container mb-5 mt-3">
                                    <h2>Register Now</h2>
                                </div>
                             
                                <!-- <div class="row"> -->
                                <div class="col mb-3">
                                    <input type="text" placeholder="Enter Your Full Name" name="userFullName"
                                        class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <input type="email" placeholder="Enter Your Email Address" name="userEmail"
                                        class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <input type="password" placeholder="Password" name="userPassword"
                                        class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <input type="password" placeholder="Confirm Password" name="userConfirmPassword"
                                        class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <button class="btn btn-warning mt-4" name="registerbtn" type="submit">Submit For
                                        Review</button>
                                </div>
                            </div>
                            <!-- </div> -->

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