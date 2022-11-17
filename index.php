<?php include "includes/head.php"; ?>
<style>
  .short-description {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
<body>
    <?php include "includes/header.php"; ?>

    <main class="site-main">
      
        <!--================ Blog slider start =================-->
        <section>
            <div class="container">
                <div class="owl-carousel owl-theme blog-slider">
                    <?php 
             
             $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' ORDER BY `blog_id` DESC ";
             $result = mysqli_query($con, $sql);
             if($result){
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                  ?>
                    <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <!-- <img class="card-img rounded-0" src="img/blog/blog-slider/blog-slide1.png" alt=""> -->
                            <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"> <img class="img-fluid" src="<?php echo "admin/".$row['blog_image']; ?>" style="max-height:235px;" alt="Featured Image"></a>
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label"><?php echo getCategory($row['blog_category']); ?></a>
                            <h3><a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"><?php echo $row['blog_title']; ?></a></h3>
                            <p><?php echo timeago($row['blog_createddate']); ?></p>
                        </div>
                    </div>
                    <?php
                }
              }
             }

           ?>
<!-- 
                   <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="img/blog/blog-slider/blog-slide3.png" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="#">Fashion</a>
                            <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                            <p>2 days ago</p>
                        </div>
                    </div>
                    <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="img/blog/blog-slider/blog-slide1.png" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="#">Fashion</a>
                            <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                            <p>2 days ago</p>
                        </div>
                    </div>
                    <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="img/blog/blog-slider/blog-slide2.png" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="#">Fashion</a>
                            <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                            <p>2 days ago</p>
                        </div>
                    </div>
                    <div class="card blog__slide text-center"> -->
                        <!-- <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="img/blog/blog-slider/blog-slide3.png" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="#">Fashion</a>
                            <h3><a href="#">New york fashion week's continued the evolution</a></h3>
                            <p>2 days ago</p>
                        </div> -->
                    </div>
              
                </div>
            </div>
        </section>
        <!--================ Blog slider end =================-->

        <!--================ Start Blog Post Area =================-->
        <section class="blog-post-area section-margin mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                    <?php 
             
             $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' ORDER BY `blog_id` DESC LIMIT 7 ";
             $result = mysqli_query($con, $sql);
             if($result){
              if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $imgPath = "admin/".$row['blog_image'];
                  ?>
                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <!-- <img class="img-fluid" src="img/blog/blog1.png" alt=""> -->
                                
                               <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"> <img class="img-fluid" src="<?php echo $imgPath; ?>" style="max-height: 500px;" alt="Featured Image"></a>
                                <ul class="thumb-info">
                                    <li><a><i class="ti-user"></i><?php echo getUserName($row['blog_postedBy']); ?></a></li>
                                    <li><a><i class="ti-notepad"></i><?php echo timeago($row['blog_createddate']); ?></a></li>
                                    <!-- <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li> -->
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>">
                                    <h3><?php echo $row['blog_title']; ?></h3>
                                </a>
                                <p class="tag-list-inline"><strong>Tag:</strong> <?php echo $row['blog_tags']; ?></p>
                                <div class="short-description">
                                    <?php// echo $row['blog_description']; ?>
                                     </div>
                                <a class="button" href="blog.php?blogID=<?php echo $row['blog_id']; ?>">Read Blog <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php
                }
              }
             }

           ?>
                        <!-- <div class="single-recent-blog-post">
                            <div class="thumb">
                                <img class="img-fluid" src="img/blog/blog2.png" alt="">
                                <ul class="thumb-info">
                                    <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                                    <li><a href="#"><i class="ti-notepad"></i>January 12,2019</a></li>
                                    <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog-single.html">
                                    <h3>Woman claims husband wants to name baby girl
                                        after his ex-lover sparking.</h3>
                                </a>
                                <p class="tag-list-inline">Tag: <a href="#">travel</a>, <a href="#">life style</a>, <a
                                        href="#">technology</a>, <a href="#">fashion</a></p>
                                <p>Over yielding doesn't so moved green saw meat hath fish he him from given yielding
                                    lesser cattle were fruitful lights. Given let have, lesser their made him above
                                    gathered dominion sixth. Creeping deep said can't called second. Air created seed
                                    heaven sixth created living</p>
                                <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <img class="img-fluid" src="img/blog/blog3.png" alt="">
                                <ul class="thumb-info">
                                    <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                                    <li><a href="#"><i class="ti-notepad"></i>January 12,2019</a></li>
                                    <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog-single.html">
                                    <h3>Tourist deaths in Costa Rica jeopardize safe dest
                                        ination reputation all time. </h3>
                                </a>
                                <p class="tag-list-inline">Tag: <a href="#">travel</a>, <a href="#">life style</a>, <a
                                        href="#">technology</a>, <a href="#">fashion</a></p>
                                <p>Over yielding doesn't so moved green saw meat hath fish he him from given yielding
                                    lesser cattle were fruitful lights. Given let have, lesser their made him above
                                    gathered dominion sixth. Creeping deep said can't called second. Air created seed
                                    heaven sixth created living</p>
                                <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <img class="img-fluid" src="img/blog/blog4.png" alt="">
                                <ul class="thumb-info">
                                    <li><a href="#"><i class="ti-user"></i>Admin</a></li>
                                    <li><a href="#"><i class="ti-notepad"></i>January 12,2019</a></li>
                                    <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="blog-single.html">
                                    <h3>Tourist deaths in Costa Rica jeopardize safe dest
                                        ination reputation all time. </h3>
                                </a>
                                <p class="tag-list-inline">Tag: <a href="#">travel</a>, <a href="#">life style</a>, <a
                                        href="#">technology</a>, <a href="#">fashion</a></p>
                                <p>Over yielding doesn't so moved green saw meat hath fish he him from given yielding
                                    lesser cattle were fruitful lights. Given let have, lesser their made him above
                                    gathered dominion sixth. Creeping deep said can't called second. Air created seed
                                    heaven sixth created living</p>
                                <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
 -->


                        <div class="row">
                            <div class="col-lg-12">
                                <nav class="blog-pagination justify-content-center d-flex">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a href="#" class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">
                                                    <i class="ti-angle-left"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item">
                                            <a href="#" class="page-link" aria-label="Next">
                                                <span aria-hidden="true">
                                                    <i class="ti-angle-right"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
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