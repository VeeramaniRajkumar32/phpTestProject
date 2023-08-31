<?php
    include("../dashboard/include/connection.php");

    include("includer.php");
    // include("../otp_sender.php");
    date_default_timezone_set("Asia/Calcutta");
    $output_array = array();

    $data = json_decode(file_get_contents('php://input'));

    if(!empty($data->userName) && !empty($data->password)){
        $userName = $data->userName;
        $password = $data->password;
        // $version = $data->version;
        // $device = $data->deviceInfo;
        // $check = 0;

        $sql = "SELECT * FROM app_control WHERE id=1";
        $result = $conn->query($sql);
        if($result){
            $ControlTable = $result->fetch_assoc();
            $decryption_key = $ControlTable['cipher_key'];
			$ciphering = "AES-128-CTR";
			$option = 0;

			$query = "SELECT * FROM login WHERE BINARY username='$userName'";
			$result1 = $conn->query($query);
            if($result->num_rows > 0){
                $loginTable = $result->fetch_assoc();
    
                $decryption_iv = $loginTable['cipher'];
                $encrypted = $loginTable['password'];
    
                $decrypted = openssl_decrypt($encrypted,$ciphering,$decryption_key,$option,$decryption_iv);
    
                if($password == $decrypted)
                {
                    echo $loginTable["login_id"];
                    $issue_code = mt_rand(10000000,99999999);

                    $responce = createToken($conn,$user_id,$issue_code);
        
                    $my_referal_code = "FA".$user_id;
        
                    if($responce['current_token']){
                        $token = $responce['current_token'];
                        $refresh_token = $responce['refresh_token'];
        
                        $sql = "UPDATE user SET refresh_token='$refresh_token',my_referal_code='$my_referal_code' WHERE user_id='$user_id'";
                        if($conn->query($sql) === TRUE){
                            if($otp){
                                $phone1 = trim($phone, "+");
                                $responce = Send_OTP($phone1,$msg,$randomid);
                                if($responce->type == 'success'){
                                    http_response_code(200);
                                    $output_array['status'] = true;
                                    $output_array['message'] = 'OK';
                                    $output_array['token'] = $token;
                                    $output_array['responce'] = $responce;
                                } else{
                                    http_response_code(402);
                                    $output_array['status'] = false;
                                    $output_array['message'] = 'Unable to send OTP';
                                    $output_array['responce'] = $responce;
                                }
                            } else{
                                http_response_code(200);
                                $output_array['status'] = true;
                                $output_array['message'] = 'OK';
                                $output_array['token'] = $token;
                            }
                        } else{
                            http_response_code(500);
                            $output_array['status'] = false;
                            $output_array['message'] = 'Internal Server Error';
                        }
                    } else{
                        http_response_code(500);
                        $output_array['status'] = false;
                        $output_array['message'] = 'Token generation failed';
                        $output_array['responce'] = $responce;
                    }
                }
                else
                {
                    http_response_code(400);
                    $output_array['status'] = false;
                    $output_array['message'] = 'Incorrect Password!';
                }
            } else{
                http_response_code(400);
                $output_array['status'] = false;
                $output_array['message'] = 'Invalid Username!';
            }
        }
    } else{
        http_response_code(400);
        $output_array['status'] = false;
        $output_array['message'] = 'Bad Request';
    }

    echo json_encode($output_array);

    // $conn->close();
?>