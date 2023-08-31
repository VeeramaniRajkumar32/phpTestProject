<?php
    ini_set('display_errors','off');
    include("../../dashboard/include/connection.php");
    $conn = new dbConnection;
    $output_array = array();

    $data = json_decode(file_get_contents('php://input'));

    if(!empty($data->requestType) && !empty($data->leaveType) && !empty($data->fromDate) && !empty($data->toDate) && !empty($data->reason)){
        $requestType = $data->requestType;
        $leaveType = $data->leaveType;
        $fromDate = date('Y-m-d',strtotime($data->fromDate));
        $toDate = date('Y-m-d',strtotime($data->toDate));
        $reason = $data->reason;
        
        switch ($requestType) {
            case 1 :
                if ($leaveType == 1) {
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('1','1','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully full day leave Inserted';
                    }
                }else{
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('1','2','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully half day leave Inserted';
                    }
                }
                break;
            case 2 :
                if ($leaveType == 1) {
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('2','1','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully full day permission Inserted';
                    }
                }else{
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('2','2','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully half day permission Inserted';
                    }
                }
                break;
            case 3 :
                if ($leaveType == 1) {
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('3','1','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully full day work from home Inserted';
                    }
                }else{
                    $query="INSERT INTO request(requestType,leaveType,fromDate,toDate,reason) VALUES('3','2','$fromDate','$toDate','$reason')";
                    $sql= $conn->query($query)->execute();
                    if($sql['status']){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Successfully half day work from home Inserted';
                    }
                }
                break;        
        }
               
    }else{
        http_response_code(400);
        $output_array['status'] = 'fail';
        $output_array['message'] = 'Bad Request';
    }

    echo json_encode($output_array);
?>