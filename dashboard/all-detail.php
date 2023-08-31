<?php
ini_set('display_errors', 'off');
include('include/connection.php');
include('include/constant.php');
$conn = new dbConnection;
include('include/session.php');
$controls = 'active';
$controlBoolean = 'true';
$menuShow = 'show';
$member = 'active';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Personal Detail </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->

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

                <div class="row layout-top-spacing" id="cancel-row">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header pt-3">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <h4 class="col-sm-9">All Detail</h4>
                                        <div class="col-sm-3">
                                            <a href="add-detail.php">
                                                <button type="button" class="btn btn-outline-primary float-right m-3" data-toggle="modal" data-target="#exampleModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                    Add New
                                                </button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area br-6">
                                    <div class="table-responsive mb-4 mt-4">
                                        <table id="zero-config" class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">First Name</th>
                                                    <th class="text-center">Last Name</th>
                                                    <th class="text-center">Father Name</th>
                                                    <th class="text-center">Mother Name</th>
                                                    <th class="text-center">Blood Group</th>
                                                    <th class="text-center">DOB</th>
                                                    <th class="text-center">gender</th>
                                                    <th class="text-center">experience</th>
                                                    <th class="text-center">Address</th>
                                                    <th class="text-center">Permanent Address</th>
                                                    <th class="text-center">Phone Number</th>
                                                    <th class="text-center">Emgerency Contact Number</th>
                                                    <th class="text-center">PAN copy</th>
                                                    <th class="text-center">Aadhar Copy</th>
                                                    <th class="text-center">Passport Copy</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "SELECT * FROM personal";
                                                $sql = $conn->query($query)->execute();

                                                if ($sql['status']) {
                                                    $result = $sql['body'];
                                                    $i = 1;
                                                    while ($PersonalDetailTable = $result->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i++; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['emp_first']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['emp_last']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['father_name']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['mother_name']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['blood_group']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['DOB']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['gender']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['experience']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['address']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['permanent_address']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['phone_number']; ?></td>
                                                            <td class="text-center"><?php echo $PersonalDetailTable['emgerency_contact_no']; ?></td>
                                                            <td class="text-center"><img src="<?php echo $PersonalDetailTable['pan']; ?>" width="100px" height="100" /></td>
                                                            <td class="text-center"><img src="<?php echo $PersonalDetailTable['aadhar']; ?>" width="100px" height="100" /></td>
                                                            <td class="text-center"><img src="<?php echo $PersonalDetailTable['passport']; ?>" width="100px" height="100" /></td>
                                                            <td class="text-center">
                                                                <a href="edit-detail.php?id=<?php echo $PersonalDetailTable['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success">
                                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                                    </svg></a>
                                                                <a href="delete-detail.php?id=<?php echo $PersonalDetailTable['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg></a>
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
                <?php include('include/footer.php') ?>

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
        <script src="assets/js/manual.js"></script>
        <script src="assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="plugins/table/datatable/datatables.js"></script>
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
        <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>