<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;
$output = $meeting = $event = $holiday = array();

$query = "SELECT * FROM event";
$sql = $conn->query($query)->execute();
if ($sql['status']) {
    $result = $sql['body'];
    if ($result->num_rows > 0) {
        $i = 0;
        while ($eventTable = $result->fetch_assoc()) {

            $event[$i]['id'] = $eventTable['event_id'];
            $event[$i]['name'] = $eventTable['event_tiltle'];
            $event[$i]['image'] = $eventTable['event_image'];
            $event[$i]['descrption'] = $eventTable['starting_time'];
            $i++;
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

            $holidays[$i]['id'] = $holidaysTable['holidays_id'];
            $holidays[$i]['name'] = $holidaysTable['holidays_name'];
            $holidays[$i]['date'] = $holidaysTable['holidays_date'];
            $holidays[$i]['day'] = $holidaysTable['holidays_day'];
            $i++;
        }
    }
}
$output['event'] = $event;
$output['holidays'] = $holidays;

$output['status'] = "Success";
$output['message'] = 'Ok';

$output1['GTS']=$output;

if (count($output)) {
    echo json_encode($output1);
}
