<?php include "includes/head.php"; ?>
<style>
/* .padding {
    padding: 3rem !important
} */
<?php
if(checkLogin() == false){
    header('location: index.php');
    exit();
}

?>
.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263);
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

.img-radius {
    border-radius: 5px;
}



h6 {
    font-size: 14px;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px;
    }
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    /* color: #919aa3 !important; */
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
h2{
    font-size: 36px;
}
</style>
<?php 

 

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

                        <h2 class=" mb-4 mt-3">My Profile</h2>
                        <div class="page-content page-container" id="page-content">
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
                                                        <?php
                                                        $userID = $_SESSION['uID'];
                                                        $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userID' ";
                                                        $result = mysqli_query($con, $sql);
                                                        if($result){
                                                            if(mysqli_num_rows($result)>0){
                                                                if($row = mysqli_fetch_assoc($result)){
                                                                   $userName = $row['user_name'];
                                                                   
                                                                    $userEmail = $row['user_email'];
                                                                    $userContactNo = $row['user_contactNo'];
                                                                    $userTitle = $row['user_title'];
                                                                    $userDescription = $row['user_description'];
                                                                
                                                                }
                                                            }
                                                        }
                                                             ?>
                                                        <h6 class="f-w-600 text-white"><?php echo $userName; ?></h6>
                                                        <p><?php echo $userTitle; ?></p>
                                                        <i
                                                            class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card-block">
                                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Contact</h6>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Email</p>
                                                                <h6 class="text-muted f-w-400"><?php echo $userEmail; ?></h6>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Phone</p>
                                                                <h6 class="text-muted f-w-400"><?php echo $userContactNo; ?></h6>
                                                            </div>
                                                        </div>
                                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">About
                                                        </h6>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <!-- <p class="m-b-10 f-w-600">Recent</p> -->
                                                                <h6 class="text-muted f-w-400"><?php echo $userDescription;  ?></h6>
                                                            </div>
                                                            <!-- <div class="col-sm-6">
                                                                <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                                            </div> -->
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
                            <div class="container text-center">
                                <a href="editProfile.php" class="btn btn-primary">Edit</a>
                            </div>
                        </div>


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