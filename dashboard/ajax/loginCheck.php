<?php
    include('../include/connection.php');
	$conn=new dbConnection;

    if(isset($_POST['username']))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];

		$query = "SELECT * FROM app_control WHERE app_control_id='1'";
		$sql = $conn->query($query)->execute();
		if($sql['status']){
			$result =$sql['body'];
			$ControlTable = $result->fetch_assoc();
	
			$decryption_key = $ControlTable['cipher_key'];
			$ciphering = "AES-128-CTR";
			$option = 0;

			$query = "SELECT * FROM login WHERE BINARY username='$username'";
			$sql = $conn->query($query)->execute();
			if($sql['status']){
				$result =$sql['body'];
				if($result->num_rows > 0)
				{
					$loginTable = $result->fetch_assoc();
		
					$decryption_iv = $loginTable['cipher'];
					$encrypted = $loginTable['password'];
		
					$decrypted = openssl_decrypt($encrypted,$ciphering,$decryption_key,$option,$decryption_iv);
		
					if($password == $decrypted)
					{
						echo $loginTable["login_id"];
					}
					else
					{
						echo "Incorrect Password!";
					}
				} else{
					echo "Invalid Username!";
				}
			}
		}
	}
?>