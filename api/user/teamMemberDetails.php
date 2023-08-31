<?php
    ini_set('display_errors','off');
    include("../../dashboard/include/connection.php");
    $conn = new dbConnection;
    $output_array = array();

    $data = json_decode(file_get_contents('php://input'));
 
    /*
     step 1: Check Whether the employee is registed or check employee table empty or not.
     step 1: Employee Id
     step 2: find which department/team the specific employee belongs to
     step 3: display all other colleagues  of team members of that team
    */

    if(!empty($data->employeeId)){
        $employeeId = $data->employeeId;
    
                $query1="SELECT * FROM user WHERE department ='$department_id' AND employee_id!='$employeeId'";
                $sql1= $conn->query($query1)->execute();
                if($sql1['status']){
                    $result1=$sql1['body'];
                    $i=0;
                    while($userTable=$result1->fetch_assoc()){
                        $user_id= $userTable['user_id'];
                        // $output_array['GTS'][$i]['empId']=$userTable['employee_id'];
                        $output_array['GTS'][$i]['id']=$userTable['user_id'];
                        $output_array['GTS'][$i]['image']='dashboard/'.$userTable['photoImage'];
                        $output_array['GTS'][$i]['status']=$attendanceStatus;
                        $i++;
                    }
                    http_response_code(200);
                    $output_array['status']='success';
                    $output_array['message']='Ok';
                }
            } else{
                http_response_code(404);
                $output_array['status']='fail';
                $output_array['message']='Employee not found';
            }
      
  

echo json_encode($output_array);
?>