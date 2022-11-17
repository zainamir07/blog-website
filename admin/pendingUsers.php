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
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
                    <a href="viewAllUsers.php">Active Users</a>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            
                             // $clubID = $_SESSION['uID'];
                                 $sql = "SELECT * FROM `tbl_users` WHERE (`user_status` = 'P' OR `user_status` = 'B' )  ORDER BY `user_id` DESC";
                                 $result = mysqli_query($con,$sql);
                                 if($result){
                                    if (mysqli_num_rows($result)>0) {
                                       $srno =1;
                                       while($row = mysqli_fetch_array($result)){
                                          ?>
                                <tr>
                                    <td><?php echo $srno; ?></td>
                                    <td><?php echo $row['user_name'] ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo getUserTypeTitle($row['user_type']); ?></td>
                                    <td><?php echo getStatusTitle($row['user_status']); ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="editUser.php?userID=<?php echo $row['user_id'];?>">Edit</a>
                                        <a class="btn btn-danger" href="editUser.php?userID=<?php echo $row['user_id'];?>">Delete</a>
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