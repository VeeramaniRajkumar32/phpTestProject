<?php
ini_set('display_errors', 'off');
include("../../dashboard/include/connection.php");
$conn = new dbConnection;

$output = array();
$data = json_decode(file_get_contents('php://input'));

//   type1 => Single Team(all)
//   type2 => Single Team(members)
//   type3 => Multiple Teams(all)
//   type4 => Multiple Teams(members)


if (!empty($data->team_type)) {
    $team_type = $data->team_type;
    if ($team_type == 1) {
        $query = "SELECT * FROM meeting WHERE team_type='$team_type'";
    } else if ($team_type == 2) {
        $query = "SELECT * FROM meeting WHERE team_type='$team_type'";
    } else if ($team_type == 3) {
        $query = "SELECT * FROM meeting WHERE team_type='$team_type'";
    } else if ($team_type == 4) {
        $query = "SELECT * FROM meeting WHERE team_type='$team_type'";
    }
    $sql = $conn->query($query)->execute();
    if ($sql['status']) {
        $result = $sql['body'];
        if ($result->num_rows > 0) {
            $i = 0;
            while ($meetingTable = $result->fetch_assoc()) {

                $output['GTS'][$i]['meeting_id'] = $meetingTable['meeting_id'];
                $output['GTS'][$i]['starting_time'] = $meetingTable['starting_time'];
                $output['GTS'][$i]['meeting_date'] = $meetingTable['meeting_date'];
                $output['GTS'][$i]['meeting_type'] = $meetingTable['meeting_type'];
                $output['GTS'][$i]['meeting_heading'] = $meetingTable['meeting_heading'];
                $output['GTS'][$i]['meeting_link'] = $meetingTable['meeting_link'];

                $i++;
            }

            http_response_code(200);
            $output['status'] = 'success';
            $output['message'] = 'Ok';
        } else {
            http_response_code(404);
            $output['status'] = 'fail';
            $output['message'] = 'not detail found';
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
