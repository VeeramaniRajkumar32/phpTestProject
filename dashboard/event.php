<?php
ini_set('display_errors', 'off');
include('include/connection.php');
include('include/constant.php');

$conn = new dbConnection;
include('include/session.php');
$announs = 'active';
$announsBoolean = 'true';
$announsShow = 'show';
$event = 'active';

if (isset($_POST['add'])) {
    $event_tiltle  = $_POST['event_tiltle'];
    $event_date = $_POST['event_date'];
    $starting_time = $_POST['starting_time'];
    $branch_id = $_POST['branch_id'];

    $event_image  = $_FILES['event_image']['name'];

    $query = "INSERT INTO event (event_tiltle , event_date, starting_time, branch_id) 
    VALUES('$event_tiltle','$event_date','$starting_time', '$branch_id')";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $query1 = "SELECT * FROM event ORDER BY event_id DESC LIMIT 1";
        $sql1 = $conn->query($query1)->execute();
        if ($sql1['status']) {
            $result1 = $sql1['body'];
            $memberTable = $result1->fetch_assoc();

            $received_id = $memberTable['event_id'];

            $resumetype1 = pathinfo($event_image, PATHINFO_EXTENSION);
            $resumename1 = "upload/event/" . $received_id . "." . $resumetype1;
            $allowedTypes1 = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF', 'pdf', 'PDF');
            if (in_array($resumetype1, $allowedTypes1)) {
                if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $resumename1)) {
                    $query2 = "UPDATE event SET event_image  = '$resumename1' WHERE event_id = '$received_id'";
                    $sql2 = $conn->query($query2)->execute();
                    if ($sql2['status']) {
                        header('Location: event.php?msg=event added!');
                    }
                }
            }
        }
    }
}

if (isset($_POST['edit'])) {
    $event_id = $_POST['event_id'];

    $event_tiltle  = $_POST['event_tiltle'];
    $event_date = $_POST['event_date'];
    $starting_time = $_POST['starting_time'];
    $branch_id = $_POST['branch_id'];

    $event_image  = $_FILES['event_image']['name'];

    $query3 = "UPDATE event SET event_tiltle ='$event_tiltle', event_date='$event_date', starting_time='$starting_time',
    branch_id='$branch_id' WHERE event_id='$event_id'";
    $sql3 = $conn->query($query3)->execute();
    if ($sql3['status']) {
        if ($event_image) {
            $extension = pathinfo($event_image, PATHINFO_EXTENSION);
            $imageName = "upload/event/" . $event_id . "." . $extension;
            $allowedTypes = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG', 'gif', 'GIF');
            if (in_array($extension, $allowedTypes)) {
                if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $imageName)) {
                    $query1 = "UPDATE event SET event_image='$imageName' WHERE event_id = '$event_id'";
                    $conn->query($query1)->execute();
                }
            }
        }
        header('Location: event.php?msg=event Record Updated!');
    }
}


if (isset($_POST['delete'])) {
    $event_id = $_POST['event_id'];

    $query = "DELETE FROM event WHERE event_id='$event_id'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        header('Location: event.php?msg=event Record Deleted!');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>All Event</title>
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

    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

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
                                        <h4>Event Details</h4>
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
                                                            <h5 class="modal-title" id="addAdminTitle">Add Event</h5>
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
                                                                    <input type="text" name="event_tiltle" id="event_tiltle" class="form-control mb-3" placeholder="Event" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <input type="file" id="event_image" name="event_image" class="form-control mb-3">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="date" name="event_date" id="event_date" class="form-control mb-3" placeholder="Event Date" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <input type="time" name="starting_time" id="starting_time" class="form-control mb-3" placeholder="Event starting time " autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <select type="text" name="branch_id" id="branch_id" class="form-control" required>
                                                                        <option selected disabled>Select Branch </option>
                                                                        <option value="0">All Branch</option>
                                                                        <?php
                                                                        $query1 = "SELECT * FROM branch";
                                                                        $sql1 = $conn->query($query1)->execute();
                                                                        if ($sql1['status']) {
                                                                            $result1 = $sql1['body'];
                                                                            while ($branchTable = $result1->fetch_assoc()) {
                                                                        ?>
                                                                                <option value="<?php echo $branchTable['branch_id']; ?>"><?php echo $branchTable['branch_name']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
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
                                                <th class="text-center">title</th>
                                                <th class="text-center">image</th>
                                                <th class="text-center">date</th>
                                                <th class="text-center">time</th>
                                                <th class="text-center">branch</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM event";
                                            $sql = $conn->query($query)->execute();
                                            if ($sql['status']) {
                                                $result = $sql['body'];
                                                $count = 1;
                                                while ($eventTable = $result->fetch_assoc()) {
                                                    $event_id = $eventTable['event_id'];
                                                    $branch_id = $eventTable['branch_id'];

                                                    $query1 = "SELECT * FROM branch WHERE branch_id='$branch_id'";
                                                    $sql1 = $conn->query($query1)->execute();
                                                    if ($sql1['status']) {
                                                        $result1 = $sql1['body'];
                                                        $branchTable1 = $result1->fetch_assoc();
                                                    }

                                                    if ($branch_id == 0) {
                                                        $branchName = "All Branch";
                                                    } else {
                                                        $branchName = $branchTable1["branch_name"];
                                                    }
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $count++; ?></td>
                                                        <td class="text-center"><?php echo $eventTable["event_tiltle"]; ?></td>
                                                        <td class="text-center"><img src="<?php echo $eventTable['event_image']; ?>" width="100px" height="100" /></td>
                                                        <td class="text-center"><?php echo $eventTable["event_date"]; ?></td>
                                                        <td class="text-center"><?php echo $eventTable["starting_time"]; ?></td>
                                                        <td class="text-center"><?php echo $branchName; ?></td>
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
                                                                                        <h5 class="modal-title" id="addAdminTitle<?php echo $count ?>">Edit Event Record</h5>
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
                                                                                                <input type="text" name="event_tiltle" id="event_tiltle" class="form-control mb-3" value="<?php echo $eventTable['event_tiltle']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <input type="date" name="event_date" id="event_date" class="form-control mb-3" value="<?php echo $eventTable['event_date']; ?>">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <input type="time" name="starting_time" id="starting_time" class="form-control mb-3" value="<?php echo $eventTable['starting_time']; ?>">
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <select type="text" name="branch_id" id="branch_id" class="form-control mb-3" autocomplete="off" required>
                                                                                                    <option value="" selected value disabled>Select branch</option>
                                                                                                    <?php
                                                                                                    $query1 = "SELECT * FROM branch";
                                                                                                    $sql1 = $conn->query($query1)->execute();
                                                                                                    if ($sql1['status']) {
                                                                                                        $result1 = $sql1['body'];
                                                                                                        while ($branchTable = $result1->fetch_assoc()) {
                                                                                                            $select = "";
                                                                                                            if ($eventTable['branch_id'] ==  $branchTable['branch_id']) {
                                                                                                                $select = "selected";
                                                                                                            }
                                                                                                    ?>
                                                                                                            <option value="<?php echo $branchTable['branch_id']; ?>" <?php echo $select; ?>><?php echo $branchTable['branch_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-8">
                                                                                                <input type="file" id="event_image-file" name="event_image" class="form-control">
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <img src="<?php echo $eventTable['event_image']; ?>" width="50" height="50">
                                                                                            </div>
                                                                                        </div>

                                                                                        <input type="hidden" name="event_id" value="<?php echo $eventTable["event_id"] ?>">
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
                                                                                        <h5 class="modal-title" id="addAdminTitle">Delete Event Record</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <p class="modal-text">Are you sure to delete <?php echo $eventTable["event_title"] ?>!</p>
                                                                                        <input type="hidden" name="event_id" value="<?php echo $eventTable["event_id"] ?>">
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