<?php 
    include('include/connection.php');
    $conn = new dbConnection;
    $id = $_REQUEST['id'];

    $query= "DELETE FROM personal WHERE id = '$id'";
    $sql=$conn->query($query)->execute(); 
    if($sql['status']){  
        header('Location: all-detail.php?msg=Category Deleted');
    }
?>

