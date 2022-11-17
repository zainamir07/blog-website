<?php include "includes/head.php"; ?>
<style>
.short-description {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
<?php 
/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

  if(isset($_GET['type']) && $_GET['type'] != 0){
    $categoryType = $_GET['type'];
  }



?>

<body>
    <?php include "includes/header.php"; ?>

    <main class="site-main">
        <!--================ Start Blog Post Area =================-->

        <section class="blog-post-area section-margin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <?php
                  $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' AND `blog_category` = '$categoryType' ORDER BY `blog_id` DESC LIMIT 7 ";
                  $result = mysqli_query($con, $sql);
                  if($result){
                   if(mysqli_num_rows($result)>0){
                     while($row = mysqli_fetch_assoc($result)){
                       ?>
                            <div class="col-md-6">
                                <div class="single-recent-blog-post card-view">
                                    <div class="thumb">
                                       <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"><img class="card-img rounded-0" src="<?php echo "admin/".$row['blog_image']; ?>"
                                            alt="Featured Image"></a>
                                        <ul class="thumb-info">
                                            <li><a><i
                                                        class="ti-user"></i><?php echo getUserName($row['blog_postedBy']); ?></a>
                                            </li>
                                            <li><a><i
                                                        class="ti-user"></i><?php echo timeago($row['blog_createddate']); ?></a>
                                            </li>
                                            <!-- <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li> -->
                                        </ul>
                                    </div>
                                    <div class="details mt-20">
                                        <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>">
                                            <h3><?php echo $row['blog_title']; ?></h3>
                                        </a>
                                        <p class="short-description"><?php echo $row['blog_description']; ?></p>
                                        <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php  }
              }else{
                ?>
                <div class="alert alert-info">Not Found</div>
                <?php
              }
             }
             ?>
                   </div>
                   </div>



        <!--================ Start Blog Post Area =================-->

        <!-- Start Blog Post Siddebar -->
        <?php include "includes/sidebar.php"; ?>
        <!-- End Blog Post Siddebar -->
        </div>
        </section>
        <!--================ End Blog Post Area =================-->
        </div>
        </section>

        <!--================ End Blog Post Area =================-->
    </main>
    <?php include "includes/footer.php"; ?>
    <?php include "includes/jsfiles.php"; ?>


</body>

</html>