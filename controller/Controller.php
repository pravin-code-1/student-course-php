<?php
require_once "/var/www/html/Student/model/Model.php";


if ($_SERVER['REQUEST_METHOD']) {
    $con_obj = new Controller();
}

class Controller
{
    public $massage;
    public function __construct()
    {
        if ($_POST['cname'] || $_POST['update']) {
            self::courseValidation();
        } else if ($_GET['delete']) {
            self::delete_course();
        } else if ($_GET['csv']) {
            self::createCSVFile();
        } else if ($_GET['id']) {
            $obj = new Model();
            $data = $obj->selectCourse($_GET['id']);
            echo json_encode($data);
        }
        else if($_GET['course']){
            $obj = new Model();
            $data = $obj->viewAllcourse('c_id', 'asc', '1=1', '1=1');
            echo json_encode($data);
        } else {
            self::viewCourse();
        }
    }
    //This function show all course details
    public function viewCourse()
    {
        $obj = new Model();
        $name = $_GET['name'] == '' ? 'c_id' : $_GET['name'];
        $fillter = $_GET['fillter'] == '' ? 'desc' : $_GET['fillter'];
        $currentPage = (int) $_GET['page'];
        $course = $_GET['searchCourse'];
        if ($course == "") {
            $course = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $course = "name = '$course'";
        }
        $discription = $_GET['searchDiscription'];
        if ($discription == "") {
            $discription = "1 = 1"; // This will always be true, so it will return all records
        } else {
            $discription = "discription LIKE '%$discription%'";
        }
        $limit = $_GET['limit'] > 30 ? count($obj->viewAllcourse($name, $fillter, $course,$discription)) : $_GET['limit'];
        $start_from = ($currentPage - 1) * $limit;
        $total_pages = ceil(count($obj->viewAllcourse($name, $fillter, $course, $discription)) / $limit);
        $startPage = max(1, $currentPage - 2);
        $endPage = min($total_pages, $startPage + 4);
        if ($endPage - $startPage < 4) {
            $startPage = max(1, $endPage - 4);
        }
        
        $courseData = $obj->viewSelectedCourse($start_from, $limit, $name, $fillter,$course, $discription);
        $paginationData = [
            'currentPage' => $currentPage,
            'startPage' => $startPage,
            'endPage' => $endPage,
            'totalPages' => $total_pages,
        ];
        $mergedData = array_merge($paginationData, $courseData);
        echo json_encode($mergedData);
    }

    public function courseValidation()
    {
        $id = $_POST["id"];
        $obj = new Model();
        $view = $obj->selectCourse($id);
        if ($_POST["cname"]) {
            $cname = $_POST['cname'];
            $discri = $_POST['discri'];
            if (empty($id)) {
                self::add_course($cname, $discri);
                exit;
            } elseif (!empty($id)) {
                self::updataCourseController($id, $cname, $discri);
                exit;
            }
        }
        include_once "/var/www/html/Student/view/update.php";
    }
    //This function use to add course details
    public function add_course($cname, $discri)
    {
        $obj = new Model();
        $check = $obj->insertCourse($cname, $discri);
        if ($check == 1) {
            echo json_encode(['message' => "Successfull , $cname and $discri  has been inserting.", 'check' => true]);
            header('Content-Type: application/json');
        } else {
            echo json_encode(['message' => "$cname and $discri is already addd \n please enter unique course name", 'check' => false]);
            header('Content-Type: application/json');
        }
    }

    //This function use to Update course detail
    public function updataCourseController($id, $cname, $discri)
    {
        $obj = new Model();
        $check = $obj->updateCourse($id, $cname, $discri);
        if ($check == 1) {
            echo json_encode(['message' => "Course name  $cname has been Update.", 'check' => true]);
            header('Content-Type: application/json');
        } else {
            echo json_encode(['message' => "$cname and $discri is already addd \n please enter unique course name", 'check' => false]);
            header('Content-Type: application/json');
        }
    }
    public function delete_course()
    {
        $obj = new Model();
        if (is_array($_GET['id'])) {
            foreach ($_GET['id'] as $key => $value) {
                $view = $obj->deleteCourse($value);
            }
        }
        $data = $obj->deleteCourse($_GET['id']);
    }
    public function createCSVFile()
    {
        $obj = new Model();
        if (is_array($_GET['id'])) {
            foreach ($_GET['id'] as $key => $value) {
                $data = $obj->selectStudent($value);
                $outputFile = '/var/www/html/Student/data/selectedCourseInsert.csv';
                if (($handle = fopen($outputFile, 'a')) !== false) {
                    fputcsv($handle, $data);
                    fclose($handle);
                }
            }
        }

        echo json_encode(['message' => $_GET['id'] . " CSV file Create", 'check' => true]);
        header('Content-Type: application/json');
    }
}

?>