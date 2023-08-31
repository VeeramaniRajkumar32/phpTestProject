<?php
	include("../../ControlPanel/include/connection.php");
	include("../jwt.php");
	date_default_timezone_set("Asia/Calcutta");
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Expose-Headers: *');
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
	header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, authentication');
	header('Content-Type: application/json');

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		$output_array['status'] = true;

		echo json_encode($output_array);
		exit();
	}

	$header = apache_request_headers();

	$responseToken = false;

	if(!empty($header['Authentication'])){
		$responseToken = $header['Authentication'];
	}
?>