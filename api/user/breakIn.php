<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->latitude) && !empty($data->longitude)) {
    $latitude = $data->latitude;
    $longitude = $data->longitude;

    $query = "SELECT * FROM branch WHERE branch_latitude='$latitude' AND branch_longitude='$longitude'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];

        if ($result->num_rows > 0) {
            http_response_code(200);
            $output['status'] = 'sucess';
            $output['message'] = 'Break in successfully';
        } else {
            http_response_code(404);
            $output['status'] = 'fail';
            $output['message'] = 'Your not allowed to Break in this geo location';
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
