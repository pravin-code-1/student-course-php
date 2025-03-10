<?php
require_once "/var/www/html/Student/model/Connection.php";
class Model
{
    private $conn;
    public function __construct()
    {
        $db = new Connection();
        $this->conn = $db->connection();
    }
    public function viewAllcourse($name, $fillter, $course, $discription)
    {
        $sql = "SELECT * FROM courses where $course AND $discription ORDER BY $name $fillter"; 
        $result = $this->conn->query($sql);
        //$fieldinfo = $result -> fetch_fields();
        return $result->fetch_all();


    }
    public function viewSelectedCourse($start_from, $limit, $name, $fillter, $course, $discription)
    {
        $sql = "SELECT * FROM courses where $course AND $discription ORDER BY $name $fillter LIMIT $start_from , $limit";
        $result = $this->conn->query($sql);
        //$fieldinfo = $result -> fetch_fields();
        return $result->fetch_all();


    }
    public function selectCourse($id)
    {
        $sql = "SELECT * FROM courses where c_id=$id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return 0;
        }

    }
    public function insertCourse($cname, $discri)
    {
        try {
            $sql = "INSERT INTO courses( name, discription) VALUES ('$cname','$discri')";
            if (!$this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }

            return 1;
        } catch (Exception $e) {
            return "This Course Name already added.....";
        }
    }

    public function updateCourse($id, $cname, $discri)
    {
        try {
            $sql = "UPDATE courses SET name='$cname', discription='$discri' WHERE c_id=$id";
            if (!$this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }

            return 1;
        } catch (Exception $e) {
            return "This Course Name already added.....";
        }
    }

    public function deleteCourse($id)
    {
        $sql = "DELETE FROM courses WHERE c_id=$id";
        $sql2 = "UPDATE `Student_detial` SET `status`='Deactive' WHERE c_id=$id;";
        $this->conn->query($sql2);
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    //this function headle all student table data

    public function viewAllstudent($gender, $course, $firstName, $lastName, $email, $contact, $searchStatus, $searchCreatedDate)
    {
        try {
            $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id WHERE $gender  and  $course AND $firstName AND $lastName AND $email AND $contact AND $searchStatus AND $searchCreatedDate";

            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }
    public function viewLimitstudent($start_from, $limit, $gender, $course, $firstName, $lastName, $email, $contact, $searchStatus, $searchCreatedDate, $searchUpdateDate, $name, $fillter)
    {
        $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id WHERE $gender  and  $course AND $firstName AND $lastName AND $email AND $contact AND $searchStatus AND $searchCreatedDate AND $searchUpdateDate ORDER BY $name $fillter LIMIT $start_from , $limit";
        // echo $sql, exit;
        try {
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }

            return $result->fetch_all();
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }
    public function viewAllGender()
    {
        try {
            $sql = "SELECT s.gender FROM Student_detial as s  GROUP BY s.gender";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }

    public function viewGenderStudent($start_from, $limit, $gender, $check)
    {
        $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s.gender='$gender' LIMIT $start_from , $limit";
        try {
            if ($check) {
                if (!$result = $this->conn->query($sql)) {
                    throw new Exception("Query failed: " . $this->conn->error);
                }
                return $result->fetch_all();

            } else {
                $sql = "SELECT COUNT(*) FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s.gender='$gender'";
                if (!$result = $this->conn->query($sql)) {
                    throw new Exception("Query failed: " . $this->conn->error);
                }
                return $result->fetch_row()[0];

            }
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }
    public function viewCourseStudent($start_from, $limit, $c_id, $check)
    {
        try {
            if ($check) {
                $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where c.c_id='$c_id' LIMIT $start_from , $limit";

                if (!$result = $this->conn->query($sql)) {
                    throw new Exception("Query failed: " . $this->conn->error);
                }
                return $result->fetch_all();
            } else {
                $sql = "SELECT COUNT(*) FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where c.c_id='$c_id'";
                if (!$result = $this->conn->query($sql)) {
                    throw new Exception("Query failed: " . $this->conn->error);
                }
                return $result->fetch_row()[0];
            }
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }

    public function viewBothStudent($start_from, $limit, $gender, $c_id, $check)
    {
        $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s.gender='$gender' and s.c_id=$c_id LIMIT $start_from , $limit";
        try {
            if ($check) {
                if (!$result = $this->conn->query($sql)) {
                    //throw new Exception("Query failed: " . $this->conn->error);
                }
                return $result->fetch_all();
            } else {
                $sql = "SELECT COUNT(*) FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s.gender='$gender' and s.c_id=$c_id";
                if (!$result = $this->conn->query($sql)) {
                    //throw new Exception("Query failed: " . $this->conn->error);
                }

                return $result->fetch_row()[0];
            }
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }

    public function viewCourseGroupGender($gender)
    {
        try {
            $sql = "SELECT c.c_id,c.name FROM Student_detial as s RIGHT JOIN courses as c ON s.c_id=c.c_id where s.gender='$gender' GROUP BY c.name";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Error" . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function viewGenderGroupCourse($course)
    {
        try {
            $sql = "SELECT s.gender FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where c.c_id=$course GROUP BY s.gender";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Error" . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function selectStudent($id)
    {
        $sql = "SELECT s.*, c.name FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s_id=$id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public function countStudent()
    {
        try {
            $sql = "SELECT COUNT(*) FROM Student_detial";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Error" . $this->conn->error);
            }
            return $result->fetch_row()[0];
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function registrationStudent($fname, $lname, $email, $gender, $num, $c_id, $status)
    {
        try {
            $sql = "INSERT INTO Student_detial( firstname, lastname, email, gender, phone, c_id, `status` ) VALUES ('$fname','$lname','$email','$gender',$num,$c_id, '$status' );";

            if (!$this->conn->query($sql)) {
                throw new Exception("Query failed: " . $this->conn->error);
            }
            return 1;
        } catch (Exception $e) {
            // Error handling
            return "Error: " . $e->getMessage();
        }
    }
    public function validEmailaddress($email)
    {
        try {
            $sql = "SELECT s_id FROM `Student_detial` WHERE email='$email';";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();

        } catch (Exception $e) {
            // Error handling
            return false;
        }
    }
    public function validContactNumber($num)
    {
        try {
            $sql = "SELECT s_id FROM `Student_detial` WHERE phone=$num;";
            $result = $this->conn->query($sql);
            return $result->fetch_assoc();

        } catch (Exception $e) {
            // Error handling
            return false;
        }
    }

    public function updateStudentDetail($id, $fname, $lname, $email, $gender, $num, $c_id, $status)
    {
        $sql = "UPDATE Student_detial SET firstname='$fname', lastname='$lname', email='$email', gender='$gender', phone=$num, c_id=$c_id, `status`='$status'  WHERE s_id=$id";
        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    public function deleteStudentDetail($id)
    {
        $sql = "DELETE FROM Student_detial WHERE s_id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
    public function allStudentID()
    {
        try {
            $sql = "SELECT s_id FROM Student_detial";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Error" . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function selectedStudentCourseCount($id){
        try {
            $sql = "SELECT c.name, COUNT(c.name) as totale  FROM Student_detial as s LEFT JOIN courses as c ON s.c_id=c.c_id where s.s_id IN (".join(",",$id). ") GROUP by c.name";
            if (!$result = $this->conn->query($sql)) {
                throw new Exception("Error" . $this->conn->error);
            }
            return $result->fetch_all();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

}


?>
