<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Detail</title>
    <link rel="stylesheet" href="../map/student.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Daterangepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Moment.js -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>

    <!-- Daterangepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="../map/student.js"></script>

</head>

<body>
    <!-- Header Menu -->
    <header class="bg-light py-4">
        <div class="container">
            <!-- First Row: Logo, Title, and Limiter -->
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-4 mb-0">
                        <img src="https://media.designrush.com/agencies/14094/conversions/Dolphin-Web-Solution-Pvt.-Ltd.-logo-profile.jpg"
                            alt="Logo" class="mb-3" style="max-width: 150px;"> Student Details
                    </h1>
                </div>
                <!-- Limiter Section on the right side -->
                <div class="col-md-4 text-end">
                    <label for="limitSelect" class="form-label">Show:</label>
                    <select id="limitSelect" name="limitSelect" class="form-select d-inline-block w-auto">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">All</option>
                    </select>

                    <!-- Dark Mode Toggle -->
                    <div class="form-check form-switch d-inline-block ms-3">
                        <input class="form-check-input" type="checkbox" id="darkModeToggle">
                        <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
                    </div>
                </div>
            </div>

            <!-- Second Row: Centered Buttons -->
            <div class="row mt-4 justify-content-center">
                <div class="col-md-4 mb-3">
                    <a href="http://localhost/Student/public/" class="w-100">
                        <button class="btn btn-secondary w-100">
                            <i class="bi bi-eye bi-lg"></i> Courses Details
                        </button>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#searchForm" class="w-100">
                        <button id="filterButton" class="btn btn-info w-100">
                            <i class="bi bi-funnel-fill"></i> Filter Students
                        </button>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" id="edit-student" class="w-100">
                        <button class="btn btn-success w-100">
                            <i class="bi bi-person-plus"></i> Registration
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <!-- Filter Form -->
        <div class="filter-form">
            <h4>Filter Students</h4>
            <form name="searchForm" id="searchForm">
                <div class="row g-3">
                    <!-- First Name -->
                    <div class="col-md-4">
                        <label for="searchFirstName" class="form-label">First Name</label>
                        <input type="text" name="searchFirstName" class="form-control" placeholder="Search First Name...." id="searchFirstName">
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-4">
                        <label for="searchLastName" class="form-label">Last Name</label>
                        <input type="text" name="searchLastName" class="form-control" placeholder="Search Last Name...." id="searchLastName">
                    </div>

                    <!-- Email -->
                    <div class="col-md-4">
                        <label for="searchEmail" class="form-label">Email Address</label>
                        <input type="text" name="searchEmail" class="form-control" placeholder="Search Email Address...." id="searchEmail">
                    </div>

                    <!-- Contact Number -->
                    <div class="col-md-4">
                        <label for="searchContact" class="form-label">Contact Number</label>
                        <input type="number" name="searchContact" class="form-control" placeholder="Search Contact Number...." id="searchContact">
                    </div>

                    <!-- Gender -->
                    <div class="col-md-4">
                        <label for="searchGender" class="form-label">Gender</label>
                        <select name="searchGender" class="form-select" id="searchGender">
                            <option value="">--- Choose Gender ---</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- Course -->
                    <div class="col-md-4">
                        <label for="getAllCourse" class="form-label">Course</label>
                        <select name="searchCourse" class="form-select" id="getAllCourse">
                            <option value="">--- Choose a Course ---</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label for="searchStatus" class="form-label">Status</label>
                        <select name="searchStatus" class="form-select" id="searchStatus">
                            <option value="">--- Choose a Status ---</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>

                    <!-- Created Date -->
                    <div class="col-md-4">
                        <label for="searchCreatedDate" class="form-label">Created Date</label>
                        <select name="searchCreatedDate" class="form-select" id="searchCreatedDate">
                            <option value="">--- Choose Registration Date ---</option>
                            <option value="<?php echo date('Y-m-d'); ?>">Today</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">Yesterday</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>">7 Days Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-30 days')); ?>">One Month Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-185 days')); ?>">Six Months Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-365 days')); ?>">One Year Ago</option>
                            <option value="custom" name="daterange" id="daterangeOption">Custom Date Range</option>
                        </select>
                    </div>

                    <!-- Update Date -->
                    <div class="col-md-4">
                        <label for="searchUpdateDate" class="form-label">Update Date</label>
                        <select name="searchUpdateDate" class="form-select" id="searchUpdateDate">
                            <option value="">--- Choose Update Date ---</option>
                            <option value="<?php echo date('Y-m-d'); ?>">Today</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">Yesterday</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>">7 Days Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-30 days')); ?>">One Month Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-185 days')); ?>">Six Months Ago</option>
                            <option value="<?php echo date('Y-m-d', strtotime('-365 days')); ?>">One Year Ago</option>
                            <option value="custom" name="daterange" id="daterangeOption">Custom Date Range</option>
                        </select>
                    </div>

                    <!-- Buttons (Aligned to the Bottom) -->
                    <div class="col-md-6 d-flex align-items-end justify-content-start">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-send"></i> Submit
                        </button>
                    </div>
                    <div class="col-md-6 d-flex align-items-end justify-content-end">
                        <button type="reset" class="btn btn-secondary w-50">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container mt-4" name="selectedColume">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center align-items-center">
                <!-- Label for the number of records found -->
                <label class="me-2" for="recordCount">Records found:</label>
                <div id="recordCount" name="recordCount" class="record-count">0</div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button type="button" class="btn btn-danger mx-2 btn-lm" name="selectedDelete">
                    <i class="bi bi-trash"></i> Delete
                </button>
                <button type="button" class="btn btn-success mx-2" name="selectedCSV">
                    <i class="bi bi-download"></i> Download CSV
                </button>
                <button type="button" class="btn btn-success mx-2" name="selectedPDF">
                    <i class="bi bi-download"></i> Download PDF
                </button>
            </div>
        </div>
    </div>


    <!-- Delete Button -->


    <!-- show data for course table -->
    <div class="container-fluid px-0 my-4">
        <table id="customers" class="table table-striped table-hover table-bordered align-middle text-center w-100" name="studentDetailTable">
            <thead class="sticky-top table-primary">
                <tr>
                    <th scope="col">
                        <input type="text" class="form-control form-control-sm" placeholder="Read-only text" readonly style="width: 50px; font-size: 20px;" name="countSelected" value="0">
                        <label class="form-check-label ms-2" for="selectAll">Select All</label>
                        <input type="checkbox" name="allSelectStudent" class="form-check-input ms-2">
                    </th>
                    <th scope="col">NO
                        <div class="d-flex align-items-center justify-content-center">
                            <button data-id="s_id" data-fillter="asc" class="filler btn btn-primary btn-sm" id="s_idasc">
                                <i class="bi bi-caret-up"></i>
                            </button>
                            <button data-id="s_id" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2" id="s_iddesc">
                                <i class="bi bi-caret-down"></i>
                            </button>
                        </div>
                    </th>
                    <th scope="col">First Name
                        <div class="d-flex align-items-center justify-content-center">
                            <button data-id="firstname" data-fillter="asc" class="filler btn btn-primary btn-sm" id="firstnameasc">
                                <i class="bi bi-caret-up"></i>
                            </button>
                            <button data-id="firstname" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2" id="firstnamedesc">
                                <i class="bi bi-caret-down"></i>
                            </button>
                        </div>
                    </th>
                    <th scope="col">
                        Last Name
                        <div class="d-flex align-items-center">
                            <button data-id="lastname" data-fillter="asc" class="filler btn btn-primary btn-sm"
                                id="lastnameasc">
                                <i class="bi bi-caret-up"></i>
                            </button>
                            <button data-id="lastname" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                                id="lastnamedesc">
                                <i class="bi bi-caret-down"></i>
                            </button>
                        </div>
                    </th>

                    <th scope="col"> Email
                        <div class="d-flex align-items-center">
                            <button data-id="email" data-fillter="asc" class="filler btn btn-primary btn-sm" id="emailasc">
                                <i class="bi bi-caret-up"></i>
                            </button>
                            <button data-id="email" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                                id="emaildesc">
                                <i class="bi bi-caret-down"></i>
                            </button>
                        </div>

                    </th>

                    <th scope="col"> Gender
                        <div class="d-flex align-items-center">
                            <button data-id="gender" data-fillter="asc" class="filler btn btn-primary btn-sm"
                                id="genderasc">
                                <i class="bi bi-caret-up"></i>
                            </button>
                            <button data-id="gender" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                                id="genderdesc">
                                <i class="bi bi-caret-down"></i>
                            </button>
                        </div>

                    </th>

                    <th scope="col"> Phone Number
                    <div class="d-flex align-items-center">
                        <button data-id="phone" data-fillter="asc" class="filler btn btn-primary btn-sm" id="phoneasc">
                            <i class="bi bi-caret-up"></i>
                        </button>
                        <button data-id="phone" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                            id="phonedesc">
                            <i class="bi bi-caret-down"></i>
                        </button>
                    </div>
                    </th>

                    <th scope="col"> Status
                    <div class="d-flex align-items-center">
                        <button data-id="status" data-fillter="asc" class="filler btn btn-primary btn-sm"
                            id="statusasc">
                            <i class="bi bi-caret-up"></i>
                        </button>
                        <button data-id="status" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                            id="statusdesc">
                            <i class="bi bi-caret-down"></i>
                        </button>
                    </div>
                    </th>

                    <th scope="col">  Registration Date
                    <div class="d-flex align-items-center">
                        <button data-id="reg_date" data-fillter="asc" class="filler btn btn-primary btn-sm"
                            id="reg_dateasc">
                            <i class="bi bi-caret-up"></i>
                        </button>
                        <button data-id="reg_date" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                            id="reg_datedesc">
                            <i class="bi bi-caret-down"></i>
                        </button>
                    </div>
                    </th>

                    <th scope="col">Update Date
                    <div class="d-flex align-items-center">
                        <button data-id="updated_at" data-fillter="asc" class="filler btn btn-primary btn-sm"
                            id="updated_atasc">
                            <i class="bi bi-caret-up"></i>
                        </button>
                        <button data-id="updated_at" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                            id="updated_atdesc">
                            <i class="bi bi-caret-down"></i>
                        </button>
                    </div>
                    </th>

                    <th scope="col"> Course Name
                    <div class="d-flex align-items-center">
                        <button data-id="c.name" data-fillter="asc" class="filler btn btn-primary btn-sm"
                            id="c.nameasc">
                            <i class="bi bi-caret-up"></i>
                        </button>
                        <button data-id="c.name" data-fillter="desc" class="filler btn btn-primary btn-sm ms-2"
                            id="c.namedesc">
                            <i class="bi bi-caret-down"></i>
                        </button>
                    </div>
                    </th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="studentdata">
                <!-- Table data here -->
            </tbody>
        </table>
    </div>
    <!-- Pagination start -->
    <ul class="pagination justify-content-center" id="paginationList"></ul>
    <!-- Pagination end -->

    <!-- Limiter start -->

    <!-- limiter end  -->
    <!-- Modal for Student Detail View -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Student Details</h5>
                    <button type="button" class="btn btn-danger btn-sm" id="viewClose-modal" data-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-lg"></i></button></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td><span id="firstname"></span> <span id="lastname"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Phone number:</strong></td>
                                <td><span id="number"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Email Address:</strong></td>
                                <td><span id="emailadd"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Course name:</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span id="courseview"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span id="status"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Edit Student</h5>
                    <button type="button" class="btn btn-danger btn-sm" name="editClose" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="text-danger" name="studentFormErrorMessage"></div>
                    <div class="card-body">
                        <form id="studentForm">
                            <input type="hidden" name="id" value="" id="id">

                            <div class="row mb-3">
                                <label for="fname" class="col-sm-3 col-form-label">First Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="fname" id="fname" placeholder="Your first name..."
                                        class="form-control">
                                    <span id="efname" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lname" class="col-sm-3 col-form-label">Last Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="lname" id="lname" placeholder="Your last name..."
                                        class="form-control">
                                    <span id="elname" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" placeholder="Your email..."
                                        class="form-control">
                                    <span id="eemail" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="num" class="col-sm-3 col-form-label">Contact Number <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" name="num" id="num" placeholder="Your contact number..."
                                        class="form-control">
                                    <span id="enum" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender" class="col-sm-3 col-form-label">Gender <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                            value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="other"
                                            value="Other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                    <span id="egender" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="course" class="col-sm-3 col-form-label">Course</label>
                                <div class="col-sm-9">
                                    <select name="selectCourse" id="getAllCourse" class="form-select">
                                        <option value="">--- Choose a Course ---</option>
                                        <!-- Add course options here -->
                                    </select>
                                    <span id="ecourse" class="is-invalid"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" id="resetbutton" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Messages -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                            <p id="messege" class="fs-4 mt-3"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>