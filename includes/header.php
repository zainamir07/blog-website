  <!--================Header Menu Area =================-->
  <header class="header_area">
      <div class="main_menu">
          <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container box_1620">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <a class="navbar-brand logo_h" href="index.php">
                    <!-- <img src="img/logo.png" alt=""> -->
                    <strong class="logo_text" style="font-size: 28px;"> Coding World</strong>
                </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                      aria-label="Toggle navigation">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                      <ul class="nav navbar-nav menu_nav justify-content-center">
                          <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                          <!-- <li class="nav-item"><a class="nav-link" href="archive.html">Archive</a></li>  -->
                          <li class="nav-item submenu dropdown">
                              <a href="dashboard.php" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                  role="button" aria-haspopup="true" aria-expanded="false">Category</a>
                              <ul class="dropdown-menu">
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=html">HTML</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=css">CSS</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=js">JS</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=php">PHP</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=python">Python</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=termux">Termux</a></li>
                                  <li class="nav-item"><a class="nav-link" href="category.php?type=hacking">Hacking</a></li>
                              </ul>
                          </li>
                          <!-- <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li> -->
                          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

                          <?php 
                    //    if($_SESSION['uType'] == "U"){
                        if( array_key_exists('uType', $_SESSION) ) {
                            //It exists
                        ?>
                          <li class="nav-item submenu dropdown">
                              <a href="dashboard.php" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                  role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                              <ul class="dropdown-menu">
                                  <li class="nav-item"><a class="nav-link" href="profile.php">My Profile</a></li>
                                  <li class="nav-item"><a class="nav-link" href="myblogs.php">My Blogs</a></li>
                                  <li class="nav-item"><a class="nav-link" href="addNewBlog.php">Add New Blog</a></li>
                                  <li class="nav-item"><a class="nav-link" href="changePassword.php">Change Password</a></li>
                                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                              </ul>
                          </li>
                          <!-- <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li> -->
                          <?php
                      }else{
                        ?>
                          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                          <?php

                      }
                      ?>

                      </ul>
                      <ul class="nav navbar-nav navbar-right navbar-social">
                          <li><a href="#"><i class="ti-facebook"></i></a></li>
                          <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                          <li><a href="#"><i class="ti-instagram"></i></a></li>
                          <li><a href="#"><i class="ti-skype"></i></a></li>
                      </ul>


                  </div>
              </div>
          </nav>
      </div>
  </header>
  <!--================Header Menu Area =================-->