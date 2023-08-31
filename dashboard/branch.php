<?php
    ini_set('display_errors', 'off');
    include('include/connection.php');
    include('include/constant.php');
    
    $conn = new dbConnection;
    include('include/session.php');
    $controls = 'active';
    $controlBoolean = 'true';
    $menuShow = 'show';
    $branch = 'active';

    if(isset($_POST['add'])){
     $branch_name = $_POST['branch_name'];
     $branch_latitude= (double)$_POST['branch_latitude'];
     $branch_longitude= (double)$_POST['branch_longitude'];
     $branch_address= $_POST['branch_address'];
     $branch_radius= (int)$_POST['branch_radius'];
     
    $query = "INSERT INTO branch(branch_name,branch_address,branch_latitude,branch_longitude,branch_radius)
     VALUES ('$branch_name','$branch_address',$branch_latitude,$branch_longitude,$branch_radius)";
     $sql = $conn->query($query)->execute();
        if($sql['status']){
            header('Location: branch.php?msg=Branch Added!');    
        }
    }

    if(isset($_POST['edit'])){
        $branchId = $_POST['branchId'];
        $branch_name = $_POST['branch_name'];
        $branch_address= $_POST['branch_address'];
        $branch_latitude= (double)$_POST['branch_latitude'];
        $branch_longitude= (double)$_POST['branch_longitude'];
        $branch_radius= (int)$_POST['branch_radius'];
        
      echo $query = "UPDATE branch SET branch_name='$branch_name',branch_address='$branch_address',branch_latitude=$branch_latitude,branch_longitude=$branch_longitude,branch_radius=$branch_radius WHERE branch_id=$branchId";
        $sql = $conn->query($query)->execute();
           if($sql['status']){
               header('Location: branch.php?msg=Branch Updated!');    
           }
    }

    if(isset($_POST['delete'])){
        $branchId = $_POST['branchId'];

        $query = "DELETE FROM branch WHERE branch_id='$branchId'";
        $sql = $conn->query($query)->execute();
        if($sql['status']){
            header('Location: branch.php?msg=Branch Deleted!');    
        }
    }


    // <!--  REGEX 
    // pattern="^-?[0-9]{1,3}(?:\.[0-9]{1,15})?$"
    // oninvalid="this.setCustomValidity('Invalid Lattitude')" oninput="this.setCustomValidity('')"
    //  -->
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>All Branch</title>
    <link rel="icon" type="image/x-icon" href="assets/img/attendance.png"/>
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
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css"/>
    <link href="plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css"/>
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
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
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
                                        <h4>All Branches</h4>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-outline-primary float-right m-3" data-toggle="modal" data-target="#exampleModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            Add New
                                        </button>
                                        <div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="padding-right: 17px; display: none;" aria-modal="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addAdminTitle">Add Branch</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="branch_name" id="branch_name1" class="form-control mb-3" placeholder="Branch Name" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                     <input type="number" step="any" name="branch_latitude" class="form-control mb-3" placeholder="Lattitude" autocomplete="off"  required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                     <input type="number" step="any" name="branch_longitude" id="branch_longitude1" class="form-control mb-3" placeholder="Longtitude" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                     <input type="number" name="branch_radius" class="form-control mb-3" placeholder="Radius" autocomplete="off"  required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="branch_address" id="branch_address1" class="form-control mb-3" placeholder="Address" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                            <button type="submit" name="add" class="btn btn-primary">Add</button>
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
                                                <th class="text-center">Branch Name</th>
                                                <th class="text-center">Lattitude</th>
                                                <th class="text-center">Longtitude</th>
                                                <th class="text-center">Radius</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $query = "SELECT * FROM branch";
                                                 $sql = $conn->query($query)->execute();  
                                                 if($sql['status']){  
                                                     $result =$sql['body'];                                            
                                                     $count = 1;
                                                     while($branchTable = $result->fetch_assoc()){
                                            ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $count++; ?></td>
                                                            <td class="text-center"><?php echo $branchTable["branch_name"]; ?></td>
                                                            <td class="text-center"><?php echo $branchTable["branch_latitude"]; ?></td> 
                                                            <td class="text-center"><?php echo $branchTable["branch_longitude"]; ?></td> 
                                                            <td class="text-center"><?php echo $branchTable["branch_radius"]; ?></td>
                                                            <td class="text-center"><?php echo $branchTable["branch_address"]; ?></td>
                                                          
                                                            <td class="text-center">
                                                                <ul class="table-controls">
                                                                    <li>
                                                                        <a data-toggle="modal" data-target="#edit<?php echo $count ?>">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                                                        </a>
                                                                        <div class="modal fade" id="edit<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="addAdminTitle<?php echo $count ?>" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <form method="post" enctype="multipart/form-data">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="addAdminTitle<?php echo $count ?>">Edit Branch</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 mb-2">
                                                                                                    <label>Branch Name</label>
                                                                                                    <input type="text" name="branch_name" id="branch_name<?php echo $count ?>" class="form-control" placeholder="Department Name" autocomplete="off" value="<?php echo $branchTable['branch_name'] ?>" required>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="col-md-6 mb-2">
                                                                                                 <label>Latitude</label>
                                                                                                     <input type="number" step="any" name="branch_latitude" id="branch_latitude1" class="form-control mb-3" placeholder="Lattitude" autocomplete="off" value="<?php echo $branchTable['branch_latitude'] ?>" required>
                                                                                                </div>
                                                                                                <div class="col-md-6 mb-2">
                                                                                                 <label>Longitude</label>
                                                                                                     <input type="number" step="any" name="branch_longitude" id="branch_longitude1" class="form-control mb-3" placeholder="Longtitude" autocomplete="off" value="<?php echo $branchTable['branch_longitude'] ?>" required>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                <label>Radius</label>
                                                                                                        <input type="number" name="branch_radius" class="form-control mb-3" placeholder="Radius" value="<?php echo $branchTable['branch_radius'] ?>" autocomplete="off"  required>
                                                                                                 </div>
                                                                                                <div class="col-md-12 mb-2">
                                                                                                <label>Address</label>
                                                                                                    <input type="text" name="branch_address" id="branch_address1" class="form-control mb-3" placeholder="Address" autocomplete="off" value="<?php echo $branchTable['branch_address'] ?>" required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden" name="branchId" value="<?php echo $branchTable["branch_id"] ?>">
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
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                                        </a>
                                                                        <div class="modal fade" id="deleteAdmin<?php echo $count ?>" tabindex="-1" role="dialog" aria-labelledby="addAdminTitle" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <form method="post">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="addAdminTitle">Delete Branch</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="modal-text">Are you sure to delete <?php echo $branchTable["branch_name"] ?>!</p>
                                                                                            <input type="hidden" name="branchId" value="<?php echo $branchTable["branch_id"] ?>">
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
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
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