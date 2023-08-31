<?php
ini_set('display_errors', 'off');
include('include/connection.php');
include('include/constant.php');

$conn = new dbConnection;
include('include/session.php');
$controls = 'active';
$controlBoolean = 'true';
$menuShow = 'show';
$employee = 'active';


if (isset($_POST['add'])) {
    $user_name = $_POST['user_name'];
    $user_doj = $_POST['user_doj'];
    $employee_id = $_POST['employee_id'];
    $user_phone_number = $_POST['user_phone_number'];
    $office_email = $_POST['office_email'];
    $user_email = $_POST['user_email'];
    $position = $_POST['position'];
    $department = $_POST['department'];

    $photoImage = $_FILES['photoImage']['name'];
    $offerImage = $_FILES['offerImage']['name'];
    $appoinmentImage = $_FILES['appoinmentImage']['name'];

    $query = "INSERT INTO user (user_name, user_doj, employee_id, user_phone_number, office_email, user_email, position, department) 
    VALUES ('$user_name','$user_doj','$employee_id', '$user_phone_number','$office_email','$user_email','$position', '$department')";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $query1 = "SELECT * FROM user ORDER BY user_id DESC LIMIT 1";
        $sql1 = $conn->query($query1)->execute();
        if ($sql1['status']) {
            $result1 = $sql1['body'];
            $memberTable = $result1->fetch_assoc();

            $received_id = $memberTable['user_id'];

            $resumetype = pathinfo($photoImage, PATHINFO_EXTENSION);
            $resumename = "upload/photo/" . $received_id . "." . $resumetype;
            $allowTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($resumetype, $allowTypes)) {
                if (move_uploaded_file($_FILES["photoImage"]["tmp_name"], $resumename)) {
                    $query2 = "UPDATE user SET photoImage = '$resumename' WHERE user_id = '$received_id'";
                    $sql2 = $conn->query($query2)->execute();
                    if ($sql2['status']) {
                        header('Location: employee.php?msg=Employee added!');
                    }
                }
            }
            $resumetype = pathinfo($offerImage, PATHINFO_EXTENSION);
            $resumename = "upload/offer/" . $received_id . "." . $resumetype;
            $allowTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($resumetype, $allowTypes)) {
                if (move_uploaded_file($_FILES["offerImage"]["tmp_name"], $resumename)) {
                    $query2 = "UPDATE user SET offerImage = '$resumename' WHERE user_id = '$received_id'";
                    $sql2 = $conn->query($query2)->execute();
                    if ($sql2['status']) {
                        header('Location: employee.php?msg=Employee added!');
                    }
                }
            }
            $resumetype = pathinfo($appoinmentImage, PATHINFO_EXTENSION);
            $resumename = "upload/app/" . $received_id . "." . $resumetype;
            $allowTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($resumetype, $allowTypes)) {
                if (move_uploaded_file($_FILES["appoinmentImage"]["tmp_name"], $resumename)) {
                    $query2 = "UPDATE user SET appoinmentImage = '$resumename' WHERE user_id = '$received_id'";
                    $sql2 = $conn->query($query2)->execute();
                    if ($sql2['status']) {
                        header('Location: employee.php?msg=Employee added!');
                    }
                }
            }
        }
    }
}

if (isset($_POST['edit'])) {
    $user_id = $_POST['user_id'];

    $user_name = $_POST['user_name'];
    $user_doj = $_POST['user_doj'];
    $employee_id = $_POST['employee_id'];
    $user_phone_number = $_POST['user_phone_number'];
    $office_email = $_POST['office_email'];
    $user_email = $_POST['user_email'];
    $position = $_POST['position'];
    $department     = $_POST['department'];

    $photoImage = $_FILES['photoImage']['name'];
    $offerImage = $_FILES['offerImage']['name'];
    $appoinmentImage = $_FILES['appoinmentImage']['name'];

    $query3 = "UPDATE user SET user_name='$user_name', user_doj='$user_doj', employee_id='$employee_id',
    user_phone_number='$user_phone_number', office_email='$office_email', user_email='$user_email', position='$position',department='$department'
     WHERE user_id='$user_id'";
    $sql3 = $conn->query($query3)->execute();
    if ($sql3['status']) {
        if ($photoImage) {
            $extension = pathinfo($photoImage, PATHINFO_EXTENSION);
            $imageName = "upload/photo/" . $user_id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["photoImage"]["tmp_name"], $imageName)) {
                    $query4 = "UPDATE personal SET photoImage='$imageName' WHERE user_id = '$user_id'";
                    $conn->query($query4)->execute();
                }
            }
        }
        if ($offerImage) {
            $extension = pathinfo($offerImage, PATHINFO_EXTENSION);
            $imageName = "upload/offer/" . $user_id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["offerImage"]["tmp_name"], $imageName)) {
                    $query4 = "UPDATE personal SET offerImage='$imageName' WHERE user_id = '$user_id'";
                    $conn->query($query4)->execute();
                }
            }
        }
        if ($appoinmentImage) {
            $extension = pathinfo($appoinmentImage, PATHINFO_EXTENSION);
            $imageName = "upload/app/" . $user_id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["appoinmentImage"]["tmp_name"], $imageName)) {
                    $query4 = "UPDATE personal SET appoinmentImage='$imageName' WHERE user_id = '$user_id'";
                    $conn->query($query4)->execute();
                }
            }
        }
        header('Location: employee.php?msg=Employee Record Updated!');
    }
}


if (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    $query = "DELETE FROM user WHERE user_id='$user_id'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        header('Location: employee.php?msg=Employee Record Deleted!');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>All Employees</title>
    <link rel="icon" type="image/x-icon" href="assets/img/attendance.png" />
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/avatar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link href="plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">



</head>

<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php include('include/header.php') ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include('include/sidebar.php') ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">

                    <div class="col-sm-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4>Employee Details</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-outline-primary float-right m-3" data-toggle="modal" data-target="#exampleModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add New
                                        </button>
                                        <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: none;" aria-modal="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addAdminTitle">Add Employee</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="user_name" id="user_name" class="form-control mb-3" placeholder="Employee Name" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="date" name="user_doj" id="user_doj" class="form-control mb-3" placeholder="Employee Date of Joining" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" name="employee_id" id="employee_id" class="form-control mb-3" placeholder="Employee Id" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" name="user_phone_number" id="user_phone_number" class="form-control mb-3" placeholder="Whatsapp Number" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="email" name="office_email" id="office_email" class="form-control mb-3" placeholder="Office Email Id" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="email" name="user_email" id="user_email" class="form-control mb-3" placeholder="Email Id" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <select type="text" name="position" id="position" class="form-control mb-3" placeholder="Position" autocomplete="off" required>
                                                                        <option value="" selected value disabled>Select Position</option>
                                                                        <?php
                                                                        $query1 = "SELECT * FROM position";
                                                                        $sql1 = $conn->query($query1)->execute();
                                                                        if ($sql['status']) {
                                                                            $result1 = $sql1['body'];
                                                                            while ($positionTable = $result1->fetch_assoc()) {
                                                                                $select = " ";
                                                                                $mycat = '';
                                                                                if ($mycat ==  $positionTable['position_id']) {
                                                                                    $select = "selected";
                                                                                }
                                                                        ?>
                                                                                <option value="<?php echo $positionTable['position_id']; ?>" <?php echo $select; ?>><?php echo $positionTable['position_name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <select type="text" name="department" id="department" class="form-control mb-3" placeholder="Team Name" autocomplete="off" required>
                                                                        <option value="" selected value disabled>Select Team Name</option>
                                                                        <?php
                                                                        $query2 = "SELECT * FROM department";
                                                                        $sql2 = $conn->query($query2)->execute();
                                                                        if ($sql['status']) {
                                                                            $result2 = $sql2['body'];
                                                                            while ($departmentTable = $result2->fetch_assoc()) {
                                                                                $select1 = " ";
                                                                                $mycat1 = '';
                                                                                if ($mycat1 ==  $departmentTable['department_id']) {
                                                                                    $select1 = "selected";
                                                                                }
                                                                        ?>
                                                                                <option value="<?php echo $departmentTable['department_id']; ?>" <?php echo $select1; ?>><?php echo $departmentTable['department_name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label>Photo</label>
                                                                    <input type="file" id="photoImage" name="photoImage" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label>Offer Letter Copy</label>
                                                                    <input type="file" id="offerImage" name="offerImage" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <br><label>Appoinment Letter Copy</label>
                                                                    <br><input type="file" id="appoinmentImage" name="appoinmentImage" class="form-control" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="add" name="add" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table mb-4" id="zero-config">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">Employee Id</th>
                                                <th class="text-center">Employee Date of Joining</th>
                                                <th class="text-center">Employee Whatsapp Number</th>
                                                <th class="text-center">Office Email Id</th>
                                                <th class="text-center">Email Id</th>
                                                <th class="text-center">Position</th>
                                                <th class="text-center">Department</th>
                                                <th class="text-center">Photo</th>
                                                <th class="text-center">Offer Copy</th>
                                                <th class="text-center">Appoinment Copy</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM user";
                                            $sql = $conn->query($query)->execute();
                                            if ($sql['status']) {
                                                $result = $sql['body'];
                                                $count = 1;
                                                while ($userTable = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $count++; ?></td>
                                                        <td class="text-center"><?php echo $userTable["user_name"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["employee_id"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["user_doj"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["user_phone_number"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["office_email"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["user_email"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["position"]; ?></td>
                                                        <td class="text-center"><?php echo $userTable["department"]; ?></td>
                                                        <td class="text-center"><img src="<?php echo $userTable['photoImage']; ?>" width="100px" height="100" /></td>
                                                        <td class="text-center"><img src="<?php echo $userTable['offerImage']; ?>" width="100px" height="100" /></td>
                                                        <td class="text-center"><img src="<?php echo $userTable['appoinmentImage']; ?>" width="100px" height="100" /></td>
                                                        <td class="text-center">
                                                            <ul class="table-controls">
                                                                <li>
                                                                    <a data-toggle="modal" data-target="#edit<?php echo $count ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                                                            <path d="M12 20h9"></path>
                                                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                                                        </svg>
                                                                    </a>
                                                                    <div class="modal fade" id="edit<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="addAdminTitle<?php echo $count ?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <form method="post" enctype="multipart/form-data">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="addAdminTitle<?php echo $count ?>">Edit Employee Record</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <input type="text" name="user_name" id="user_name" class="form-control mb-3" placeholder="Employee Name" value="<?php echo $userTable['user_name']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text" name="employee_id" id="employee_id" class="form-control mb-3" placeholder="Employee id" value="<?php echo $userTable['employee_id']; ?>">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <input type="date" name="user_doj" id="user_doj" class="form-control mb-3" placeholder="Employee Date of Joining" value="<?php echo $userTable['user_doj']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text" name="user_phone_number" id="user_phone_number" class="form-control mb-3" placeholder="Whatsapp Number" value="<?php echo $userTable['user_phone_number']; ?>">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <input type="email" name="office_email" id="office_email" class="form-control mb-3" placeholder="Office Email Id" value="<?php echo $userTable['office_email']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <input type="email" name="user_email" id="user_email" class="form-control mb-3" placeholder="Email Id" value="<?php echo $userTable['user_email']; ?>">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <select type="text" name="position" id="position" class="form-control mb-3" placeholder="Position" autocomplete="off" required>
                                                                                                    <option value="" selected value disabled>Select Position</option>
                                                                                                    <?php
                                                                                                    $query1 = "SELECT * FROM position";
                                                                                                    $sql1 = $conn->query($query1)->execute();
                                                                                                    if ($sql['status']) {
                                                                                                        $result1 = $sql1['body'];
                                                                                                        while ($positionTable = $result1->fetch_assoc()) {
                                                                                                            $select = " ";
                                                                                                            if ($userTable['position'] ==  $positionTable['position_id']) {
                                                                                                                $select = "selected";
                                                                                                            }
                                                                                                    ?>
                                                                                                            <option value="<?php echo $positionTable['position_id']; ?>" <?php echo $select; ?>><?php echo $positionTable['position_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <select type="text" name="department" id="department" class="form-control mb-3" placeholder="Team Name" autocomplete="off" required>
                                                                                                    <option value="" selected value disabled>Select Team Name</option>
                                                                                                    <?php
                                                                                                    $query2 = "SELECT * FROM department";
                                                                                                    $sql2 = $conn->query($query2)->execute();
                                                                                                    if ($sql['status']) {
                                                                                                        $result2 = $sql2['body'];
                                                                                                        while ($departmentTable = $result2->fetch_assoc()) {
                                                                                                            $select1 = " ";
                                                                                                            if ($userTable['department'] ==  $departmentTable['department_id']) {
                                                                                                                $select1 = "selected";
                                                                                                            }
                                                                                                    ?>
                                                                                                            <option value="<?php echo $departmentTable['department_id']; ?>" <?php echo $select1; ?>><?php echo $departmentTable['department_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <label>Photo</label>
                                                                                                <img src="<?php echo $userTable['photoImage']; ?>" width="50" height="50">
                                                                                                <br>
                                                                                                <input type="file" id="input-file" name="photoImage" class="form-control">
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                                <label>Offer Copy</label>
                                                                                                <img src="<?php echo $userTable['offerImage']; ?>" width="50" height="50">
                                                                                                <br>
                                                                                                <input type="file" id="input-file" name="offerImage" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <label>Appoinment Copy</label>
                                                                                                <img src="<?php echo $userTable['appoinmentImage']; ?>" width="50" height="50">
                                                                                                <br>
                                                                                                <input type="file" id="input-file" name="appoinmentImage" class="form-control">
                                                                                            </div>

                                                                                            <div class="col-md-6">
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" name="user_id" value="<?php echo $userTable["user_id"] ?>">
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                                                        <button type="submit" name="edit" class="btn btn-primary">Save</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <a data-toggle="modal" data-target="#deleteAdmin<?php echo $count ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger">
                                                                            <circle cx="12" cy="12" r="10"></circle>
                                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                                        </svg>
                                                                    </a>
                                                                    <div class="modal fade" id="deleteAdmin<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="addAdminTitle" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <form method="post">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="addAdminTitle">Delete Employee Record</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p class="modal-text">Are you sure to delete <?php echo $userTable["user_name"] ?>!</p>
                                                                                        <input type="hidden" name="user_id" value="<?php echo $userTable["user_id"] ?>">
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn" data-dismiss="modal"> No</button>
                                                                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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