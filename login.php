<?php include "includes/head.php"; ?>
<?php 
/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
  }
  /*--create session array for storing errors-end--*/
  $email = $password = "";
  
  if(isset($_POST['loginbtn'])){
    if (empty($_POST['email'])) {
      array_push($_SESSION['errors'],'Email is Required');
    }else{
      $email = mysqli_real_escape_string($con,$_POST['email']);
    }
    
    if (empty($_POST['password'])) {
      array_push($_SESSION['errors'],'Password is Required');
    }else{
      $password = md5($_POST['password']);
    }
  
    if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
      $sql = "SELECT * FROM `tbl_users` WHERE `user_email` = '$email'  AND `user_password` = '$password' AND `user_type` = 'U' ";
      
      $result = mysqli_query($con,$sql);
      if($result){
        if(mysqli_num_rows($result) == 1){
          if($row = mysqli_fetch_assoc($result)){
              
              if($row['user_status'] == "A"){
                $_SESSION['uID'] =  $row['user_id'];
                $_SESSION['uFullName'] = $row['user_name'];
                $_SESSION['uEmail'] = $row['user_email'];
                $_SESSION['uType'] = $row['user_type'];
                $_SESSION['uClubID'] = $row['user_clubManagerID'];
                $_SESSION['uImage'] = $row['user_image'];
  
                header("location:index.php");
                exit();
              }else if($row['user_status'] == "B"){
                array_push($_SESSION['errors'], "Your Account has been Blocked By Admin.");
              }else if($row['user_status'] == "P"){
                array_push($_SESSION['errors'], "Your Account is in pending state, After admin approval you can login.");
              }else if($row['user_status'] == "R"){
                array_push($_SESSION['errors'], "Your Account has been Rejected by Admin.");
              }
              
            
          }
        }else{
          array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials");
        }
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
                        <form action="login.php" method="post">
                            <div class="conteiner">
                                <div class="container mb-5 mt-3">
                                    <h2>Register Now</h2>
                                </div>

                                <!-- <div class="row"> -->

                                <div class="col mb-3">
                                    <input type="email" placeholder="Enter Your Email Address" name="email"
                                        class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <input type="password" placeholder="Password" name="password" class="form-control">
                                </div>
                                <div class="col mb-3">
                                    <button class="btn btn-warning mt-4" name="loginbtn" type="submit">Login</button>
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