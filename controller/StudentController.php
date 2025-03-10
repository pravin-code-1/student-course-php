<?php
require_once "/var/www/html/Student/model/Model.php";
require_once('/var/www/html/Student/controller/MYPDF.php');


class StudentController
{
    public function __construct()
    {
        if ($_POST['fname']) {
            self::studentFormPost();
        } else if ($_GET['delete']) {
            self::deleteStudents();
        } else if ($_GET['csv']) {
            self::createCSVFile();
        } else if ($_POST['pdf']) {
            self::createPDFFile();
        } else if ($_GET['getID']) {
            self::getAllStudentID();
        } else if ($_GET['view'] || $_GET['id']) {
            $obj = new Model();
            $data = $obj->selectStudent($_GET['id']);
            echo json_encode($data);
        } elseif ($_GET['gender']) {
            self::allGenderValidation();
        } else {
            self::viewStudent();
        }
    }

    public function viewStudent()
    {
        $obj = new Model();
        $name = $_GET['name'] == '' ? 's_id' : $_GET['name'];
        $fillter = $_GET['fillter'] == '' ? 'desc' : $_GET['fillter'];
        $currentPage = (int) $_GET['page'];
        $gender = $_GET['searchGender'];
        if ($gender == "") {
            $gender = "1 = 1";
        } else {
            $gender = "s.gender = '$gender'";
        }
        $course = $_GET['searchCourse'];
        if ($course == "") {
            $course = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $course = "s.c_id = $course";
        }
        $firstName = $_GET['searchFirstName'];
        if ($firstName == "") {
            $firstName = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $firstName = "s.firstname LIKE '%$firstName%'";
        }
        $lastName = $_GET['searchLastName'];
        if ($lastName == "") {
            $lastName = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $lastName = "s.lastname LIKE '%$lastName%'";
        }
        $email = $_GET['searchEmail'];
        if ($email == "") {
            $email = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $email = "s.email LIKE '%$email%'";
        }
        $contact = $_GET['searchContact'];
        if ($contact == "") {
            $contact = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $contact = "CAST(s.phone AS CHAR) LIKE '%$contact%'";
        }
        $searchStatus = $_GET['searchStatus'];
        if ($searchStatus == "") {
            $searchStatus = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $searchStatus = "s.status = '$searchStatus'";
        }
        $searchCreatedDate = $_GET['searchCreatedDate'];
        if ($searchCreatedDate == "") {
            $searchCreatedDate = "1 = 1"; // This will always be true, so it will return all records
        } else {
            if (strpos($searchCreatedDate, ' - ') !== false) {
                $dateParts = explode(" - ", $searchCreatedDate, );
                $startDate = DateTime::createFromFormat('m/d/Y H:i:s', $dateParts[0])->format('y/m/d');
                $endDate = DateTime::createFromFormat('m/d/Y H:i:s', $dateParts[1])->format('y/m/d');
                $searchCreatedDate = "(s.reg_date BETWEEN '$startDate' AND '$endDate') ";
            } else {
                $searchCreatedDate = "(s.reg_date BETWEEN '$searchCreatedDate' AND '" . date('Y-m-d', strtotime('+1 day')) . "')";
            }
        }
        $searchUpdateDate = $_GET['searchUpdateDate'];
        if ($searchUpdateDate == "") {
            $searchUpdateDate = "1 = 1"; // This will always be true, so it will return all records
        } else {
            if (strpos($searchUpdateDate, ' - ') !== false) {
                $dateParts = explode(" - ", $searchUpdateDate, );
                $startDate = DateTime::createFromFormat('m/d/Y H:i:s', $dateParts[0])->format('y/m/d');
                $endDate = DateTime::createFromFormat('m/d/Y H:i:s', $dateParts[1])->format('y/m/d');
                $searchUpdateDate = "(s.updated_at BETWEEN '$startDate' AND '$endDate') ";
            } else {
                $searchUpdateDate = "(s.updated_at BETWEEN '$searchUpdateDate' AND '" . date('Y-m-d', strtotime('+1 day')) . "')";
            }
        }
        $limit = $_GET['limit'] > 30 ? count($obj->viewAllstudent($gender, $course, $firstName, $lastName, $email, $contact, $searchStatus, $searchCreatedDate)) : $_GET['limit'];
        $start_from = ($currentPage - 1) * $limit;
        $total_pages = ceil(count($obj->viewAllstudent($gender, $course, $firstName, $lastName, $email, $contact, $searchStatus, $searchCreatedDate)) / $limit);
        $startPage = max(1, $currentPage - 2);
        $endPage = min($total_pages, $startPage + 4);
        if ($endPage - $startPage < 4) {
            $startPage = max(1, $endPage - 4);
        }
        $studentData = $obj->viewLimitstudent($start_from, $limit, $gender, $course, $firstName, $lastName, $email, $contact, $searchStatus, $searchCreatedDate, $searchUpdateDate, $name, $fillter);
        $paginationData = [
            'currentPage' => $currentPage,
            'startPage' => $startPage,
            'endPage' => $endPage,
            'totalPages' => $total_pages,
            'gender' => $gender,
            'course' => $course
        ];
        $mergedData = array_merge($paginationData, $studentData);
        echo json_encode($studentData);
    }
    public function allGenderValidation()
    {
        $obj = new Model();
        $gender = $obj->viewAllGender();
        echo json_encode($gender);
    }
    public function studentFormPost()
    {

        $valid = 0;
        $id = $_POST["id"];
        $obj = new Model();
        $courses = $obj->viewAllcourse('c_id', 'asc', '1=1',"1 = 1");
        $view = $obj->selectStudent($id);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $num = $_POST['num'];
        $gender = $_POST['gender'];
        $c_id = $_POST['selectCourse'];
        $efname = $elanam = $eemail = $enum = "";
        $checkemail = $obj->validEmailaddress($_POST['email']);
        $checknum = $obj->validContactNumber($_POST['num']);

        if (empty($id)) {
            if ($checkemail['s_id']) {
                $eemail = 'Email address already add please add unique email';
                echo json_encode(['messages' => "$eemail", 'check' => false]);
                header('Content-Type: application/json');
            } else if ($checknum['s_id']) {
                $enum = 'Contact num already add please add unique number';
                echo json_encode(['messages' => "$enum", 'check' => false]);
                header('Content-Type: application/json');
            } else {
                self::createStudent($fname, $lname, $email, $gender, $num, $c_id);
            }
        } else if (!empty($id)) {
            if ($checknum['s_id'] == '' && $checkemail['s_id'] == '') {
                self::updateStudent($id, $fname, $lname, $email, $gender, $num, $c_id);
            } else if ($checkemail['s_id'] != $id && $checkemail['s_id'] != "") {
                $eemail = 'Email address already add please add unique email';
                echo json_encode(['messages' => "$eemail", 'check' => false]);
                header('Content-Type: application/json');
            } else if ($checknum['s_id'] != $id && $checknum['s_id'] != "") {
                $enum = 'Contact num already add please add unique number';
                echo json_encode(['messages' => "$enum", 'check' => false]);
                header('Content-Type: application/json');
            } else {
                self::updateStudent($id, $fname, $lname, $email, $gender, $num, $c_id);
            }
        }
    }
    public function createStudent($fname, $lname, $email, $gender, $num, $c_id)
    {
        $c_id = $c_id == "" ? 'null' : $c_id;
        $status = $c_id == 'null' ? 'Deactive' : 'Active';
        $obj = new Model();
        $result = $obj->registrationStudent($fname, $lname, $email, $gender, $num, $c_id, $status);
        if ($result) {
            echo json_encode(['message' => "Student $fname $lname Succesfully Registration", 'check' => true, 'page' => 1]);
            header('Content-Type: application/json');
        } else {
            echo json_encode(['message' => "invalid valid.....", 'check' => false]);
            header('Content-Type: application/json');
        }
    }

    public function updateStudent($id, $fname, $lname, $email, $gender, $num, $c_id)
    {
        $c_id = $c_id == "" ? 'null' : $c_id;
        $status = $c_id == 'null' ? 'Deactive' : 'Active';
        $obj = new Model();
        $result = $obj->updateStudentDetail($id, $fname, $lname, $email, $gender, $num, $c_id, $status);
        if ($result == 1) {
            echo json_encode(['message' => "Student $fname $lname Succesfully  Update", 'check' => true]);
            header('Content-Type: application/json');
            exit;
        } else {
            echo json_encode(['message' => "invalid valid.....", 'check' => false]);
            header('Content-Type: application/json');
        }
    }
    public function deleteStudents()
    {
        $obj = new Model();
        if (is_array($_GET['id'])) {
            foreach ($_GET['id'] as $key => $value) {
                $data = $obj->deleteStudentDetail($value);
            }
        }
        $data = $obj->deleteStudentDetail($_GET['id']);
    }
    public function createCSVFile()
    {
        $obj = new Model();
        if (is_array($_GET['id'])) {
            foreach ($_GET['id'] as $key => $value) {
                $data = $obj->selectStudent($value);
                $outputFile = '/var/www/html/Student/data/selectedStudentInsert.csv';
                if (($handle = fopen($outputFile, 'a')) !== false) {
                    fputcsv($handle, $data);
                    fclose($handle);
                }
            }
        }

        echo json_encode(['message' => $_GET['id'] . " CSV file Create", 'check' => true]);
        header('Content-Type: application/json');
    }
    public function getAllStudentID()
    {
        $obj = new Model();
        $getAllID = $obj->allStudentID();
        $getAllID = array_column($getAllID, 0);
        echo json_encode($getAllID);
    }

    //PDF Download function
    public function createPDFFile()
    {
         echo 1, exit;
        $obj = new Model();
        $data = [];
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            foreach ($_POST['id'] as $key => $value) {
                $studentData = $obj->selectStudent($value);
                if ($studentData) {
                    $data[] = $studentData;
                }
            }
        }
        $courseData = $obj->selectedStudentCourseCount($_POST['id']);


        $pdf = new MYPDF('L');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 004', PDF_HEADER_STRING);

        // $pdf->SetCreator("Pravin");
        // $pdf->SetAuthor('Dolphin web solution');
        // $pdf->SetTitle('Student');
        // $pdf->SetSubject('Student Detial');
        // $pdf->SetKeywords('Student, PDF, Selected, course');

        // $pdf->SetMargins(PDF_MARGIN_LEFT, 2, PDF_MARGIN_RIGHT);
        // $pdf->SetFont('times', '', 11);

        // // set margins
        // $pdf->SetMargins(5, 45, PDF_MARGIN_RIGHT);
        // $pdf->SetHeaderMargin(50);
        // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // // add a page
        // $pdf->AddPage();
        // $pdf->SetFillColor(255, 255, 255);
        // $pdf->SetTextColor(0);
        // $pdf->SetLineWidth(0.3);
        // $pdf->SetFont('', 'B');

        // $pdf->SetFont('helvetica', 'B', 18);
        // $pdf->Cell(0, 7, "Student Detail", 0, 1, 'C', 1);
        // $pdf->Ln();
        // $pdf->SetFont('times', 'B', 14);
        // $pdf->Cell(143, 7, "Total Number of Student:", "LRT", 0, 'L', 1);
        // $pdf->Cell(143, 7, "Dolphin Web Solution PVT. LTD.", 'LRT', 1, 'L', 1);
        // $pdf->SetFont('times', "", 14);
        // $pdf->Cell(143, 12, "Course Name", 'LR', 0, 'L', 1);
        // $pdf->MultiCell(143, 7, "Address: Empire Business Hub, B- 203-206, Science City Rd, Sola, Ahmedabad, Gujarat 380060", 'LR', "L", 1, 1, '', '', true);
        // $pdf->Cell(143, 7, "", 'LR', 0, 'L', 1);
        // $pdf->Cell(143, 7, "", 'LR', 1, 'L', 1);
        // $pdf->Cell(143, 7, "", 'LR', 0, 'L', 1);
        // $pdf->Cell(143, 7, 'Dolphin Web site', "LR", 1, 'R', 0, 'https://dolphinwebsolution.com/', 0);
        // $pdf->Cell(286, 0, '', 'T');
        // $pdf->Ln();
        // $pdf->Ln();

        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        $header = array('NO', 'Name', 'Email', 'Phone Number', 'Course', 'Gender', 'Status');
        // print colored table
        // $pdf->ColoredTable($header, $data);
        // $pdf->Cell(286, 0, "", 'T');


        ob_clean(); // Clean output buffer
        // // Set appropriate headers for PDF
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="Student_.pdf"');
        $pdf->Output('Student_.pdf', 'I');
        ob_end_flush(); // Flush the output buffer


    }
}
if ($_SERVER['REQUEST_METHOD']) {
    $con_obj = new StudentController();
}

?>
