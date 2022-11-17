<?php include "includes/head.php"; ?>

<?php 
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

$userID = $_SESSION['uID'];
$userName = $userEmail = $userContactNo = $userTitle = $userDescription = ""; 

 $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userID' ";

$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
    if($row = mysqli_fetch_assoc($result)){
        $userName = $row['user_name'];
        $userEmail= $row['user_email'];
        
        $userContactNo = $row['user_contactNo'];
        $userDescription = $row['user_description'];
        $userTitle       = $row['user_title'];
        
    }
}else{
    $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
     header("location:profile.php");
     exit();
   }

   if(isset($_POST['submitbtn'])){

    if(empty($_POST['userFullName'])){
        array_push($_SESSION['errors'], "Name is required");
    }else{
        $userName = mysqli_real_escape_string($con, $_POST['userFullName']);
    }

    if(empty($_POST['userEmail'])){
        array_push($_SESSION['errors'], "Email is required");
    }else{
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
    }

    if(empty($_POST['userTitle'])){
        array_push($_SESSION['errors'], "Profile Title is required");
    }else{
        $userTitle = mysqli_real_escape_string($con, $_POST['userTitle']);
    }

    $userContactNo = mysqli_real_escape_string($con, $_POST['userContactNo']);
    $userDescription = mysqli_real_escape_string($con, $_POST['userDescription']);


    // if( basename($_FILES["blogImage"]["name"] != "")){
    //     $target_dir = "../uploads/";
    //     $timestamp = time();
    //     $target_file = $target_dir . $timestamp.'-'.basename($_FILES["blogImage"]["name"]);
    //     $target_file_db = "uploads/" . $timestamp.'-'.basename($_FILES["blogImage"]["name"]);
  
    //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //     $check = getimagesize($_FILES["blogImage"]["tmp_name"]);
    //     if($check !== false) {
              
    //         if (file_exists($target_file)) {
    //             array_push($_SESSION['errors'], "Sorry, file already exists");
    //         }
  
    //         //Check file size
    //         if ($_FILES["blogImage"]["size"] > 50000000000) {
    //             array_push($_SESSION['errors'], "File is too large");
    //         }
  
  
    //        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //             array_push($_SESSION['errors'], "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    //         }
            
    //         if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
    //             if (move_uploaded_file($_FILES["blogImage"]["tmp_name"], $target_file)) {
    //               unlink($blogImage);        
    //               $blogImage = $target_file_db;
  
    //             } else {
    //               array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
    //             }
    //         }        
    //       } else {
    //           array_push($_SESSION['errors'], "Please Upload Image File Only");
    //       }
          
    //     }else{
    //       $blogImage = $blogOldImage;
    //     }
  
        // else{
        //     array_push($_SESSION['errors'], "Images is require");
            
        // }

        if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {

             $sql = "UPDATE `tbl_users` SET `user_name` = '$userName', `user_email` = '$userEmail',`user_title` = '$userTitle', `user_contactNo` = '$userContactNo', `user_description` = '$userDescription' WHERE `user_id` = '$userID' ";
            
           
             $result = mysqli_query($con,$sql);

            if($result){
                $_SESSION["successMessage"] = "Profile has been Updated";
                header("location:profile.php");
                exit();
            }
        }



}
 

// if(isset($_POST['submitbtn'])){

// }


?>
<body>
    <?php include "includes/header.php"; ?>

    <main class="site-main">

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

                            <form action="editProfile.php" method="post">
                                <div class="conteiner">
                                    <div class="container mb-5 mt-3">
                                 <h2 class=" mb-4 mt-3">Edit Profile</h2>
                                </div>
                             
                                <!-- <div class="row"> -->
                                <div class="col mb-3">
                                    <input type="text" placeholder="Enter Your Full Name" name="userFullName"
                                        class="form-control" value="<?php echo $userName; ?>">
                                </div>
                                <div class="col mb-3">
                                    <input type="email" placeholder="Enter Your Email Address" name="userEmail"
                                        class="form-control" value="<?php echo $userEmail; ?>">
                                </div>
                                <div class="col mb-3">
                                    <input type="text" placeholder="Enter Your Phone Number" name="userContactNo"
                                        class="form-control" value="<?php if($userContactNo){echo $userContactNo;} ?>">
                                </div>
                                <div class="col mb-3">
                                    <input type="text" placeholder="Profile Title (e.g Web Designer etc)" name="userTitle"
                                        class="form-control" value="<?php echo $userTitle; ?>">
                                </div>
                                <div class="col mb-3">
                                    <textarea name="userDescription" id="userDescription" cols="30" rows="10" placeholder="About" class="form-control" ><?php echo $userDescription; ?></textarea>
                                    <!-- <input type="text" placeholder="Profile Title (e.g Web Designer etc)" name="usertitle"
                                        class="form-control" value="<?php  ?>"> -->
                                </div>
                                <div class="col mb-3">
                                    <button class="btn btn-warning mt-4" name="submitbtn" type="submit">Save Profile</button>
                                </div>
                            </div>
                            <!-- </div> -->

                        </form>
                  
                        <!-- <div class="page-content page-container" id="page-content">
                            <div class="padding">
                                <div class="row container d-flex justify-content-center">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="card user-card-full">
                                            <div class="row m-l-0 m-r-0">
                                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                                    <div class="card-block text-center text-white">
                                                        <div class="m-b-25">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/user.png"
                                                                class="img-radius" alt="User-Profile-Image">
                                                        </div>
                                                        <h6 class="f-w-600"><?php echo $_SESSION['uFullName']; ?></h6>
                                                        <p>Web Designer</p>
                                                        <i
                                                            class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">About</h6>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Email</p>
                                                                <h6 class="text-muted f-w-400"><?php echo $_SESSION['uEmail']; ?></h6>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Phone</p>
                                                                <h6 class="text-muted f-w-400">98979989898</h6>
                                                            </div>
                                                        </div>
                                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Recent</p>
                                                                <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                                            </div>
                                                        </div>
                                                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                            <li><a href="#!" data-toggle="tooltip"
                                                                    data-placement="bottom" title=""
                                                                    data-original-title="facebook" data-abc="true"><i
                                                                        class="mdi mdi-facebook feather icon-facebook facebook"
                                                                        aria-hidden="true"></i></a></li>
                                                            <li><a href="#!" data-toggle="tooltip"
                                                                    data-placement="bottom" title=""
                                                                    data-original-title="twitter" data-abc="true"><i
                                                                        class="mdi mdi-twitter feather icon-twitter twitter"
                                                                        aria-hidden="true"></i></a></li>
                                                            <li><a href="#!" data-toggle="tooltip"
                                                                    data-placement="bottom" title=""
                                                                    data-original-title="instagram" data-abc="true"><i
                                                                        class="mdi mdi-instagram feather icon-instagram instagram"
                                                                        aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="btn btn-primary">Edit</a>
                        </div> -->


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