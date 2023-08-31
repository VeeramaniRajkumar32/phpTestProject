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
                                            <h6>All Leave</h6>
                                            <div class="row m-b30">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="table-responsive">
                                                                <table id="dataTableExample1" class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>S.NO</th>
                                                                            <th style="text-align: left">Type</th>
                                                                            <th style="text-align: left">Range</th>
                                                                            <th style="text-align: left">From Date</th>
                                                                            <th style="text-align: left">To Date</th>
                                                                            <th style="text-align: left">Reason</th>
                                                                            <th style="text-align: left">Remark</th>
                                                                            <th style="text-align: left">Status</th>
                                                                            <th style="text-align: left">Edit</th>
                                                                            <th style="text-align: left">Delete</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $sql = "SELECT * FROM leave_list WHERE userid='$user_id' ORDER BY id DESC";
                                                                        $result = $conn->query($sql);
                                                                        $sno = 1;
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $leave_id = $row['id'];

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
                                                                            } else {
                                                                                $row2 = $result2->fetch_assoc();
                                                                                $from_date = $row2['date'];
                                                                            }

                                                                        ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <center><?php echo $sno++; ?></center>
                                                                                </td>
                                                                                <td><?php echo $row['leave_type']; ?></td>
                                                                                <td><?php echo $row['leave_range']; ?></td>
                                                                                <td><?php echo $from_date; ?></td>
                                                                                <td><?php echo $to_date; ?></td>
                                                                                <td><?php echo $row['leave_reason']; ?></td>
                                                                                <td><?php echo $row['remark']; ?></td>
                                                                                <td><?php echo $status; ?></td>
                                                                                <?php
                                                                                if ($row['status'] == "0") {
                                                                                ?>
                                                                                    <td>
                                                                                        <center><a href="edit-leave.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center>
                                                                                    </td>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <td>
                                                                                        <center><i class="far fa-times-circle" style="color:red"></i></center>
                                                                                    </td>
                                                                                <?php
                                                                                }
                                                                                if ($from_date > $today) {
                                                                                ?>
                                                                                    <td>
                                                                                        <center><a href="delete-leave.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></center>
                                                                                    </td>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <td>
                                                                                        <center><i class="far fa-times-circle" style="color:red"></i></center>
                                                                                    </td>
                                                                                <?php
                                                                                }
                                                                                ?>
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