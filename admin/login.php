<?php  
include "includes/connection.php";
include "includes/functions.php";

if(checkLogin() == true){
    header('location: index.php');
    exit();
}

$email = $password = "";
//  /*--create session array for storing errors-start--*/
if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
    $_SESSION['errors'] = array();
  }


  if(isset($_POST['loginbtn'])){
    if(empty($_POST['email'])){
       array_push($_SESSION['errors'], 'Email is required');
    }else{
         $email = mysqli_real_escape_string($con, $_POST['email']);
    }

    if(empty($_POST['password'])){
       array_push($_SESSION['errors'], 'Password is required');
    }else{
        $password = md5($_POST['password']);
    }
    
    if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {

        $sql = "SELECT * FROM `tbl_users` WHERE `user_email` = '$email' AND `user_password` = '$password' AND `user_type` = 'A' ";
       
        $result = mysqli_query($con, $sql);
        if($result){
            if(mysqli_num_rows($result)>0){
                if($row = mysqli_fetch_assoc($result)){
                    
                    $_SESSION['userID'] = $row['user_id'];
                    $_SESSION['userFullName'] = $row['user_name'];
                    $_SESSION['userType'] = $row['user_type'];
                    $_SESSION['userEmail'] = $row['user_email'];
                    //All records are stored in session variales
                    // echo $_SESSION['userID'];
                    // echo $_SESSION['userFullName'];
                    // echo $_SESSION['userType'];
                    // echo $_SESSION['userEmail'];
            // array_push($_SESSION['errors'], "You have beed logged in");
           header('location: index.php');
           exit();
        }
    }else{
        array_push($_SESSION['errors'], "Email and Password is incorect");
    }
}
     
    }
  }


// //   /*--create session array for storing errors-end--*/

// $email = $password = "";
//     if (isset($_POST['loginBtn'])) {
//     header('location:index.php');


//     if(empty($_POST('email'))){
//         array_push($_SESSION('errors'), "Email is require");
//     }else{
//        $email =  mysqli_real_escape_string($_POST('email'));
//     }
//     if(empty($_POST('password'))){
//         array_push($_SESSION('password'), "Password is require");
//     }else{
//        $password = mysqli_real_escape_string($_POST('password'));
//     }

//     if (count($_SESSION['errors']) == 0 || !isset($_SESSION['errors'])) {

//         // $sql = "SELECT * FROM `blog_users` ";
//         // $result = mysqli_query($con, $sql);
//         // if($result){
//         //     if(mysqli_num_rows($result)==1){
//         //         if($row = mysqli_fetch_assoc($result)){
//         //             $email = $row['user_email'];
//         //             $password = $row['user_password'];
//         //             header('location:index.php');
//         //         }
//         //     }else{
//         //         array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials");
//         //     }
//         // }
        
//     }

// }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <?php 
             if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
                  $errors = $_SESSION['errors'];
                  foreach($errors as $error){
                    ?>
        <div class="alert alert-danger">
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
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    

                                    ?>
                                    <form class="user" action="login.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" name='loginbtn'
                                            class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>