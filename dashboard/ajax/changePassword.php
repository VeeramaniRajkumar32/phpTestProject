<?php
    include('../include/connection.php');
	$conn =new dbConnection;
	// include('include/session.php');
    
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
		
		$query = "SELECT * FROM app_control WHERE app_control_id='1'";
		$sql = $conn->query($query)->execute();
		if($sql['status']){
			$result=$sql['body'];
			$controlTable = $result->fetch_assoc();

			$decryption_key = $controlTable['cipher_key'];
			$ciphering = "AES-128-CTR";
			$option = 0;
			
			$query = "SELECT * FROM login WHERE login_id='1'";
			$sql = $conn->query($query)->execute();
			if($sql['status']){
				$result=$sql['body'];
				if($result->num_rows > 0){
					$loginTable = $result->fetch_assoc();

					$decryption_iv = $loginTable['cipher'];
					$encrypted = $loginTable['password'];

					$decrypted = openssl_decrypt($encrypted,$ciphering,$decryption_key,$option,$decryption_iv);

					if($password == $decrypted){
						$encryption_iv = rand(1111111111111111,9999999999999999);

						$NewPass = openssl_encrypt($newPassword,$ciphering,$decryption_key,$options,$encryption_iv);

						$query = "UPDATE login SET password='$NewPass',cipher='$encryption_iv' WHERE login_id='1'";
						$sql = $conn->query($query)->execute();
						if($sql['status']){
							echo 'success';
						}
					}else{
						echo "Incorrect Old Password!";
					}
				}
			}
		}
    }
?>