<?php

include('include/connection.php');
include('include/constant.php');
$conn = new dbConnection;
include('include/session.php');
$controls = 'active';
$controlBoolean = 'true';
$menuShow = 'show';
$category = 'active';

$id = $_REQUEST['id'];

$query = "SELECT * FROM personal WHERE id='$id'";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    $PersonalDetailTable = $result->fetch_assoc();
}

if (isset($_POST['add'])) {
    $emp_first = $_POST['emp_first'];
    $emp_last = $_POST['emp_last'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $blood_group = $_POST['blood_group'];
    $phone_number = $_POST['phone_number'];
    $emgerency_contact_no = $_POST['emgerency_contact_no'];
    $address = $_POST['address'];
    $permanent_address = $_POST['permanent_address'];

    $panImage = $_FILES['panImage']['name'];
    $aadharImage = $_FILES['aadharImage']['name'];
    $passportImage = $_FILES['passportImage']['name'];

    $query2 = "UPDATE personal SET emp_first='$emp_first',emp_last='$emp_last',father_name='$father_name',mother_name='$mother_name',DOB='$DOB',
        blood_group='$blood_group',phone_number='$phone_number',emgerency_contact_no='$emgerency_contact_no',gender='$gender',experience='$experience',
        address='$address',permanent_address='$permanent_address' WHERE id='$id'";
    $sql2 = $conn->query($query2)->execute();
    if ($sql2['status']) {
        if ($panImage) {
            $extension = pathinfo($panImage, PATHINFO_EXTENSION);
            $imageName = "upload/pan/" . $id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["panImage"]["tmp_name"], $imageName)) {
                    $query3 = "UPDATE personal SET pan='$imageName' WHERE id = '$id'";
                    $conn->query($query3)->execute();
                }
            }
        }
        if ($aadharImage) {
            $extension = pathinfo($aadharImage, PATHINFO_EXTENSION);
            $imageName = "upload/aadhar/" . $id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["aadharImage"]["tmp_name"], $imageName)) {
                    $query3 = "UPDATE personal SET aadhar='$imageName' WHERE id = '$id'";
                    $conn->query($query3)->execute();
                }
            }
        }
        if ($passportImage) {
            $extension = pathinfo($passportImage, PATHINFO_EXTENSION);
            $imageName = "upload/passport/" . $id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["passportImage"]["tmp_name"], $imageName)) {
                    $query3 = "UPDATE personal SET passport='$imageName' WHERE id = '$id'";
                    $conn->query($query3)->execute();
                }
            }
        }
        header("Location: all-detail.php?msg=Category Updated");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Add New Member | Rotary </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg" />
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
    <?php include('include/header.php') ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include('include/sidebar.php') ?>
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
                                            <!--  Member Register -->
                                            <h6>Edit Detail</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input class="form-control mb-3" type="name" name="emp_first" value="<?php echo $PersonalDetailTable['emp_first']; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="emp_last" class="form-control mb-3" value="<?php echo $PersonalDetailTable['emp_last'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <input class="form-control mb-3" type="name" name="father_name" value="<?php echo $PersonalDetailTable['father_name'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="mother_name" class="form-control mb-3" value="<?php echo $PersonalDetailTable['mother_name'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <input type="date" name="DOB" id="DOB" class="form-control mb-3" value="<?php echo $PersonalDetailTable['DOB'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="blood_group" id="blood_group" class="form-control mb-3" value="<?php echo $PersonalDetailTable['blood_group'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <input type="number" name="phone_number" id="phone_number" class="form-control mb-3" value="<?php echo $PersonalDetailTable['phone_number'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="emgerency_contact_no" id="emgerency_contact_no" class="form-control mb-3" value="<?php echo $PersonalDetailTable['emgerency_contact_no'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6 mb-3">
                                                                        <select name="gender" id="gender" class="form-control">
                                                                            <?php
                                                                            $Male = $Female = "";
                                                                            switch ($PersonalDetailTable['gender']) {
                                                                                case 'Male':
                                                                                    $Male = 'selected';
                                                                                    break;
                                                                                case 'Female':
                                                                                    $Female = 'selected';
                                                                                    break;
                                                                            }
                                                                            ?>
                                                                            <option value="Male" <?php echo $Male; ?>>Male</option>
                                                                            <option value="Female" <?php echo $Female; ?>>Female</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <input type="text" name="experience" id="experience" class="form-control mb-3" value="<?php echo $PersonalDetailTable['experience'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <br><input cols="30" rows="5" name="address" class="form-control mb-3" value="<?php echo $PersonalDetailTable['address'] ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <br><input cols="30" rows="5" name="permanent_address" class="form-control mb-3" value="<?php echo $PersonalDetailTable['permanent_address'] ?>">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <img src="<?php echo $PersonalDetailTable['pan']; ?>" width="50" height="50">
                                                                        <br>
                                                                        <input type="file" id="input-file" name="panImage" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <img src="<?php echo $PersonalDetailTable['aadhar']; ?>" width="50" height="50">
                                                                        <br>
                                                                        <input type="file" id="input-file" name="aadharImage" class="form-control">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <img src="<?php echo $PersonalDetailTable['passport']; ?>" width="50" height="50">
                                                                        <br>
                                                                        <input type="file" id="input-file" name="passportImage" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                                                                    </div>

                                                                </div>
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
                </div><br>

            </div>
        </div>
    </div>
    </div>
    <?php
    include('include/footer.php')
    ?>
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
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="assets/js/manual.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/notification/snackbar/snackbar.min.js"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>