<?php 
    ini_set('display_errors', 'off');

    $host = "localhost";
	$username = "root";
	$password = "";
	$db_name = "test";
	$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
	mysqli_select_db($conn,"$db_name")or die("cannot select DB");
?>