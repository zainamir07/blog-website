<?php include "includes/head.php";

if(checkLogin() == false){
    header('location: index.php');
    exit();
}
?>
<style>
  .short-description {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
<?php 
/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }
 
  $userID = $_SESSION['uID'];
            
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
                        
                        <?php 
           
             $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' AND `blog_postedBy` = '$userID' ORDER BY `blog_id` DESC";
             $result = mysqli_query($con, $sql);
             if($result){
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  ?>
                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <!-- <img class="img-fluid" src="img/blog/blog1.png" alt=""> -->
                               <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"><img class="img-fluid" style="max-height: 500px;" src="<?php echo "admin/".$row['blog_image']; ?>" alt="Featured Image"></a> 
                                <ul class="thumb-info">
                                    <li><a href="#"><i class="ti-user"></i><?php echo getUserName($row['blog_postedBy']); ?></a></li>
                                    <li><a href="#"><i class="ti-notepad"></i> <?php 
                                    // $blogIDComment = $row['blog_id'];
                                    echo timeago($row['blog_createddate']); ?></a></li>
                                    <!-- <li><a href="#"><i class="ti-themify-favicon"></i>(1) Comments</a></li> -->
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>">
                                    <h3><?php echo $row['blog_title']; ?></h3>
                                </a>
                                <p class="tag-list-inline"><strong>Tag:</strong> <?php echo $row['blog_tags']; ?></p>
                                <p class="short-description"><?php// echo $row['blog_description']; ?></p>
                                <a class="button" href="blog.php?blogID=<?php echo $row['blog_id']; ?>">Read Blog <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                }
              }
             }

           ?>
                          
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