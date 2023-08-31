<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection_oops.php");
$conn = new dbConnection;
$output = array();

$query = "SELECT * FROM user";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    if ($result->num_rows > 0) {
        $i = 0;
        while ($userTable = $result->fetch_assoc()) {
            $designation_id = $userTable['designation_id'];
            
            $query1 = "SELECT * FROM designation WHERE designation_id='$designation_id'";
            $sql1 = $conn->query($query1)->execute();
            if ($sql['status']) {
                $result1 = $sql1['body'];
                $designationTable = $result1->fetch_assoc();

                $output['GTS'][$i]['id'] = $userTable['user_id'];
                $output['GTS'][$i]['employeId'] = $userTable['employee_id'];
                $output['GTS'][$i]['userName'] = $userTable['user_name'];
                $output['GTS'][$i]['designation'] = $designationTable['designation_name'];
                $output['GTS'][$i]['image'] = $userTable['user_image'];
                $i++;
            }
            http_response_code(200);
            $output['status'] = 'success';
            $output['message'] = 'Ok';
        }
    }
} else {
    http_response_code(404);
    $output['status'] = 'fail';
    $output['message'] = 'Employee not found';
}

if (count($output)) {
    echo json_encode($output);
}
