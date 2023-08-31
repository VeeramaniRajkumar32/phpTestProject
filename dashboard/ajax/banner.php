<?php
    include('../include/connection.php');
    $conn = new dbConnection;

    $output = array();
    if(!empty($_POST['radioValue']) && !empty($_POST['rotary'])){
        $radioValue = $_POST['radioValue'];
        $rotary = $_POST['rotary'];

        $i = 0;
        if($radioValue == 1){
            $query = "SELECT * FROM projects WHERE rotary_club_id='$rotary'";
            $sql = $conn->query($query)->execute();
            if($sql['status']){
                $result = $sql['body'];
                while($row = $result->fetch_assoc()){
                    $output['banner'][$i]['id'] = $row['id'];
                    $output['banner'][$i]['title'] = $row['projects_title'];

                    $i++;
                }
                $output['status'] = TRUE;
            }
        } else{
            $query = "SELECT * FROM events_news WHERE rotary_club_id='$rotary'";
            $sql = $conn->query($query)->execute();
            if($sql['status']){
                $result = $sql['body'];
                while($row = $result->fetch_assoc()){
                    $output['banner'][$i]['id'] = $row['id'];
                    $output['banner'][$i]['title'] = $row['title'];

                    $i++;
                }
                $output['status'] = TRUE;
            }
        }
    }

    echo json_encode($output);
?>