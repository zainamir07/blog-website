<?php include "includes/head.php"; ?>

<?php

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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Comments</h1>
                    <a href="pendingComments.php">Pending Comments</a>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            
                             // $clubID = $_SESSION['uID'];
                                 $sql = "SELECT * FROM `tbl_comments` WHERE `com_status` = 'A' ORDER BY `com_id` DESC";
                                 $result = mysqli_query($con,$sql);
                                 if($result){
                                    if (mysqli_num_rows($result)>0) {
                                       $srno =1;
                                       while($row = mysqli_fetch_array($result)){
                                          ?>
                                <tr>
                                    <td><?php echo $srno; ?> <br><?php echo timeago($row['com_createdDate']); ?></td>
                                    <td><?php echo $row['com_name'] ?></td>
                                    <td><?php echo $row['com_email']; ?></td>
                                    <td><?php echo $row['com_subject']; ?></td>
                                    <td style="white-space: break-spaces; text-overflow: clip; max-width: 200px;"><?php echo $row['com_message']; ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="../blog.php?blogID=<?php echo $row['com_blogID'];?>&comment=#<?php echo $row['com_id']; ?>">View</a>
                                        <form action="comments.php" method="post">
                                            <a href="actionComments.php?comID=<?php echo $row['com_id']; ?>" class="btn btn-danger" >Delete</a>
                                        </form>
                                        
                                    </td>
                                </tr>
                                <?php
                                          $srno++;
                                       }
                                    }else{
                                       ?>
                                <div class="alert alert-info">No Users Found</div>
                                <?php
                                    }
                                 }
                              ?>

                            </tbody>
                        </table>
                    </div>
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