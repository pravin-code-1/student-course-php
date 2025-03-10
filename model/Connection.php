<?php 
    class Connection{
        private $db = "Student";
        private $host = "localhost";
        private $username = "root";
        private $password = "Admin@123";

        public function connection(){
            $conn = new mysqli($this->host, $this->username, $this->password, $this->db);

            // Check connection
            if ($conn->connect_error) {
                
                return "Connection failed: " . $conn->connect_error;
            }else{
       
            return $conn;
            }
        }
    }


?>