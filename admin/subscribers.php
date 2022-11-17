<?php include "includes/head.php"; ?>
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
                        <a href="addNewBlog.php" class="btn btn-sm btn-outline-info">Add New Blog</a>
                        <a href="pendingPosts.php" class="btn btn-sm btn-outline-info">Pending Posts</a>
                        <a href="blockPosts.php" class="btn btn-sm btn-outline-secondary">Block Posts</a>
                        </div>
                    </div>
                    </div>


                    <div class="container">
                        <?php if(isset($_SESSION['successMessage'])){
                ?>
                        <div class="m-2">
                            <div class="alert alert-success">
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
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `tbl_newsletter` ORDER BY `newsletter_id` DESC ";
                                    $result = mysqli_query($con, $sql);
                                      if($result){
                                        if(mysqli_num_rows($result)>0){
                                            $srno = 1;
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                <tr>
                                    <td><?php echo $srno;  ?></td>                                    
                                    <td><?php echo $row['newsletter_email'];  ?></td>
                                    <form action="subscribers.php" method="post">
                                    <td><a class="btn btn-danger" name="deletesubscriber" href="deleteUser.php?subID=<?php echo $row['newsletter_id'] ?>">Delete</a></td>
                                    </form>
                                    
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