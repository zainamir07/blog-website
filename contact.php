<?php include "includes/head.php"; ?>

<?php

if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){
  $_SESSION['errors'] = array();
}

$name = $email = $password = $subject = $message = $createdDate = $status = "";

if(isset($_POST['contactBtn'])){

  if (empty($_POST['name'])) {
    array_push($_SESSION['errors'], "Name is required");
  }else{
    $name = mysqli_real_escape_string($con, $_POST['name']);
  }
  if (empty($_POST['email'])) {
    array_push($_SESSION['errors'], "Email is required");
  }else{
    $email = mysqli_real_escape_string($con, $_POST['email']);
  }
  $subject =  mysqli_real_escape_string($con, $_POST['subject']);

  if (empty($_POST['message'])) {
    array_push($_SESSION['errors'], "Message is required");
  }else{
    $message = mysqli_real_escape_string($con, $_POST['message']);
  }

  if(!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0){

    $status = "NR";
    $createdDate = date("Y-m-d H:i:s");
    $sql = "INSERT INTO `tbl_contact` (`contact_name`,`contact_email`, `contact_subject`, `contact_message`, `contact_date`, `contact_status`) VALUES('$name', '$email', '$subject', '$message', '$createdDate', '$status')";
    $result = mysqli_query($con,$sql);
    if ($result) {
      $_SESSION['successMessage'] = "Message has been sent successfully.";
      header("location:contact.php");
      exit();
    }

  }
}

?>

<body>
  <!--================Header Menu Area =================-->
<?php include "includes/header.php"; ?>
 <!--================Header Menu Area =================-->
 <!-- ================ contact section start ================= -->
  <section class="section-margin">
    <div class="container">
      <h2 class="mb-5">Contact US</h2>
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

      <div class="row">
    
        <div class="col-md-8 col-lg-9 ">
          <form action="contact.php" class="form-contact contact_form" method="POST" id="contactForm">
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button  name="contactBtn" type="submit" class="button button--active button-contactForm">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

  


  <!--================ Start Footer Area =================-->
<?php include "includes/footer.php"; ?>
  <!--================ End Footer Area =================-->

  <?php include "includes/jsfiles.php"; ?>

</body>
</html>