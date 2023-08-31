<?php
    include("../../dashboard/include/connection.php");
    date_default_timezone_set("Asia/Calcutta");
    include("../otp_sender.php");
    $conn = new dbConnection;
    $output_array = array();

    $data = json_decode(file_get_contents('php://input'));

    if(!empty($data->mobile) && !empty($data->fcm)){
        $phone = $data->mobile;
        $fcm = $data->fcm;

        $randomid = mt_rand(1000,9999);

        $msg = "Your login OTP to Signup ".$randomid.".";

        $msg = urlencode($msg);

        $query =  "SELECT * FROM user WHERE user_phone_number='$phone'";
        $sql = $conn->query($query)->execute();
        if($sql['status']){
            $result = $sql['body'];
            if($result->num_rows > 0){
                $userTable = $result->fetch_assoc();
                $query2 = "UPDATE user SET fcm_token='$fcm',member_otp='$randomid' WHERE user_phone_number='$phone'";
                $sql2 = $conn->query($query2)->execute();
                if($sql2['status']){
                    $responce = Send_OTP($phone,$msg,$randomid);
                    if($responce->type == 'success'){
                        http_response_code(200);
                        $output_array['status'] = 'success';
                        $output_array['message'] = 'Ok';
                        $output_array['id'] = $userTable["user_id"];
                   }
                }else{
                    http_response_code(500);
                    $output_array['status'] = 'fail';
                    $output_array['message'] = 'Internal Server Error';
                }
            } else{
                http_response_code(404);
                $output_array['status'] = 'fail';
                $output_array['message'] = 'User not found';
            }
            
        }
    } else{
        http_response_code(400);
        $output_array['status'] = 'fail';
        $output_array['message'] = 'Bad Request';
    }

    echo json_encode($output_array);
?>