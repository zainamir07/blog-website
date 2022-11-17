<?php include "includes/head.php"; ?>
<?php

/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }
 $blogID = $blogStatus = $blogCreatedDate = $blogCategory = "";

 if(isset($_POST['addCate'])){
    if(empty($_POST['blogCategory'])){
        array_push($_SESSION['errors'], "Blog Category is require");
    }else{
        $blogCategory = mysqli_real_escape_string($con, $_POST['blogCategory']);
    }

    if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
        $cateStatus = "A";
        $cateCreatedDate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `tbl_category` (`cate_name`,`cate_status`, `cate_createdDate`) VALUES('$blogCategory', '$cateStatus', '$cateCreatedDate')";

        $result = mysqli_query($con,$sql);

        if($result){
            $_SESSION["successMessage"] = "Category has been added";
            header("location:categories.php");
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
<h1 class="h3 mb-4 text-gray-800">Add New Category</h1>
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
                        <form method="POST" action="addNewcategory.php" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-md-12 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        id="blogCategory" name="blogCategory"
                                        placeholder="Write a Category Name">
                                </div>
                            </div>
                            
                            <button name="addCate"
                                class="btn btn-primary btn-user btn-block">
                                Add Category
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

            </div>
            <!-- End of Main Content -->

            <?php include "includes/footer.php"; ?>


    <?php include "includes/jsfiles.php"; ?>


</body>

</html>