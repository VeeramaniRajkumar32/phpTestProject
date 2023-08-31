<?php
    include('../include/connection.php');
    $conn = new dbConnection;
    
    if(!empty($_POST['category_id']) ){
        $category_id = $_POST['category_id'];
        $category_status = 0;

        $query = "SELECT * FROM category WHERE category_id='$category_id'";
        $sql = $conn->query($query)->execute();  
        if($sql['status']){ 
            $result =$sql['body'];
            $categoryTable = $result->fetch_assoc();
            
            if($categoryTable['category_status'] == 0){
                $category_status = 1;
            }
            $query1 =  "UPDATE category SET category_status='$category_status' WHERE category_id='$category_id'";
            $sql1 = $conn->query($query1)->execute();  
            if($sql1['status']){ 
                echo 'true';
            }
        }
    }
?>