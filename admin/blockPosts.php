<?php include "includes/head.php"; ?>
<style>
.blogTitle {
    overflow: hidden;
    text-overflow: ellipsis;
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
                    <div class="container">
                        
                    <div class="row d-flex justify-content-between align-iten-center">
                        <h1 class="h3 mb-4 text-gray-800">View All Blogs</h1>
                     <div>
                        <a href="viewAllBlogs.php" class="btn btn-sm btn-outline-info">Active Posts</a>
                        <a href="PendingPosts.php" class="btn btn-sm btn-outline-secondary">Pending Posts</a>
                        </div>
                    </div>
                    </div>


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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr no</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Posted By</th>
                                    <th>View Blog</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `tbl_blogs` WHERE `blog_status` = 'B' ORDER BY `blog_id` DESC ";
                                    $result = mysqli_query($con, $sql);
                                      if($result){
                                        if(mysqli_num_rows($result)>0){
                                            $srno = 1;
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                <tr>
                                    <td><?php echo $srno;  ?></td>
                                    <td><?php echo 'Image';  ?></td>
                                    <td class="blogTitle"><?php echo $row['blog_title'];  ?></td>
                                    <td><?php echo getCategory($row['blog_category']);  ?></td>
                                    <td><?php echo getStatusTitle($row['blog_status']);  ?></td>
                                   
                                    <td><?php echo $row['blog_postedBy'];  ?></td>
                                    <td><a href="blogDetails.php?blogID=<?php echo $row['blog_id']; ?>"
                                            class="btn btn-sm btn-info">Blog Details</a></td>
                                    <td>
                                        <a href="editBlog.php?blogID=<?php echo $row['blog_id'];?>"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="deleteBlog.php?blogID=<?php echo $row['blog_id'];?>"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                $srno++;
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


                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include "includes/footer.php"; ?>


            <?php include "includes/jsfiles.php"; ?>


</body>

</html>