<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = array();

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->employeId) && !empty($data->date)) {
    $employeId1 = $data->employeId;
    $date1 = $data->date;

    $query = "SELECT * FROM attendance WHERE employee_id='$employeId1' AND date='$date1'";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                    $output['GTS'][$i]['id'] = (int)$row['employee_id'];
                    $output['GTS'][$i]['date'] = $row['date'];
                    $output['GTS'][$i]['time_in'] = $row['time_in'];
                    $output['GTS'][$i]['time_out'] = $row['time_out'];
                    $i++;
                }
                http_response_code(200);
                $output['status'] = 'success';
                $output['message'] = 'Ok';
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
