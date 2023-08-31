<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = $meeting = $event = $holiday = $birthday = array();
$this_year = date('Y');

$data = json_decode(file_get_contents('php://input'));

if (!empty($data->date)) {
    $date = $data->date;

    $query = "SELECT * FROM event";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $i = 0;
            while ($eventTable = $result->fetch_assoc()) {

                $check_birthday_date = date($this_year . '-m-d', strtotime($eventTable['event_date']));

                if ($date == $check_birthday_date) {

                    $event[$i]['id'] = $eventTable['event_id'];
                    $event[$i]['name'] = $eventTable['event_tiltle'];
                    $event[$i]['image'] = $eventTable['event_image'];
                    $event[$i]['date'] = $eventTable['event_date'];
                    $i++;
                }
            }
        }
    }
    $query = "SELECT * FROM holidays";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $i = 0;
            while ($holidaysTable = $result->fetch_assoc()) {

                $check_birthday_date = date($this_year . '-m-d', strtotime($holidaysTable['holidays_date']));

                if ($date == $check_birthday_date) {

                    $holidays[$i]['id'] = $holidaysTable['holidays_id'];
                    $holidays[$i]['name'] = $holidaysTable['holidays_name'];
                    $holidays[$i]['date'] = $holidaysTable['holidays_date'];
                    $holidays[$i]['day'] = $holidaysTable['holidays_day'];
                    $i++;
                }
            }
        }
    }
    $query = "SELECT * FROM personal";
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $i = 0;
            while ($PersonalDetailTable = $result->fetch_assoc()) {
                $user_id = $PersonalDetailTable['user_id'];
                $check_birthday_date = date($this_year . '-m-d', strtotime($PersonalDetailTable['DOB']));

                if ($date == $check_birthday_date) {
                    $query1 = "SELECT * FROM user";
                    $sql1 = $conn->query($query1)->execute();
                    if ($sql['status']) {
                        $result1 = $sql1['body'];
                        $userTable = $result1->fetch_assoc();

                        $birthday[$i]['id'] = (int)$PersonalDetailTable['id'];
                        $birthday[$i]['name'] = $PersonalDetailTable['emp_first'] . $PersonalDetailTable['emp_last'];
                        $birthday[$i]['photo'] = $userTable['user_image'];
                        $birthday[$i]['date_of_birth'] = $PersonalDetailTable['DOB'];
                        $birthday[$i]['birth_date'] = date('d', strtotime($PersonalDetailTable['DOB']));
                        $birthday[$i]['birth_month'] = date('M', strtotime($PersonalDetailTable['DOB']));

                        $i++;
                    }
                }
            }
        }
    }

    $output['event'] = $event;
    $output['holidays'] = $holidays;
    $output['birthday'] = $birthday;
    
    $output['status'] = "Success";
    $output['message'] = 'Ok';

    $output1['GTS']=$output;
} else {
    http_response_code(400);
    $output['status'] = 'fail';
    $output['message'] = 'Bad Request';
}

if (count($output)) {
    echo json_encode($output1);
}
