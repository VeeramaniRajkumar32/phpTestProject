<?php
    function Send_OTP($phone,$msg,$otp){
       // $url = "http://sms.cloudsolz.com/api/otp.php?authkey=349348ALtWCC01w6im5fdf6363P1&mobile=$phone&message=$msg&sender=user&otp=$otp";
        $url = "https://control.msg91.com/api/sendotp.php?authkey=351006AmayOUCqWlJO5ff32c30P1&mobile=$phone&message=$msg&sender=GTSSMS&otp=$otp&DLT_TE_ID=1207161855329572829";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $responce = curl_exec($ch);

        return json_decode($responce);
    }
?>