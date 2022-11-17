<?php include "includes/head.php"; ?>
<style>
.blogTitle {
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<?php  

if(isset($_GET['blogID']) && $_GET['blogID'] !== ""){
    $blogID = $_GET['blogID'];
}

if(isset($_POST['publishArticle'])){
    // $publishArticle = $_POST['publishArticle'];
    $sql = "UPDATE `tbl_blogs` SET `blog_status` = 'A' ";
    $result = mysqli_query($con,$sql);

    if($result){
        $_SESSION["successMessage"] = "Article has been Published";
        header("location:viewAllBlogs.php");
        exit();
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
                    <h1 class="h3 mb-4 text-gray-800">Blog Details</h1>
                    <div class="container">
                        <?php if(isset($_SESSION['successMessage'])){
                ?>
                        <div class="m-2">
                            <div class="alert alert-success text-white">
                                <?php echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); ?>
                            </div>
                        </div>
                        <?php
            } ?>
                        <?php if(isset($_SESSION['errorMessage'])){
                ?>
                        <div class="m-2">
                            <div class="alert alert-danger text-white">
                                <?php echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); ?>
                            </div>
                        </div>
                        <?php
            } ?>
                       
                       <div class="container bg-light shadow rounded p-4">
                    
                                <?php 
                                    $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_id` = '$blogID' ORDER BY `blog_id` DESC ";
                                    $result = mysqli_query($con, $sql);
                                    if($result){
                                        if(mysqli_num_rows($result)>0){
                                            // $srno = 1;
                                            if($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <p><?php echo timeago($row['blog_createddate']);?> <span> Posted By:<?php echo $row['blog_postedBy']; ?></span></p>
                                                <img class=" mb-4 mt-4img-fluid" style="max-height: 300px; max-width: 700px;" src="<?php echo $row['blog_image']; ?>" alt="">
                                        <h2><?php echo $row['blog_title']; ?></h2>
                                        <p><?php echo $row['blog_description']; ?></p>
                                        <p><strong>Tags: </strong><?php echo $row['blog_tags']; ?></p>
                                        <p><strong>Category: </strong><?php echo getCategory($row['blog_category']); ?></p>
                                        <p><strong>Status: </strong><?php echo getStatusTitle($row['blog_status']); ?></p>
                                        <br>
                                        <?php if($row['blog_status'] == "P"){
                                            ?>
                                            <form action="blogDetails.php?blogID=<?php echo $blogID; ?>" method="post">
                                            <button type="submit" name="publishArticle" class="btn btn-outline-success mt-2 mb-4">Publish</button>
                                            </form>
                                            <?php
                                        } ?>
                                        
                                        <a href="editBlog.php?blogID=<?php echo $blogID;?>"  class="btn btn-primary">Edit</a>
                                        <a href="deleteBlog.php?blogID=<?php echo $blogID;?>"
                                            class="btn btn-danger">Delete</a>
                                <?php
                                // $srno++;
                                }
                                }else{
                                ?>
                                <div class="alert alert-info">
                                    No Blog(s) Found
                                </div>
                                <?php
                                            }
                                        }
                                     
                                    ?>


                     
                    </div>
                </div>
                <!-- /.container-fluid -->
    
                </div>
            </div>
            <!-- End of Main Content -->

            <?php include "includes/footer.php"; ?>


            <?php include "includes/jsfiles.php"; ?>


</body>

</html>