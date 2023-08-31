<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->username) && !empty($data->password)) {
    $username1 = $data->username;
    $password1 = $data->password;

    $query = "SELECT * FROM login WHERE username='$username1' AND password='$password1'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        $loginTable = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            http_response_code(200);
            $output['login_id'] = $loginTable['login_id'];
            $output['status'] = 'sucess';
            $output['message'] = 'Login successfully';
        } else {
            http_response_code(404);
            $output['status'] = 'fail';
            $output['message'] = 'Login Failed';
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
