<?php include "includes/head.php"; ?>
<?php 
/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

  if(isset($_GET['blogID']) && $_GET['blogID'] != 0){
    $blogID = $_GET['blogID'];
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
                        <div class="main_blog_details">
                            <?php 
                         $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' AND `blog_id` = '$blogID ' ORDER BY `blog_id` DESC LIMIT 7 ";
                         $result = mysqli_query($con, $sql);
                         if($result){
                          if(mysqli_num_rows($result)>0){
                            if($row = mysqli_fetch_assoc($result)){
                              ?>
                            <!-- <img class="img-fluid" src="img/blog/blog4.png" alt=""> -->
                            <img class="img-fluid" src="<?php echo "admin/".$row['blog_image']; ?>" alt="Featured Image"
                                style="max-height: 500px;">
                            <br>
                            <a href="#">
                                <h4><?php echo $row['blog_title']; ?></h4>
                            </a>
                            <div class="user_details">
                                <div class="float-left">
                                    <a href="#"><?php echo getCategory($row['blog_category']); ?></a>
                                </div>
                                <div class="float-right mt-sm-0 mt-3">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5><?php echo getUserName($row['blog_postedBy']); ?></h5>
                                            <p><?php echo $row['blog_createddate']; ?></p>
                                        </div>
                                        <div class="d-flex">
                                            <img width="42" height="42"
                                                src="https://img.icons8.com/bubbles/100/000000/user.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p><?php echo $row['blog_description']; ?></p>
                            <!-- <blockquote class="blockquote"> -->
                            <p class="mb-0">MCSE boot camps have its supporters and its detractors. Some people do not
                                understand why you should have to spend money on boot camp when you can get the MCSE
                                study materials yourself at a fraction of the camp price. However, who has the willpower
                                to actually sit through a self-imposed MCSE training.</p>
                            </blockquote>
                            <?php  }
              }
             }

           ?>
                            <div class="news_d_footer flex-column flex-sm-row">
                                <a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4
                                    people like this</a>
                                <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><span
                                        class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>(<?php 
                    $sql = "SELECT count(*) as `total` FROM `tbl_comments` WHERE `com_blogID` = '$blogID'";
                    $result = mysqli_query($con,$sql);
                    if($result){
                      if($row= mysqli_fetch_array($result)){
                        echo $row['total'];
                      }
                    }
                    ?>) Comments</a>
                                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-behance"></i></a>
                                </div>
                            </div>
                        </div>


                        <div class="navigation-area">
                            <div class="row">
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                    <?php
                  //  $sql2 = "SELECT * FROM `tbl_blogs` where `blog_id` = (select min($blogID) from `blog_id` where `blog_id` > $blogID)";
                  // // $sql = "SELECT min(blog_id) FROM `tbl_blog` where `blog_id` > $blogID)";
                  // $result2 = mysqli_query($con, $sql2);
                  // if(mysqli_num_rows($result2)>0){
                  //   if($row2 = mysqli_fetch_assoc($result2)){
                      ?>
                                    <!-- <div class="thumb">
                      <a href="#"><img class="img-fluid" src="<?php// echo $row2['blog_image']; ?>" alt=""></a>
                  </div>
                  <div class="arrow">
                      <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                  </div>
                  <div class="detials">
                      <p>Prev Post</p>
                      <a href="#"><h4><?php// echo $row2['blog_title']; ?></h4></a>
                  </div> -->
                                    <?php
                  //   }else{
                  //     echo "rows found. but not data fetch";
                  //   }
                  //  }else{
                  //   echo "No Rows Found";
                  //  }
                    
                    ?>

                                </div>
                                <div
                                    class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                    <div class="detials">
                                        <p>Next Post</p>
                                        <a href="#">
                                            <h4>Cartridge Is Better</h4>
                                        </a>
                                    </div>
                                    <div class="arrow">
                                        <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                                    </div>
                                    <div class="thumb">
                                        <a href="#"><img class="img-fluid" src="img/blog/next.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="comments-area">

                            <h4> (<?php 
                    $sql = "SELECT count(*) as `total` FROM `tbl_comments` WHERE `com_status` = 'A' AND `com_blogID` = '$blogID'";
                    $result = mysqli_query($con,$sql);
                    if($result){
                      if($row= mysqli_fetch_array($result)){
                        echo $row['total'];
                      }
                    }else{
                      echo "0";
                    }
                    ?>) Comments</h4>
                            <?php
                    $sql = "SELECT * FROM `tbl_comments` WHERE `com_status` = 'A' AND `com_blogID` = '$blogID' ORDER BY `com_id` DESC ";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <div class="comment-list" id="<?php echo $row['com_id']; ?>">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="img/blog/c1.jpg" alt="">
                                        </div>
                                        <div class="desc">
                                            <h5><a><?php echo $row['com_name'];  ?></a></h5>
                                            <p class="date"><?php echo $row['com_createdDate']; ?> </p>
                                            <p class="comment">
                                                <?php echo $row['com_message']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="reply-btn">
                                        <a href="" class="btn-reply text-uppercase">reply</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                      }
                    }



                     ?>
                            <!-- <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>	
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>	
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c4.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Maria Luna</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>	
                    <div class="comment-list"> -->
                            <!-- <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c5.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Ina Hayes</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>	                                             				 -->
                        </div>

                        <?php
                $comName = $comEmail = $comSubject = $comMessage = $comCreatedDate = "";
                if(isset($_POST['addComment'])){

                  if(empty($_POST['comName'])){
                      array_push($_SESSION['errors'], "Name is required");
                  }else{
                      $comName = mysqli_real_escape_string($con, $_POST['comName']);
                  }
                  if(empty($_POST['comEmail'])){
                    array_push($_SESSION['errors'], "Email is required");
                }else{
                    $comEmail = mysqli_real_escape_string($con, $_POST['comEmail']);
                }
                if(empty($_POST['comMessage'])){
                  array_push($_SESSION['errors'], "Message is required");
              }else{
                  $comMessage = mysqli_real_escape_string($con, $_POST['comMessage']);
              }
              $comSubject = mysqli_real_escape_string($con, $_POST['comSubject']);

              if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {

               $comStatus = "P";
                $comCreatedDate = date("Y-m-d H:i:s");
               $sql = "INSERT INTO `tbl_comments` (`com_name`,`com_email`, `com_subject`, `com_message`, `com_createdDate`, `com_blogID`, `com_status`) VALUES('$comName', '$comEmail', '$comSubject', '$comMessage', '$comCreatedDate', '$blogID', '$comStatus')";
                      
                $result = mysqli_query($con,$sql);
    
                if($result){
                    $_SESSION["successMessage"] = "Thanks, Your Comment is Pending for Admin Apporoval";
                    // header("location:blogs.php?blogID=$blogID#comment-form");
                    // exit();
                }
            }


                }




                    ?>
                        <div class="comment-form" id="comment-form">
                            <h4>Leave a Reply</h4>
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

                            <form method="POST" action="blog.php?blogID=<?php echo $blogID;?>">
                                <div class="form-group form-inline">
                                    <div class="form-group col-lg-6 col-md-6 name">
                                        <input type="text" class="form-control" id="name" name="comName"
                                            placeholder="Enter Name" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter Name'">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 email">
                                        <input type="email" class="form-control" id="email" name="comEmail"
                                            placeholder="Enter email address" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter email address'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="comSubject"
                                        placeholder="Subject" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Subject'">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control mb-10" rows="5" name="comMessage"
                                        placeholder="Messege" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Messege'" required=""></textarea>
                                </div>
                                <button type="submit" name="addComment" class="button submit_btn">Post Comment</button>
                            </form>
                        </div>
                    </div>

                    <!-- Start Blog Post Siddebar -->
                    <!-- <div class="col-lg-4 sidebar-widgets">
                        <div class="widget-wrap">
                            <div class="single-sidebar-widget newsletter-widget">
                                <h4 class="single-sidebar-widget__title">Newsletter</h4>
                                <div class="form-group mt-30">
                                    <div class="col-autos">
                                        <input type="text" class="form-control" id="inlineFormInputGroup"
                                            placeholder="Enter email" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Enter email'">
                                    </div>
                                </div>
                                <button class="bbtns d-block mt-20 w-100">Subcribe</button>
                            </div>


                            <div class="single-sidebar-widget post-category-widget">
                                <h4 class="single-sidebar-widget__title">Catgory</h4>
                                <ul class="cat-list mt-20">
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Technology</p>
                                            <p>(03)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Software</p>
                                            <p>(09)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Lifestyle</p>
                                            <p>(12)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Shopping</p>
                                            <p>(02)</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p>Food</p>
                                            <p>(10)</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="single-sidebar-widget popular-post-widget">
                                <h4 class="single-sidebar-widget__title">Popular Post</h4>
                                <div class="popular-post-list">
                                    <div class="single-post-list">
                                        <div class="thumb">
                                            <img class="card-img rounded-0" src="img/blog/thumb/thumb1.png" alt="">
                                            <ul class="thumb-info">
                                                <li><a href="#">Adam Colinge</a></li>
                                                <li><a href="#">Dec 15</a></li>
                                            </ul>
                                        </div>
                                        <div class="details mt-20">
                                            <a href="blog-single.html">
                                                <h6>Accused of assaulting flight attendant miktake alaways</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="single-post-list">
                                        <div class="thumb">
                                            <img class="card-img rounded-0" src="img/blog/thumb/thumb2.png" alt="">
                                            <ul class="thumb-info">
                                                <li><a href="#">Adam Colinge</a></li>
                                                <li><a href="#">Dec 15</a></li>
                                            </ul>
                                        </div>
                                        <div class="details mt-20">
                                            <a href="blog-single.html">
                                                <h6>Tennessee outback steakhouse the
                                                    worker diagnosed</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="single-post-list">
                                        <div class="thumb">
                                            <img class="card-img rounded-0" src="img/blog/thumb/thumb3.png" alt="">
                                            <ul class="thumb-info">
                                                <li><a href="#">Adam Colinge</a></li>
                                                <li><a href="#">Dec 15</a></li>
                                            </ul>
                                        </div>
                                        <div class="details mt-20">
                                            <a href="blog-single.html">
                                                <h6>Tennessee outback steakhouse the
                                                    worker diagnosed</h6>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-sidebar-widget tag_cloud_widget">
                                <h4 class="single-sidebar-widget__title">Popular Post</h4>
                                <ul class="list">
                                    <li>
                                        <a href="#">project</a>
                                    </li>
                                    <li>
                                        <a href="#">love</a>
                                    </li>
                                    <li>
                                        <a href="#">technology</a>
                                    </li>
                                    <li>
                                        <a href="#">travel</a>
                                    </li>
                                    <li>
                                        <a href="#">software</a>
                                    </li>
                                    <li>
                                        <a href="#">life style</a>
                                    </li>
                                    <li>
                                        <a href="#">design</a>
                                    </li>
                                    <li>
                                        <a href="#">illustration</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
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