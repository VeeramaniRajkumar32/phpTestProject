<?php
function send_fcm($conn,$token,$data){
    $url = "https://fcm.googleapis.com/fcm/send";

    $query ="SELECT * FROM app_control WHERE app_control_id='1'";
        $sql = $conn->query($query)->execute();
        if($sql['status']){
            $result = $sql['body'];
            $controlTable = $result->fetch_assoc();

            $serverKey = $controlTable['fcm_key'];

        $arrayToSend = array('to'=>$token,'data'=>$data,'priority'=>'high');

        $headers = array();

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        return curl_exec($ch);
        }
}
?>