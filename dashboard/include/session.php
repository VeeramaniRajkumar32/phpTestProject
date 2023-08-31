<?php
    session_start();
    $session_id = $_SESSION['login_id'];

    $control_id = 0;

    $query = "SELECT * FROM login WHERE login_id='$session_id'";
    $sql = $conn->query($query)->execute();
    if($sql['status']){
        $result = $sql['body'];
        $loginTable = $result->fetch_assoc();
        $control_id = $loginTable['control'];
    }
?>