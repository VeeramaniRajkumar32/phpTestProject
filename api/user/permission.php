<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;

$output = array();
$data = json_decode(file_get_contents('php://input'));

//   type1 => permission
//   type2 => wfh

if (!empty($data->requestType) && !empty($data->user_id)) {
    $user_id = $data->user_id;
    $requestType = $data->requestType;

    $leaveType = $data->leaveType;
    $reason = $data->reason;
    $request_id = $data->request_id;


    if ($requestType == 1) {
        $query = "SELECT * FROM request WHERE requestType='$requestType' AND user_id='$user_id'";
        $sql = $conn->query($query)->execute();
        if ($sql['status']) {
            $result = $sql['body'];
            if ($result->num_rows > 0) {
                $query = "UPDATE request SET reason='$reason',requestType='$requestType',leaveType='$leaveType' where user_id='$user_id' and requestType='$requestType'";
            } else {
                $query = "INSERT INTO request (user_id,reason,leaveType,requestType) VALUES ('$user_id','$reason','$leaveType','$requestType')";
            }
            if ($conn->query($query)->execute() === TRUE) {
                if ($request_id) {
                    $output['request_id'] = $request_id;
                } else {
                    $query = "SELECT * FROM request WHERE user_id='$user_id' ORDER BY request_id DESC LIMIT 1";
                    $sql = $conn->query($query)->execute();
                    if ($sql['status']) {
                        $result = $sql['body'];
                        $row = $result->fetch_assoc();
                    }
                }
            }
            http_response_code(200);
            $output['status'] = 'success';
            $output['message'] = 'OK';
        }
    } 
    else if ($requestType == 2) {
        $query = "SELECT * FROM request WHERE requestType='$requestType' AND user_id='$user_id'";
        $sql = $conn->query($query)->execute();
        if ($sql['status']) {
            $result = $sql['body'];
            if ($result->num_rows > 0) {
                $query = "UPDATE request SET reason='$reason' where user_id='$user_id' and requestType='$requestType'";
            } else {
               $query = "INSERT INTO request (user_id,reason) VALUES ('$user_id','$reason')";
            }
            if ($conn->query($query)->execute() === TRUE) {
                if ($request_id) {
                    $output['request_id'] = $request_id;
                } else {
                    $query = "SELECT * FROM request WHERE user_id='$user_id' ORDER BY request_id DESC LIMIT 1";
                    $sql = $conn->query($query)->execute();
                    if ($sql['status']) {
                        $result = $sql['body'];
                        $row = $result->fetch_assoc();
                    }
                }
            }
        }
        http_response_code(200);
        $output['status'] = 'success';
        $output['message'] = 'OK';
    }else{
        http_response_code(202);
        $output['status'] = 'fail';
        $output['message'] = 'no request type'; 
    }
} else {
    http_response_code(400);
    $output['status'] = 'fail';
    $output['message'] = 'Bad Request';
}

if (count($output)) {
    echo json_encode($output);
}
