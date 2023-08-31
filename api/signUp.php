<?php
    include("../dashboard/include/connection.php");
    include("./password.php");
    include("includer.php");
    // include("../otp_sender.php");
    date_default_timezone_set("Asia/Calcutta");
    $output_array = array();

    $data = json_decode(file_get_contents('php://input'));

    if(!empty($data->userName) && !empty($data->password)){
        $name = $data->name;
        $userName = $data->userName;
        $password = $data->password;

        $sql = "SELECT * FROM app_control WHERE id=1";
        $result = $conn->query($sql);
        if($result){
            $ControlTable = $result->fetch_assoc();
            $decryption_key = $ControlTable['cipher_key'];
			$ciphering = "AES-128-CTR";
			$option = 0;

			$query = "SELECT * FROM login WHERE username='$userName'";
			$result1 = $conn->query($query);
            if($result1->num_rows == 0){
                $date = date('Y-m-d');

                $passwordResponce = json_decode(generatePass($conn,$password));

                $NewPass = $passwordResponce->password;
                $cipher = $passwordResponce->cipher;

                $sql = "INSERT INTO user (user_name,user_phone_number,password,cipher,refresh_token) VALUES ('$name',0,'$NewPass','$cipher','')";
                if($conn->query($sql)){
                    $InsertId = $conn->insert_id;
                    $sql2 = "INSERT INTO login (user_id,username,password,cipher,control) VALUES ('$InsertId','$userName','$NewPass','$cipher','2')";
                    if($conn->query($sql2)){
                        http_response_code(200);
                        $output_array['status'] = true;
                        $output_array['message'] = 'OK';
                    }
                }

            } else{
                http_response_code(400);
                $output_array['status'] = false;
                $output_array['message'] = 'Username already registered!';
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