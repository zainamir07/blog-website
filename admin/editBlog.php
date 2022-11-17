<?php include "includes/head.php"; ?>

<?php 

/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

$blogTitle = $blogDescription = $blogCategory = $blogTags = $blogStatus = $blogID  = $blogImage = $blogOldImage = "";

if(isset($_GET['blogID']) && $_GET['blogID'] != ""){
    $blogID = $_GET['blogID'];
    $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_id` = '$blogID'";
    $result = mysqli_query($con,$sql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                $blogTitle = $row['blog_title'];
                $blogDescription = $row['blog_description'];
                $blogCategory = $row['blog_category'];
                $blogStatus = $row['blog_status'];
                $blogTags = $row['blog_tags'];
                $blogImage = $row['blog_image'];
                $blogOldImage = $row['blog_image'];
            }
    
        }else{
         $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
          header("location:teamCoaches.php");
          exit();
        }
      }
    }else{
      $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
      header("location:teamCoaches.php");
      exit();
}

// if(isset($_GET['publishArticle'])){
//     $publishArticle = $_GET['publishArticle'];
//     $sql = "UPDATE `tbl_blogs` SET `blog_status` = 'A' ";
//     $result = mysqli_query($con,$sql);

//     if($result){
//         $_SESSION["successMessage"] = "Article has been Published";
//         header("location:viewAllBlogs.php");
//         exit();
//     }

// }


if(isset($_POST['updateArticle'])){

    if(empty($_POST['blogTitle'])){
        array_push($_SESSION['errors'], "Title is required");
    }else{
        $blogTitle = mysqli_real_escape_string($con, $_POST['blogTitle']);
    }

    if(empty($_POST['blogDescription'])){
        array_push($_SESSION['errors'], "Description is required");
    }else{
        $blogDescription = mysqli_real_escape_string($con, $_POST['blogDescription']);
    }

    if(empty($_POST['blogTags'])){
        array_push($_SESSION['errors'], "Blog Tags is required");
    }else{
        $blogTags = mysqli_real_escape_string($con, $_POST['blogTags']);
    }

    if(empty($_POST['blogCategory'])){
        array_push($_SESSION['errors'], "Blog Category is required");
    }else{
        $blogCategory = mysqli_real_escape_string($con, $_POST['blogCategory']);
    }

    if(empty($_POST['blogStatus'])){
        array_push($_SESSION['errors'], "Blog Category is required");
    }else{
        $blogStatus = mysqli_real_escape_string($con, $_POST['blogStatus']);
    }

    if( basename($_FILES["blogImage"]["name"] != "")){
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp.'-'.basename($_FILES["blogImage"]["name"]);
        $target_file_db = "uploads/" . $timestamp.'-'.basename($_FILES["blogImage"]["name"]);
  
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["blogImage"]["tmp_name"]);
        if($check !== false) {
              
            if (file_exists($target_file)) {
                array_push($_SESSION['errors'], "Sorry, file already exists");
            }
  
            //Check file size
            if ($_FILES["blogImage"]["size"] > 50000000000) {
                array_push($_SESSION['errors'], "File is too large");
            }
  
  
           if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                array_push($_SESSION['errors'], "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            if (isset($_SESSION['errors']) && count($_SESSION['errors']) == 0) {
                if (move_uploaded_file($_FILES["blogImage"]["tmp_name"], $target_file)) {
                  unlink($blogImage);        
                  $blogImage = $target_file_db;
  
                } else {
                  array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
                }
            }        
          } else {
              array_push($_SESSION['errors'], "Please Upload Image File Only");
          }
          
        }else{
          $blogImage = $blogOldImage;
        }
  
        // else{
        //     array_push($_SESSION['errors'], "Images is require");
            
        // }

        if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
             $sql = "UPDATE `tbl_blogs` SET `blog_title` = '$blogTitle', `blog_description` = '$blogDescription',`blog_category` = '$blogCategory', `blog_status` = '$blogStatus', `blog_tags` = '$blogTags', `blog_image` = '$blogImage' WHERE `blog_id` = '$blogID' ";
           
             $result = mysqli_query($con,$sql);

            if($result){
                $_SESSION["successMessage"] = "Article has been Updated";
                header("location:viewAllBlogs.php");
                exit();
            }
        }



}

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "includes/sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "includes/topnav.php"; ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add New Blog</h1>
                    <div class="container">
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
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <!-- <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div> -->
                                            <form method="POST" action="editBlog.php?blogID=<?php echo $blogID; ?>" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <div class="col-md-12 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="blogTitle" name="blogTitle"
                                                            placeholder="Write a blog Title" value="<?php echo $blogTitle; ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea name="blogDescription" class="form-control mt-4"
                                                            id="blogDescription" cols="30" rows="10"
                                                            placeholder="Write Your Article here..."><?php echo $blogDescription; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="blogTags"
                                                        placeholder="Blog Tags (e.g Entertainment, Health etc)"
                                                        name="blogTags" value="<?php echo $blogTags; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="blogStatus" class="form-control" id="blogStatus">
                                                            <option value="">Select Status</option>
                                                            <option <?php if($blogStatus == "A"){echo "selected";} ?> value="A">Active</option>
                                                            <option <?php if($blogStatus == "P"){echo "selected";} ?> value="P">Pending</option>
                                                            <option <?php if($blogStatus == "B"){echo "selected";} ?> value="B">Block</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <select name="blogCategory" id="blogCategory"
                                                            class="form-control ">
                                                            <option value="">Select category</option>
                                                            <option <?php if($blogCategory == 'html'){echo 'selected';} ?> value="html">HTML</option>
                                                            <option <?php if($blogCategory == 'css'){echo 'selected';} ?> value="css">CSS</option>
                                                            <option <?php if($blogCategory == 'js'){echo 'selected';} ?> value="js">JS</option>
                                                            <option <?php if($blogCategory == 'php'){echo 'selected';} ?> value="php">PHP</option>
                                                            <option <?php if($blogCategory == 'python'){echo 'selected';} ?> value="python">Python</option>
                                                            <option <?php if($blogCategory == 'termux'){echo 'selected';} ?> value="termux">Termux</option>
                                                            <option <?php if($blogCategory == 'hacking'){echo 'selected';} ?> value="hacking">Hacking</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-8 col-lg-8">
                                                        <input type="file" class="form-control" name="blogImage"
                                                            id="blogImage">
                                                        </div>
                                                        <div class="col-md-4 col-lg-4">
                                                            <img src="<?php echo $row['blog_image']; ?>" height="50px" alt="">
                                                        </div>
                                                    </div>
                                                        <!-- <label for="blogImage" class="form-control-user form-control">Upload Featured Image</label> -->
                                                        
                                                    </div>
                                                </div>


                                                <button name="updateArticle"
                                                    class="btn btn-primary btn-user btn-block">
                                                    Publish Article
                                                </button>
                                            </form>
                                            <hr>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <?php include "includes/footer.php"; ?>


                <?php include "includes/jsfiles.php"; ?>


</body>

</html>