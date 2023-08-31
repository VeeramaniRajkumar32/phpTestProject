<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$query = "SELECT * FROM user";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    if ($result->num_rows > 0) {
        $i = 0;
        while ($userTable = $result->fetch_assoc()) {
            
            $query1 = "SELECT * FROM personal ";
            $sql1 = $conn->query($query1)->execute();
            if ($sql['status']) {
                $result1 = $sql1['body'];
                $PersonalDetailTable = $result1->fetch_assoc();

                $output['GTS'][$i]['employeeId'] = $userTable['employee_id'];
                $output['GTS'][$i]['dateOfJoining'] = $userTable['user_doj'];
                $output['GTS'][$i]['grade'] = $userTable['user_name'];
                $output['GTS'][$i]['Experience'] = $PersonalDetailTable['experience'];
                $output['GTS'][$i]['dateOfBirth'] = $PersonalDetailTable['DOB'];
                $output['GTS'][$i]['bloodGroup'] = $PersonalDetailTable['blood_group'];
                $output['GTS'][$i]['phoneNumber'] = $userTable['user_phone_number'];
                $output['GTS'][$i]['email'] = $userTable['office_email'];
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
