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
                    <h1 class="h3 mb-4 text-gray-800">Contact Messages</h1>
                    <a href="messages.php">New Messages</a>
                    <hr>
                    <div class="container">
                        <?php
                        $sql = "SELECT * FROM `tbl_contact` WHERE `contact_status` = 'R' ORDER BY `contact_id` DESC  ";
                        $result = mysqli_query($con, $sql);
                        if(mysqli_num_rows($result)>0){
                            $srNo = 1;
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                        <div class="card mt-2 mb-4" >
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong> Name:</strong> <?php echo $row['contact_name']; ?></li>
                                <li class="list-group-item"><strong> Email:</strong> <?php echo $row['contact_email']; ?></li>
                                <li class="list-group-item"><strong> Subject:</strong> <?php echo $row['contact_subject']; ?></li>
                                <li class="list-group-item"><strong> Message:</strong> <?php echo $row['contact_message']; ?></li>
                                <li class="list-group-item"><strong> Date/Time:</strong> <?php echo timeago($row['contact_date']); ?></li>
                                <li class="list-group-item">
                                    <a href="deleteMessage.php?msgID=<?php echo $row['contact_id']; ?>" class="btn btn-danger">Delete</a>
                                </li>

                            </ul>
                        </div>

                        <?php
                                $srNo ++;

                            }
                        }else{
                            ?>
                            <div class="alert alert-info">Not Found</div>
                            <?php
                        }

                        ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include "includes/footer.php"; ?>


            <?php include "includes/jsfiles.php"; ?>


</body>

</html>