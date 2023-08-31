<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->password) && !empty($data->login_id )) {
    $password = $data->password;
    $login_id  = $data->login_id ;

    $query = "SELECT * FROM login WHERE login_id ='$login_id'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];

        if ($result->num_rows > 0) {
            $query = "UPDATE login SET password='$password' WHERE login_id  ='$login_id'";
            if ($conn->query($query)->execute() == TRUE) {
                http_response_code(200);
                $output['status'] = 'success';
                $output['message'] = 'Password Changed';
            }
        } else {
            http_response_code(404);
            $output['status'] = 'fail';
            $output['message'] = 'Password not Changed';
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
