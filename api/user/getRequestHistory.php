<?php
    ini_set('display_errors','off');
    include("../../dashboard/include/connection.php");
    $conn = new dbConnection;
    $output_array = array();

    
    echo json_encode($output_array);
?>