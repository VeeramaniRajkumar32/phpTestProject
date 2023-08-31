<?php 
    ini_set('display_errors', 'off');
    include('include/connection.php');
    include('include/constant.php');
    
    $conn = new dbConnection;
    include('include/session.php');
    $app = 'active';
    $appBoolean = 'true';

    $query = "SELECT * FROM app_control";
    $sql = $conn->query($query)->execute();
    if($sql['status']){
        $result = $sql['body'];
        $controlTable = $result->fetch_assoc();
    }

    $contact_number= $controlTable['contact_us'];
    $customer_num= $controlTable['customer_number'];

    $contactNumber = substr($contact_number,"3");
    $customerNumber = substr($customer_num,"3");

if(isset($_POST['submit'])){
    $privacy = $_POST['privacy'];
    $terms = $_POST['terms'];
    $about_us = $_POST['about_us'];
    $contact_us = '+91'.$_POST['contact_us'];
    $customer_number = '+91'.$_POST['customer_number'];
    $key = $_POST['key'];
    $secret = $_POST['secret'];
    $email=$_POST['email'];
    $about_rotary = $_POST['about_rotary'];
   

    $query = "UPDATE app_control SET privacy_policy='$privacy',terms_contitions='$terms',about_us='$about_us',contact_us='$contact_us',customer_number='$customer_number',razorpay_key='$key',razorpay_secret='$secret',about_rotary='$about_rotary',email='$email'";
    $sql = $conn->query($query)->execute();
    if($sql['status']){
        header("location: app_control.php");
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>App Controls | Rotary  </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/editors/quill/quill.snow.css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body class="sidebar-noneoverflow">
    
    <!--  BEGIN NAVBAR  -->
    <?php include('include/header.php')?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include('include/sidebar.php')?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">
                
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="general-info" method="POST" class="section general-info" enctype="multipart/form-data">
                                        <div class="info">
                                            <h6 class=""> App Controls</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Privacy policy</label>
                                                                            <input type="text" class="form-control mb-4" name="privacy" id="title" placeholder="Privacy policy" required value="<?php echo $controlTable['privacy_policy'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label>Terms & Conditions</label>
                                                                        <input type="text" id="date" name="terms" class="form-control mb-4" placeholder="Terms & Conditions" required value="<?php echo $controlTable['terms_contitions'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label >About Us</label>
                                                                        <input type="text" id="input-file" name="about_us" class="form-control mb-4" placeholder="About Us"  required value="<?php echo $controlTable['about_us'] ?>" >
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                            <label for="email">Email</label>
                                                                            <input type="email" name="email" class="form-control mb-4" id="email" placeholder="Email" required value="<?php echo $controlTable['email'] ?>">
                                                                    </div>  
                                                                    <div class="col-md-6">
                                                                        <label >Contact Us</label>
                                                                        <input type="tel" pattern= "(0/91)?[7-9][0-9]{9}" name="contact_us" class="form-control mb-4" placeholder="Contact Us" oninvalid="this.setCustomValidity('Invalid Phone Number')" oninput="this.setCustomValidity('')" required value="<?php echo $contactNumber; ?>" >
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label >Customer Support Number</label>
                                                                        <input type="tel" pattern= "(0/91)?[7-9][0-9]{9}" name="customer_number" class="form-control mb-4" oninvalid="this.setCustomValidity('Invalid Phone Number')" oninput="this.setCustomValidity('')" placeholder="Phone Number"  required value="<?php echo $customerNumber; ?>" >
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Razorpay Key</label>
                                                                            <input type="text" class="form-control mb-4" name="key" id="title" placeholder="Razorpay Key" required value="<?php echo $controlTable['razorpay_key'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label >Razorpay Secret</label>
                                                                        <input type="text" id="date" name="secret" class="form-control mb-4" placeholder="Razorpay Secret" required value="<?php echo $controlTable['razorpay_secret'] ?>">
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="address">About Rotary Club</label>
                                                                            <textarea class="form-control" name="about_rotary" id="description" placeholder="About Rotary Club" rows="3"><?php echo $controlTable['about_rotary'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-10"></div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                        <div class="blockui-growl-message">
                                                                            <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                                                                        </div>
                                                                            <input type="submit" id="multiple-messages" name="submit" class="btn btn-success" value="Update">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!--  END CONTENT AREA  -->

            </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function() {
            App.init();
        });

    </script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/manual.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>
</html>