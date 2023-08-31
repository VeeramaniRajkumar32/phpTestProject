<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->latitude) && !empty($data->longitude)) {
    $latitude1 = $data->latitude;
    $longitude1 = $data->longitude;

    $query = "SELECT * FROM branch WHERE branch_latitude='$latitude1' AND branch_longitude='$longitude1'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        $branchTable = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            http_response_code(200);
            $output['branch_id'] = $branchTable['branch_id'];
            $output['status'] = 'sucess';
            $output['message'] = 'Punch in successfully';
        } else {
            http_response_code(404);
            $output['status'] = 'fail';
            $output['message'] = 'Your not allowed to login in this geo location';
        }
    }
} else {
    http_response_code(400);
    $output['status'] = 'fail';
    $output['message'] = 'Bad Request';
}

if (count($output)) {
    echo json_encode($output);
}