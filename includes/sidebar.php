<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget newsletter-widget">
            <?php 
            if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
                $_SESSION['errors'] = array();
              }
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
                        $subscribe = "";
                        if(isset($_POST['subscribeBtn'])){
                            if(empty($_POST['subscribe'])){
                                array_push($_SESSION['errors'], "Email is require");
                            }else{
                                $subscribe = mysqli_real_escape_string($con, $_POST['subscribe']);
                            }
                            // if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
                                $sql = "INSERT INTO `tbl_newsletter` (`newsletter_email`) VALUES('$subscribe')";
                                $result = mysqli_query($con, $sql);
                                if($result){
                                    $_SESSION['successMessage'] = "Thanks for subscribe our newsletter";
                                    // header("location:sidebar.php");
                                    // exit();
                                }
                            // }
                        }
                        

                        ?>
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            <form action="" method="post">
                <div class="form-group mt-30">
                    <div class="col-autos">
                        <input type="text" class="form-control" name="subscribe" id="inlineFormInputGroup"
                            placeholder="Enter email" onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Enter email'">
                    </div>
                </div>
                <button class="bbtns d-block mt-20 w-100" name="subscribeBtn" type="submit">Subcribe</button>
        </div>
        </form>
        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Catgory</h4>
            <ul class="cat-list mt-20">
            <li><a href="category.php?type=html" class="d-flex justify-content-between">
                        <p>HTML</p>
                    </a>
                </li>
                <li><a href="category.php?type=css" class="d-flex justify-content-between">
                        <p>CSS</p>
                    </a>
                </li>
                <li><a href="category.php?type=js" class="d-flex justify-content-between">
                        <p>JS</p>
                    </a>
                </li>
                <li><a href="category.php?type=php" class="d-flex justify-content-between">
                        <p>PHP</p>
                    </a>
                </li>
                <li><a href="category.php?type=python" class="d-flex justify-content-between">
                        <p>Python</p>
                    </a>
                </li>
                <li><a href="category.php?type=termux" class="d-flex justify-content-between">
                        <p>Termux</p>
                    </a>
                </li>
                <li><a href="category.php?type=hacking" class="d-flex justify-content-between">
                        <p>Hacking</p>
                    </a>
                </li>
            </ul>
        </div>

        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Popular Post</h4>

            <?php 
                  $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'A' ORDER BY `blog_id` DESC  LIMIT 3";
                  $result = mysqli_query($con, $sql);
                  if($result){
                    if(mysqli_num_rows($result)){
                      while($row = mysqli_fetch_assoc($result)){
                        ?>
            <div class="popular-post-list">
                <div class="single-post-list">
                    <div class="thumb">
                       <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>"> <img class="card-img rounded-0" src="<?php echo 'admin/'.$row['blog_image']; ?>" alt=""></a>
                        <ul class="thumb-info">
                            <li><a><?php echo getUserName($row['blog_postedBy']); ?></a></li>
                            <li><a><?php echo timeago($row['blog_createddate']); ?></a></li>
                        </ul>
                    </div>
                    <div class="details mt-20">
                        <a href="blog.php?blogID=<?php echo $row['blog_id']; ?>">
                            <h6><?php echo $row['blog_title']; ?></h6>
                        </a>
                    </div>
                </div>
                <?php
                      }
                    }
                  }
                  
                  ?>

                <!-- <div class="thumb">
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
                </div> -->
            </div>
        </div>
    </div>

    <!-- <div class="single-sidebar-widget tag_cloud_widget">
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
    </div> -->
</div>
</div>
</div>