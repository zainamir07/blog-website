<?php include "includes/head.php"; ?>

<?php 

/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

$blogTitle = $blogDescription = $blogCategory = $blogTags = $blogImage = $blogStatus = $blogCreatedDate = $blogPostedBy = "";

if(isset($_POST['publishArticle'])){

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

    if( basename($_FILES["blogImage"]["name"] != "")){
        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp.'-'.basename($_FILES["blogImage"]["name"]);
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
                  
                  $blogImage = $target_file;

                } else {
                  array_push($_SESSION['errors'], "Sorry, there was an error uploading your file.");
                }
            }        
          } else {
              array_push($_SESSION['errors'], "Please Upload Image File Only");
          }
          
        }
          

        if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {

            $blogStatus = "A";
            $blogCreatedDate = date("Y-m-d H:i:s");
            $blogPostedBy = $_SESSION['userID'];
            $sql = "INSERT INTO `tbl_blogs` (`blog_title`,`blog_description`, `blog_category`, `blog_status`, `blog_tags`, `blog_image` ,`blog_createdDate`, `blog_postedBy`) VALUES('$blogTitle', '$blogDescription', '$blogCategory', '$blogStatus', '$blogTags', '$blogImage', '$blogCreatedDate', '$blogPostedBy')";
                   
          
                  
            $result = mysqli_query($con,$sql);

            if($result){
                $_SESSION["successMessage"] = "Article has been published";
                header("location:viewAllBlogs.php");
                exit();
            }
        }



}

?>
<style>
    .ck.ck-editor__editable_inline>:last-child {
    height: 200px;
    margin-bottom: var(--ck-spacing-large);
}
</style>
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
                                            <form method="POST" action="addNewBlog.php" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <div class="col-md-12 mb-4 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user mb-4"
                                                            id="blogTitle" name="blogTitle"
                                                            placeholder="Write a blog Title" value="<?php echo $blogTitle; ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- <div id="editor">
                                                        
                                                        </div> -->
                                                        <textarea name="blogDescription" class="form-control mt-4"
                                                            id="blogeditor" cols="30" rows="10"
                                                            placeholder="Write Your Article here..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="blogTags"
                                                        placeholder="Blog Tags (e.g Entertainment, Health etc)"
                                                        name="blogTags" value="<?php echo $blogTags; ?>">
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <select name="blogCategory" id="blogCategory"
                                                            class="form-control ">
                                                            <option value="">Select category</option>
                                                            <option value="html">HTML</option>
                                                            <option value="css">CSS</option>
                                                            <option value="js">JS</option>
                                                            <option value="php">PHP</option>
                                                            <option value="python">Python</option>
                                                            <option value="termux">Termux</option>
                                                            <option value="hacking">Hacking</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- <label for="blogImage" class="form-control-user form-control">Upload Featured Image</label> -->
                                                        <input type="file" id="blogImage" name="blogImage"
                                                            class="form-control" />

                                                    </div>
                                                </div>


                                                <button name="publishArticle"
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

                <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
                <script>
        ClassicEditor
            .create( document.querySelector( '#blogeditor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
                <?php include "includes/jsfiles.php"; ?>


</body>

</html>