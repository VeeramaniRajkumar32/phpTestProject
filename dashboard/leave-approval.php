<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Leave </title>
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
                                            <h4 class="breadcrumb-title">Leave Request Pending</h4>
                                            <div class="row m-b30">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="table-responsive">
                                                                <table id="dataTableExample1" class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.NO</th>
                                                                            <th>Name</th>
                                                                            <th style="text-align: left">Leave Range</th>
                                                                            <th style="text-align: left">From Date</th>
                                                                            <th style="text-align: left">To Date</th>
                                                                            <th style="text-align: left">No Of Days</th>
                                                                            <th style="text-align: left">Reason</th>
                                                                            <th style="text-align: left">Remark</th>
                                                                            <th style="text-align: left">Leave Type</th>
                                                                            <th style="text-align: left">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if ($control >= 4) {
                                                                            $sql = "SELECT * FROM leave_list WHERE status='0' ORDER BY id DESC";
                                                                        } else {
                                                                            $sql = "SELECT * FROM leave_list WHERE tl_id='$user_id' AND status='0' ORDER BY id DESC";
                                                                        }
                                                                        $result = $conn->query($sql);
                                                                        $sno = 1;
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $no_of_day = "";
                                                                            $emp_id = $row['userid'];
                                                                            $leave_id = $row['id'];

                                                                            $sql1 = "SELECT name,userid,email,fcm_token FROM employee WHERE id='$emp_id'";
                                                                            $result1 = $conn->query($sql1);
                                                                            $row1 = $result1->fetch_assoc();

                                                                            $sql2 = "SELECT * FROM leave_date WHERE leave_id='$leave_id'";
                                                                            $result2 = $conn->query($sql2);
                                                                            $num_leave = $result2->num_rows;
                                                                            $from_date = $to_date = "";
                                                                            if ($num_leave > 1) {
                                                                                $leave_dates = array();
                                                                                while ($row2 = $result2->fetch_assoc()) {
                                                                                    array_push($leave_dates, $row2['date']);
                                                                                }
                                                                                $from_date = $leave_dates[0];
                                                                                $to_date = $leave_dates[$num_leave - 1];
                                                                            } else {
                                                                                $row2 = $result2->fetch_assoc();
                                                                                $from_date = $row2['date'];
                                                                            }
                                                                        ?>
                                                                            <tr>
                                                                                <form method="post">
                                                                                    <input type="hidden" name="emp_name" value="<?php echo $row1['name']; ?>">
                                                                                    <input type="hidden" name="emp_email" value="<?php echo $row1['email']; ?>">
                                                                                    <input type="hidden" name="from_date" value="<?php echo $from_date; ?>">
                                                                                    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
                                                                                    <td>
                                                                                        <center><?php echo $sno++; ?></center>
                                                                                    </td>
                                                                                    <td>
                                                                                        <center><?php echo $row1['name']; ?></center>
                                                                                    </td>
                                                                                    <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                                                                                    <input type="hidden" name="fcm_token" value="<?php echo $row1['fcm_token']; ?>">
                                                                                    <td><?php echo $row['leave_range']; ?></td>
                                                                                    <td><?php echo $from_date; ?></td>
                                                                                    <td><?php echo $to_date; ?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $no_of_day = $diff = "";
                                                                                        switch ($row['leave_range']) {
                                                                                            case 'Half Day':
                                                                                                $no_of_day = "1/2";
                                                                                                break;
                                                                                            case 'One Day':
                                                                                                $no_of_day = "1";
                                                                                                break;
                                                                                            case 'More Than a Day':
                                                                                                $no_of_day = $num_leave;
                                                                                                break;
                                                                                        }
                                                                                        echo $no_of_day;
                                                                                        ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['leave_reason']; ?></td>
                                                                                    <td style="color:<?php echo $hours; ?>">
                                                                                        <center><input type="text" name="remark" placeholder="remark" id="<?php echo $sno; ?>" class="form-control" style="width:200px;" value="<?php echo $row['tl_remark']; ?>">
                                                                                    </td>
                                                                                    <td>
                                                                                        <select name="leave_type" id="" class="form-control" required>
                                                                                            <option value="" selected value disabled>Select Type</option>
                                                                                            <option value="Informed">Informed</option>
                                                                                            <option value="Uninformed">Uninformed</option>
                                                                                            <option value="compensation">Compensation</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td>
                                                                                        <center>
                                                                                            <input type="submit" name="accept" id="accept" class="btn" style="background:green;font-size:10px;" value="Approved"><br>
                                                                                            <input type="submit" name="reject" id="reject" class="btn" style="background:red;margin-top:5px;font-size:10px;" value="Rejected">
                                                                                        </center>
                                                                                    </td>
                                                                                </form>
                                                                            </tr>
                                                                        <?php
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
                                        <div class="container-fluid">
                                            <div class="db-breadcrumb">
                                                <h4 class="breadcrumb-title">Leave Request Complete</h4>
                                            </div>
                                            <div class="row m-b30">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="table-responsive">
                                                                <table id="dataTableExample2" class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.NO</th>
                                                                            <th>Employee Name</th>
                                                                            <th style="text-align: left">Leave Type</th>
                                                                            <th style="text-align: left">Leave Range</th>
                                                                            <th style="text-align: left">From Date</th>
                                                                            <th style="text-align: left">To Date</th>
                                                                            <th style="text-align: left">Number Of Days</th>
                                                                            <th style="text-align: left">Reason</th>
                                                                            <th style="text-align: left">Remark</th>
                                                                            <th style="text-align: left">Status</th>
                                                                            <th style="text-align: left">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if ($control >= 4) {
                                                                            $sql = "SELECT * FROM leave_list WHERE status!='0' ORDER BY id DESC";
                                                                        } else {
                                                                            $sql = "SELECT * FROM leave_list WHERE tl_id='$user_id' AND status!='0' ORDER BY id DESC";
                                                                        }
                                                                        $result = $conn->query($sql);
                                                                        $sno = 1;
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $no_of_day = $status = "";
                                                                            $per = 0;
                                                                            $emp_id = $row['userid'];
                                                                            $leave_id = $row['id'];

                                                                            $sql1 = "SELECT name,userid FROM employee WHERE id='$emp_id'";
                                                                            $result1 = $conn->query($sql1);
                                                                            $row1 = $result1->fetch_assoc();

                                                                            if ($row['status'] == "0") {
                                                                                $status = "Pending";
                                                                            } else {
                                                                                if ($row['status'] == "1") {
                                                                                    $status = "Approved";
                                                                                } else {
                                                                                    $status = "Rejected";
                                                                                }
                                                                            }

                                                                            $sql2 = "SELECT * FROM leave_date WHERE leave_id='$leave_id'";
                                                                            $result2 = $conn->query($sql2);
                                                                            $num_leave = $result2->num_rows;
                                                                            $from_date = $to_date = "";
                                                                            if ($num_leave > 1) {
                                                                                $leave_dates = array();
                                                                                while ($row2 = $result2->fetch_assoc()) {
                                                                                    array_push($leave_dates, $row2['date']);
                                                                                }
                                                                                $from_date = $leave_dates[0];
                                                                                $to_date = $leave_dates[$num_leave - 1];

                                                                                if ($today < $from_date) {
                                                                                    $per = 1;
                                                                                }
                                                                            } else {
                                                                                $row2 = $result2->fetch_assoc();
                                                                                $from_date = $row2['date'];

                                                                                if ($today < $from_date) {
                                                                                    $per = 1;
                                                                                }
                                                                            }

                                                                        ?>
                                                                            <tr>
                                                                                <form method="post">
                                                                                    <td>
                                                                                        <center><?php echo $sno++; ?></center>
                                                                                    </td>
                                                                                    <td>
                                                                                        <center><?php echo $row1['name']; ?></center>
                                                                                    </td>
                                                                                    <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                                                                                    <td><?php echo $row['leave_type']; ?></td>
                                                                                    <td><?php echo $row['leave_range']; ?></td>
                                                                                    <td><?php echo date('d-m-Y', strtotime($from_date)); ?></td>
                                                                                    <td><?php echo date('d-m-Y', strtotime($to_date)); ?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $no_of_day = $diff = "";
                                                                                        switch ($row['leave_range']) {
                                                                                            case 'Half Day':
                                                                                                $no_of_day = "1/2 Day";
                                                                                                break;
                                                                                            case 'One Day':
                                                                                                $no_of_day = "1 Day";
                                                                                                break;
                                                                                            case 'More Than a Day':
                                                                                                $no_of_day = $num_leave;
                                                                                                break;
                                                                                        }
                                                                                        echo $no_of_day;
                                                                                        ?>
                                                                                    </td>
                                                                                    <td><?php echo $row['leave_reason']; ?></td>
                                                                                    <td>
                                                                                        <center><?php echo $row['remark']; ?></center>
                                                                                    </td>
                                                                                    <td>
                                                                                        <center><?php echo $status; ?></center>
                                                                                    </td>
                                                                                    <td>
                                                                                        <center>
                                                                                            <?php
                                                                                            if ($per == 1) {
                                                                                            ?>
                                                                                                <a href="delete-leave.php?id=<?php echo $leave_id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                            <?php
                                                                                            } else {
                                                                                            ?>
                                                                                                <i class="far fa-times-circle" style="color:red"></i>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </center>
                                                                                    </td>

                                                                                </form>
                                                                            </tr>
                                                                        <?php
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
                                </div>
                            </div>
                        </div>
                    </div>
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