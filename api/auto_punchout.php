<?php
include("../inc/dbconn.php");
include("fcm.php");
date_default_timezone_set("Asia/Calcutta");
$time = date('H:i');
$today = date('Y-m-d');
$week_of = date('D', strtotime($today));

$output_array = array();
$data = json_decode(file_get_contents('php://input'));

$sql = "SELECT * FROM holiday";
$holiday = array();
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        array_push($holiday, $row['date']);
    }
}
if (!in_array($today, $holiday)) {
    switch ($time) {

        case '22:30':
            $sql = "SELECT * FROM employee WHERE shift='2' AND week_off!='$week_of' AND estatus='Active' AND location!='Qatar'";
            break;

        default:
            $sql = "SELECT * FROM employee WHERE id='491'";
    }

    if ($sql != '') {
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];

            $sql1 = "SELECT * FROM attendance WHERE userid='$id' AND outtime is null";
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {

                $row = $result1->fetch_assoc();

                $attendance_id = $row['id'];
                $in_time = $row['intime'];
                $attend_date = $row['date'];
                $user_id = $row['userid'];
                $time = date("H:i:s");
                $date = date('Y-m-d');

                if ($attend_date == $date) {
                    $in_time_array    = explode(':', $in_time);
                    $intime_minutes = ($in_time_array[0] * 60.0 + $in_time_array[1] * 1.0);

                    $out_time_array    = explode(':', $time);
                    $out_minutes = ($out_time_array[0] * 60.0 + $out_time_array[1] * 1.0);

                    $dura = $out_minutes - $intime_minutes;
                } else {
                    $in_time_array    = explode(':', $in_time);
                    $intime_minutes = ($in_time_array[0] * 60.0 + $in_time_array[1] * 1.0);

                    $out_time_array    = explode(':', "24:00:00");
                    $out_minutes = ($out_time_array[0] * 60.0 + $out_time_array[1] * 1.0);

                    $out_time_array2    = explode(':', $time);
                    $out_minutes2 = ($out_time_array2[0] * 60.0 + $out_time_array2[1] * 1.0);

                    $dura = ($out_minutes - $intime_minutes) + $out_minutes2;
                }

                $attendance_status = 0;

                if ($dura >= 240 && $dura < 480) {
                    $attendance_status = 0.5;
                } else {
                    if ($dura >= 480) {
                        if ($half_day_status == 0) {
                            $attendance_status = 1;
                        } else {
                            $attendance_status = 0.5;
                        }
                    }
                }
                $dura = intdiv($dura, 60) . ':' . ($dura % 60);

                $sql4 = "UPDATE attendance SET outtime='$time',outtime_date='$date',working_hrs='$dura',attendance_status='$attendance_status',auto_punchout='1' WHERE userid='$user_id' AND date='$attend_date'";
                $conn->query($sql4);
            }
        }
    }
}
