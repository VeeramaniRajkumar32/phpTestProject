<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();
$this_year = date('Y');
$today = date('Y-m-d');

$query = "SELECT * FROM personal";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    if ($result->num_rows > 0) {
        $i = 0;
        while ($PersonalDetailTable = $result->fetch_assoc()) {
            $user_id = $PersonalDetailTable['user_id'];
            $check_birthday_date = date($this_year.'-m-d', strtotime($PersonalDetailTable['DOB']));

            if($today == $check_birthday_date){
                $query1 = "SELECT * FROM user";
                $sql1 = $conn->query($query1)->execute();
                if ($sql['status']) {
                    $result1 = $sql1['body'];
                    $userTable = $result1->fetch_assoc();
    
                    $output['GTS'][$i]['id'] = (int)$PersonalDetailTable['id'];
                    $output['GTS'][$i]['name'] = $PersonalDetailTable['emp_first'] . $PersonalDetailTable['emp_last'];
                    $output['GTS'][$i]['photo'] = $userTable['user_image'];
                    $output['GTS'][$i]['date_of_birth'] = $PersonalDetailTable['DOB'];
                    $output['GTS'][$i]['birth_date'] = date('d', strtotime($PersonalDetailTable['DOB']));
                    $output['GTS'][$i]['birth_month'] = date('M', strtotime($PersonalDetailTable['DOB']));
    
                    $i++;
                }
            }
        }
        http_response_code(200);
        $output['status'] = 'success';
        $output['message'] = 'Ok';
    }else{
        http_response_code(404);
        $output['status'] = 'fail';
        $output['message'] = 'not found';
    }
} else {
    http_response_code(404);
    $output['status'] = 'fail';
    $output['message'] = 'not found';
}

if (count($output)) {
    echo json_encode($output);
}
