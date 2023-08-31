<?php
    ini_set('display_errors', 'off');
    include('include/connection.php');
    include('include/constant.php');
    
    $conn = new dbConnection;
    include('include/session.php');
    $announs = 'active';
    $announsBoolean = 'true';
    $announsShow = 'show';
    $meeting = 'active';


    //   type-1 => daily meeting=> only link.
    //     today date update
    //   type-2=> weekly meeting=> day(sunday)
    //   type-3=> monthly meeting=> date(02-22-2022)


    if(isset($_POST['add'])){
        $meeting_heading = $_POST['meeting_heading'];
        $starting_time = $_POST['starting_time'];
        $meeting_date =  $_POST['meeting_date'];
        // $meeting_day = $_POST['meeting_day'];
        $meeting_link = $_POST['meeting_link'];
        $meeting_type = $_POST['meeting_type'];
        $departmentId = count($_POST['department_id']);
        $employeeId = count($_POST['employee_id']);

        for($i=0;$i<$departmentId;$i++){
            $department_id .= $_POST['department_id'][$i].',';
        }

        $department_id = rtrim($department_id, ',');

        for($i=0;$i<$employeeId;$i++){
            $employee_id .= $_POST['employee_id'][$i].',';
        }

        $employee_id = rtrim($employee_id, ',');
     
        $query = "INSERT INTO meeting(meeting_heading,starting_time,meeting_date,meeting_link,meeting_type,department_id,employee_id) 
        VALUES ('$meeting_heading','$starting_time','$meeting_date','$meeting_link','$meeting_type','$department_id','$employee_id')";
        $sql = $conn->query($query)->execute();
            if($sql['status']){
                header('Location: meeting.php?msg=New Meeting Added!');    
            }
    }

    if(isset($_POST['edit'])){
        $meeting_id = $_POST['departmentId'];
        $meeting_heading = $_POST['meeting_heading'];
        $starting_time = $_POST['starting_time'];
        $meeting_date = $_POST['meeting_date'];
        // $meeting_day = $_POST['meeting_day'];
        $meeting_link = $_POST['meeting_link'];
        $meeting_type = $_POST['meeting_type']; 
        $department_id= $_POST['department_id'];

        
        $query = "UPDATE meeting SET meeting_heading='$meeting_heading',starting_time='$starting_time', meeting_date='$meeting_date', meeting_link='$meeting_link', department_id='$department_id'  WHERE meeting_id=$meeting_id ";
        $sql = $conn->query($query)->execute();
           if($sql['status']){
               header('Location: meeting.php?msg=Meeting Updated!');    
           }
    }

    if(isset($_POST['delete'])){
        $meeting_id = $_POST['departmentId'];

        $query = "DELETE FROM meeting WHERE meeting_id=$meeting_id";
        $sql = $conn->query($query)->execute();
        if($sql['status']){
            header('Location: meeting.php?msg=Meeting Deleted!');    
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Meeting </title>
    <link rel="icon" type="image/x-icon" href="assets/img/attendance.png"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
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
                                        <h4>All Meeting</h4>
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
                                                            <h5 class="modal-title" id="addAdminTitle">Add Meeting</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Meeting Heading</label>
                                                                    <input type="text" name="meeting_heading" id="meeting_heading" class="form-control mb-3" placeholder="Meeting Heading" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Date</label>
                                                                    <input type="date" name="meeting_date" id="meeting_date" class="form-control" placeholder="Department Name" autocomplete="off" required>
                                                                </div>
                                                                
                                                                <div class="col-md-12 mb-3">
                                                                    <label>Meeting Link</label>
                                                                    <input type="text" name="meeting_link" id="meeting_link" class="form-control mb-3" placeholder="Meeting Link" autocomplete="off" required>
                                                                </div>
                                                        
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Meeting Type</label>
                                                                    <select class="form-control" name="meeting_type">
                                                                        <option selected disabled>Choose Meeting Type</option>
                                                                        <option value="Daily Meeting">Daily Meeting</option>
                                                                        <option value="Weekly Meeting">Weekly Meeting</option>
                                                                        <option value="Monthly Meeting">Monthly Meeting </option>
                                                                    </select>
                                                                 </div>

                                                                <!--
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Meeting Day</label>
                                                                    <select class="form-control select" name="meeting_day" style="color:inherit;">
                                                                        <option selected disabled>Choose Day</option>
                                                                        <option value="Monday">Monday</option>
                                                                        <option value="Tuesday">Tuesday</option>
                                                                        <option value="Wednesday">Wednesday </option>
                                                                        <option value="Thursday">Thursday</option>
                                                                        <option value="Friday">Friday</option>
                                                                        <option value="Saturday">Saturday</option>
                                                                    </select>
                                                                </div>-->
                                                        
                                                                
                                                                
                                                                <div class="col-md-6 mb-3">
                                                                    <!-- Scheduled time -->
                                                                    <label>Starting Time</label>
                                                                    <input type="time" name="starting_time" id="starting_time" class="form-control" placeholder="Department Name" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label>Teams Types</label>
                                                                        <select class="form-control" name="team_type" id="team_type" onchange="getTeam(this.value)">
                                                                            <option selected disabled>Choose Team Type</option>
                                                                            <option value="1">Single Team(all)</option>
                                                                            <option value="2">Single Team(members) </option>
                                                                            <option value="3">Multiple Teams(all)</option>
                                                                            <option value="4">Multiple Teams(members)</option>
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="my_div">
                                                                
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
                                                <th class="text-center">Heading</th>
                                                <th class="text-center">Link</th>
                                                <th class="text-center">Scheduled Time</th>
                                                <th class="text-center">Date</th>
                                                <!-- <th class="text-center">Day</th> -->
                                                <th class="text-center">Department</th>
                                                <th class="text-center">Employees</th>
                                                <th class="text-center">Type</th>
                                                <!-- <th class="text-center">Add Team</th> -->
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $query="SELECT * FROM meeting";
                                                 $sql=$conn->query($query)->execute();  
                                                    if($sql['status']){  
                                                        $result =$sql['body'];                                            
                                                        $count = 1;
                                                        while($meetingTable = $result->fetch_assoc()){
                                                            $department_id= $meetingTable["department_id"];
                                                            $department_id = explode(',', $department_id);
                                                                              
                                                            $my_dept_count = count($department_id);
                                                            $my_dept_list = "";
                                                                for($i=0; $i < $my_dept_count; $i++){ 
                                                                    $my_dept_id = (int)$department_id[$i];

                                                                    $query1 = "SELECT * FROM department WHERE department_id=$my_dept_id";
                                                                    $sql1= $conn->query($query1)->execute();
                                                                        if($sql1['status']){
                                                                            $result1=$sql1['body'];
                                                                            $departmentTable=$result1->fetch_assoc();
                                                                            $my_dept_list.=$departmentTable['department_name'].',';
                                                                        }
                                                                }

                                                            
                                                            $employee_id=$meetingTable['user_id'];
                                                            $employee_id = explode(',', $employee_id);

                                                            $my_emp_count = count($employee_id);
                                                            $my_emp_list = "";
                                                                for($i=0; $i < $my_emp_count; $i++){ 
                                                                    $my_emp_id = (int)$employee_id[$i];

                                                                    $query2="SELECT * FROM user WHERE user_id=$my_emp_id";
                                                                    $sql2=$conn->query($query2)->execute();
                                                                        if($sql2['status']){
                                                                            $result2=$sql2['body'];
                                                                            $userTable=$result2->fetch_assoc();
                                                                            $my_emp_list.=$userTable['user_name'].',';
                                                                        }
                                                                }
                                            ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $count++ ?></td>
                                                            <td class="text-center"><?php echo $meetingTable["meeting_heading"] ?></td>
                                                            <td class="text-center"><?php echo $meetingTable["meeting_link"] ?></td>
                                                            <td class="text-center"><?php echo $meetingTable["starting_time"] ?></td>
                                                            <td class="text-center"><?php echo $meetingTable["meeting_date"] ?></td>
                                                            <!-- <td class="text-center"><?php echo $meetingTable["meeting_day"] ?></td> -->
                                                            <td class="text-center"><?php echo $my_dept_list ?></td>
                                                            <td class="text-center"><?php echo $my_emp_list; ?></td>
                                                            <td class="text-center"><?php echo $meetingTable["meeting_type"] ?></td>
                                                            <!-- <td class="text-center"> <a href="meeting-team.php?id=<?php echo $meetingTable['meeting_id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></td> -->

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
                                                                                            <h5 class="modal-title" id="addAdminTitle<?php echo $count ?>">Edit Meeting</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 mb-3">
                                                                                                    <label>Meeting Heading</label>
                                                                                                    <input type="text" name="meeting_heading" id="meeting_heading" class="form-control mb-3" placeholder="Meeting Heading" autocomplete="off" required>
                                                                                                </div>
                                                                                                
                                                                                                <div class="col-md-6 mb-3">
                                                                                                <label>Meeting Link</label>
                                                                                                    <input type="text" name="meeting_link" id="meeting_link" class="form-control mb-3" placeholder="Meeting Link" autocomplete="off" required>
                                                                                                </div>
                                                                                        
                                                                                                <div class="col-md-6 mb-3">
                                                                                                    <label>Meeting Type</label>
                                                                                                    <select class="form-control selectpicker mb-3" name="meeting_type">
                                                                                                    <option selected disabled>Choose Meeting Type</option>
                                                                                                        <option value="Daily Meeting">Daily Meeting</option>
                                                                                                        <option value="Weekly Meeting">Weekly Meeting</option>
                                                                                                        <option value="Monthly Meeting">Monthly Meeting </option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="col-md-6 mb-3">
                                                                                                    <label>Meeting Day</label>
                                                                                                    <select class="form-control selectpicker mb-3" name="meeting_day" style="color:inherit;">
                                                                                                        <option selected disabled>Choose Day</option>
                                                                                                        <option value="Monday">Monday</option>
                                                                                                        <option value="Tuesday">Tuesday</option>
                                                                                                        <option value="Wednesday">Wednesday </option>
                                                                                                        <option value="Thursday">Thursday</option>
                                                                                                        <option value="Friday">Friday</option>
                                                                                                        <option value="Saturday">Saturday</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            <input type="hidden" name="departmentId" value="<?php echo $meetingTable["department_id"] ?>">
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
                                                                                            <h5 class="modal-title" id="addAdminTitle">Delete Department</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="modal-text">Are you sure to delete <?php echo $meetingTable["meeting_heading"] ?>!</p>
                                                                                            <input type="hidden" name="departmentId" value="<?php echo $meetingTable["meeting_id"] ?>">
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
        <?php include('include/footer.php'); ?>
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
        function getTeam(team_type) {
            $.ajax({
                type: "POST",
                url: "ajax/userDetails.php",
                data: {'team_type': team_type},
                success: function(data){
                    $('#my_div').html(data);
                }
            });
        }
        function get_employee(dept_id) {
            $.ajax({
                type: "POST",
                url: "ajax/userDetails.php",
                data: {'dept_id': dept_id},
                success: function(data){
                    $('#employee_type_two').html(data);
                }
            });         
        }
    </script>
    <script>
        $(document).ready(function(){
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="assets/js/manual.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
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