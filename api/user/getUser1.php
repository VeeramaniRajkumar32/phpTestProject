<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$query = "SELECT * FROM user";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    $i = 0;
    while ($userTable = $result->fetch_assoc()) {
        $position_id = $userTable['position_id'];

        $query1 = "SELECT position_name FROM position WHERE position_id='$position_id'";
        $sql1 = $conn->query($query1)->execute();
        while ($userTable1 = $sql1->fetch_assoc()) {


            $position_name = $userTable1['position_name'];
        }

        $output['GTS'][$i]['id'] = $userTable['user_id'];
        $output['GTS'][$i]['employeId'] = $userTable['employee_id'];
        $output['GTS'][$i]['userName'] = $userTable['user_name'];
        $output['GTS'][$i]['designation'] = $userTable1['position_name'];
        $output['GTS'][$i]['image'] = $userTable['photoImage'];

        $i++;
    }

    http_response_code(200);
    $output['status'] = 'success';
    $output['message'] = 'Ok';
} else {
    http_response_code(404);
    $output['status'] = 'fail';
    $output['message'] = 'Employee not found';
}

if (count($output)) {
    echo json_encode($output);
}
