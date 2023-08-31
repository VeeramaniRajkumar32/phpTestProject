<?php
    class dbConnection {
        function __construct(){
            $this->host = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->db_name = "test";
 
            $this->query = '';
 
            $this->conn = mysqli_connect("$this->host", "$this->username", "$this->password")or die("cannot connect"); 
            mysqli_select_db($this->conn,"$this->db_name")or die("cannot select DB");
        }
 
        public function query($query){
            $this->query = $query;
            return $this;
        }
 
        public function execute(){
            $response = array();
            try{
                $result = $this->conn->query($this->query);
                if($result){
                    $response['status'] = true;
                    $response['body'] = $result;
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Invalid';
                }
            }catch(Exception $e) {
                    $response['status'] = false;
                    $response['message'] = $e->getMessage();
            }
            return $response;
        }
        function __destruct(){
            $this->conn->close();
        }
    }
?>