<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));
if (!empty($data->user_id)) {
    $user_id = $data->user_id;

    $query = "SELECT * FROM request_permission WHERE user_id='$user_id'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $query1 = "DELETE FROM request_permission WHERE user_id='$user_id'";
            if ($conn->query($query1)->execute() === TRUE) {
                http_response_code(200);
                $output['status'] = 'success';
                $output['message'] = 'OK';
            } 
        }
    } else {
        http_response_code(404);
        $output['status'] = 'fail';
    }
} else {
    http_response_code(400);
    $output['status'] = 'fail';
}

if (count($output)) {
    echo json_encode($output);
}
?>