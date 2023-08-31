<?php
    function generatePass($conn,$newPass){
        $query = "SELECT * FROM app_control WHERE id='1'";
		$result = $conn->query($query);

        $ControlTable = $result->fetch_assoc();

        $key = $ControlTable['cipher_key'];
        $ciphering = "AES-128-CTR";
        $option = 0;
        $cipher = rand(1111111111111111,9999999999999999);

        $encrypted = openssl_encrypt($newPass,$ciphering,$key,$option,$cipher);

        $out['password'] = $encrypted;
        $out['cipher'] = $cipher;

        return json_encode($out);
    }
    function chechPass($conn,$oldPass,$cipher,$newPass){
        $query = "SELECT * FROM app_control WHERE app_control_id='1'";
		$sql = $conn->query($query)->execute();
		if($sql['status']){
			$result =$sql['body'];

            $ControlTable1 = $result->fetch_assoc();

            $decryption_key = $ControlTable1['cipher_key'];
            $ciphering = "AES-128-CTR";
            $option = 0;
    
            $decrypted = openssl_decrypt($oldPass,$ciphering,$decryption_key,$option,$cipher);
    
            if($decrypted == $newPass){
                return TRUE;
            } else{
                return FALSE;
            }
        }
    }
?>