<?php include "includes/head.php"; ?>

<?php 

/*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
	$_SESSION['errors'] = array();
  }

$userName = $userEmail = $userStatus = $userType = $userID = "";

if(isset($_GET['userID']) && $_GET['userID'] != ""){
    $userID = $_GET['userID'];
    $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userID'";
    $result = mysqli_query($con,$sql);
    if($result){
        if(mysqli_num_rows($result) == 1){
            if($row = mysqli_fetch_array($result)){
                $userName = $row['user_name'];
                $userEmail = $row['user_email'];
                $userStatus = $row['user_status'];
                $userType = $row['user_type'];
            }
    
        }else{
         $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
          header("location:viewAllUsers.php");
          exit();
        }
      }
    }else{
      $_SESSION['errorMessage'] = "Something Going Wrong Please Try later.";
      header("location:viewAllUsers.php");
      exit();
}

if(isset($_POST['updateUser'])){

    if(empty($_POST['userName'])){
        array_push($_SESSION['errors'], "Name is required");
    }else{
        $userName = mysqli_real_escape_string($con, $_POST['userName']);
    }

    if(empty($_POST['userEmail'])){
        array_push($_SESSION['errors'], "Email is required");
    }else{
        $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
    }

    if(empty($_POST['userType'])){
        array_push($_SESSION['errors'], "Type is required");
    }else{
        $userType = mysqli_real_escape_string($con, $_POST['userType']);
    }

    if(empty($_POST['userStatus'])){
        array_push($_SESSION['errors'], "Status is required");
    }else{
        $userStatus = mysqli_real_escape_string($con, $_POST['userStatus']);
    }

        if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {
           $sql = "UPDATE `tbl_users` SET `user_name` = '$userName', `user_email` = '$userEmail',`user_type` = '$userType', `user_status` = '$userStatus' WHERE `user_id` = '$userID'";
             $result = mysqli_query($con,$sql);

            if($result){
                $_SESSION["successMessage"] = "User has been Updated";
                header("location:viewAllUsers.php");
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
                                            <form method="POST" action="editUser.php?userID=<?php echo $userID; ?>">
                                                <div class="form-group row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="userName" name="userName"
                                                            placeholder="Enter User Name" value="<?php echo $userName; ?>">
                                                    </div>
                                                    <div class="col-md-12 mb-4">
                                                    <input type="text" class="form-control form-control-user"
                                                            id="userEmail" name="userEmail"
                                                            placeholder="Enter User Email" value="<?php echo $userEmail; ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                    <select name="userType" id="userType" class="form-control">
                                                        <option value="">Select User Type</option>
                                                        <option  <?php if($userType == "A"){echo "selected";} ?> value="A">Admin</option>
                                                        <option <?php if($userType == "U"){echo "selected";} ?> value="U">User</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="userStatus" class="form-control" id="userStatus">
                                                            <option value="">Select Status</option>
                                                            <option <?php if($userStatus == "A"){echo "selected";} ?> value="A">Active</option>
                                                            <option <?php if($userStatus == "P"){echo "selected";} ?> value="P">Pending</option>
                                                            <option <?php if($userStatus == "B"){echo "selected";} ?> value="B">Block</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                                                            
                                                <button name="updateUser"
                                                    class="btn btn-primary btn-user btn-block">
                                                    Update
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