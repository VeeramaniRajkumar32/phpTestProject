<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output_array = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->requestType) && !empty($data->leaveType)) {
    $requestType = $data->requestType;
    $leaveType = $data->leaveType;
    $fromDate = date('Y-m-d', strtotime($data->fromDate));
    $toDate = date('Y-m-d', strtotime($data->toDate));
    $date = date('Y-m-d', strtotime($data->date));
    $reason = $data->reason;
    $tl_id = $data->tl_id;
    $start_time = $data->start_time;
    $end_time = $data->end_time;
    $user_id = $data->user_id;
    $admin_id = $data->admin_id;
    $duration = $end_time - $start_time;
    $leave_id = $data->leave_id;

    switch ($requestType) {
        case 1:
            $query = "INSERT INTO leave_list (requestType,leaveType,user_id,tl_id,fromDate,toDate,reason) 
                    VALUES('$requestType','$leaveType','$user_id','$tl_id','$fromDate','$toDate','$reason')";
            $sql = $conn->query($query)->execute();
            if ($sql['status']) {

                $insert_id = $conn->conn->insert_id;
                $query1 = "INSERT INTO leave_details (requestType,leaveType,leave_id,date,user_id,reason) 
                    VALUES('$requestType','$leaveType','$insert_id','$date','$user_id','$reason')";
                $sql1 = $conn->query($query1)->execute();
                if ($sql1['status']) {

                    http_response_code(200);
                    $output_array['status'] = 'success';
                    $output_array['message'] = 'Successfully leave Inserted';
                }
            }
            break;
        case 2:
            $query = "INSERT INTO request_permission (requestType,duration,user_id,date,start_time,end_time,reason,admin_id) 
                    VALUES('$requestType','$duration','$user_id','$date','$start_time','$end_time','$reason','$admin_id')";
            $sql = $conn->query($query)->execute();
            if ($sql['status']) {
                http_response_code(200);
                $output_array['status'] = 'success';
                $output_array['message'] = 'Successfully permission Inserted';
            }
            break;
        case 3:
            $query = "INSERT INTO request_wfh (requestType,leaveType,user_id,fromDate,toDate,reason,admin_id) 
                    VALUES('$requestType','$leaveType','$user_id','$fromDate','$toDate','$reason','$admin_id')";
            $sql = $conn->query($query)->execute();
            if ($sql['status']) {
                http_response_code(200);
                $output_array['status'] = 'success';
                $output_array['message'] = 'Successfully work from home Inserted';
            }
            break;
    }
} else {
    http_response_code(400);
    $output_array['status'] = 'fail';
    $output_array['message'] = 'Bad Request';
}

echo json_encode($output_array);


?>
