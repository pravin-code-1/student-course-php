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

    <script src="../map/course.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</head>

<body>
    <header class="bg-light py-4">
        <div class="container">
            <!-- First Row: Logo, Title, and Limiter -->
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-4 mb-0">
                        <img src="https://media.designrush.com/agencies/14094/conversions/Dolphin-Web-Solution-Pvt.-Ltd.-logo-profile.jpg"
                            alt="Logo" class="mb-3" style="max-width: 150px;"> Course Details
                    </h1>
                </div>
                <!-- Limiter Section on the right side -->
                <div class="col-md-4 text-end">
                    <label for="limitSelect" class="form-label">Show:</label>
                    <select id="limitSelect" name="limitSelect" class="form-select d-inline-block w-auto">
                        <option value="5">5</option>
                        <option value="7">7</option>
                        <option value="10">10</option>
                        <option value="40">All</option>
                    </select>
                </div>
            </div>

            <!-- Second Row: Centered Buttons -->
            <div class="row mt-4 justify-content-center">
                <div class="col-md-4 mb-3">
                    <a href="http://localhost/Student/view/student.php" class="w-100">
                        <button class="btn btn-secondary w-100">
                            <i class="bi bi-eye bi-lg"></i> Student Details
                        </button>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#searchForm" class="w-100">
                        <button id="filterButton" class="btn btn-info w-100">
                            <i class="bi bi-funnel-fill"></i> Filter Courses
                        </button>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" id="edit-student" class="w-100">
                        <button class="btn btn-success w-100" name="editCourse">
                            <i class="bi bi-plus-circle-fill"></i> Insert Course
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <!-- Filter Form -->
        <div class="filter-form">
            <h4>Filter Courses</h4>
            <form name="searchForm" id="searchForm">
                <div class="row g-3">
                    <!-- Course Name -->
                    <div class="col-md-6">
                        <label for="searchCourseName" class="form-label">Course Name</label>
                        <input type="text" name="searchCourseName" class="form-control"
                            placeholder="Search Course Name...." id="searchCourseName">
                    </div>

                    <!-- Discription Name -->
                    <div class="col-md-6">
                        <label for="searchDiscriptionName" class="form-label">Discription Name</label>
                        <input type="text" name="searchDiscriptionName" class="form-control"
                            placeholder="Search Discription Name...." id="searchDiscriptionName">
                    </div>

                    <!-- Buttons (Aligned to the Bottom) -->
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-50">
                            <i class="bi bi-send"></i> Submit
                        </button>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="reset" class="btn btn-secondary w-50">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-4" name="selectedColume">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button type="button" class="btn btn-danger mx-2 btn-lm" name="selectedDelete">
                    <i class="bi bi-trash"></i>Delete
                </button>
                <button type="button" class="btn btn-success mx-2" name="selectedCSV">
                    <i class="bi bi-download"></i> Download PDF
                </button>
                <input type="text" class="form-control form-control-sm" placeholder="Read-only text" readonly
                    style="width: 50px; font-size: 20px;" name="countSelected" value="0">
            </div>
        </div>
    </div>
    
    <!-- show data for course table -->
    <table id="customers" name="courseDetailTable">
        <tr>
            <th>
                <label class="form-check-label" for="selectAll">Select All</label>
                <input type="checkbox" name="allSelectCourse" class="form-check-input">
            </th>
            <th>NO <button data-id="c_id" data-fillter="asc" class="filler btn btn-primary btn-sm" id="c_idasc"><i
                        class="bi bi-caret-up"></i></button> <button data-id="c_id" data-fillter="desc"
                    class="filler btn btn-primary btn-sm" id="c_iddesc" style="margin-top: 5px;"><i
                        class="bi bi-caret-down"></i></button></th>
            <th>NAME <button data-id="name" data-fillter="asc" class="filler btn btn-primary btn-sm" id="nameasc"><i
                        class="bi bi-caret-up"></i></button> <button data-id="name" data-fillter="desc"
                    class="filler btn btn-primary btn-sm" id="namedesc" style="margin-top: 5px;"><i
                        class="bi bi-caret-down"></i></button></th>
            <th>Description <button data-id="discription" data-fillter="asc" class="filler btn btn-primary btn-sm"
                    id="discriptionasc"><i class="bi bi-caret-up"></i></button> <button data-id="discription"
                    data-fillter="desc" class="filler btn btn-primary btn-sm" id="discriptiondesc"
                    style="margin-top: 5px;"><i class="bi bi-caret-down"></i></button></th>
            <th>Action</th>
        </tr>
        <tbody name="coursedata">

        </tbody>

    </table>
     <!-- Pagination start -->
     <ul class="pagination justify-content-center" id="paginationList"></ul>
    <!-- Pagination end -->


    <!-- Modal for Successfull messsage -->
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

    <!-- Modal for View Course -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">View Course Details</h5>
                    <button type="button" class="close btn btn-danger btn-sm" id="viewClose-modal" data-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Course Name:</strong></td>
                                <td><span id="name"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Course Description:</strong></td>
                                <td><span id="discription"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Edit Course</h5>
                    <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="bi bi-x-lg"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class=" alert-danger" name="courseFormError"></div>
                    <form id="courseForm">
                        <input type="hidden" name="id" value="<?php echo $view['c_id']; ?>" id="'id">

                        <div class="form-group row mb-3">
                            <label for="cname" class="col-sm-3 col-form-label">Course Name <span
                                    class="text-danger">*</span> <?php echo $ecname; ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="cname" id="cname" value="<?php echo $view['name']; ?>"
                                    class="form-control">
                                <span id="ecname" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="discri" class="col-sm-3 col-form-label">Description <span
                                    class="text-danger">*</span> <?php echo $ediscri; ?></label>
                            <div class="col-sm-9">
                                <textarea name="discri" id="discri" placeholder="Write something.." class="form-control"
                                    style="height: 200px;"><?php echo $view['discription']; ?></textarea>
                                <span id="ediscri" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-sm-9 offset-sm-3">
                                <input type="submit" value="Submit" name="submit" class="btn btn-success">
                                <button type="reset" id="resetbutton" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">© 2025 Your Company. All rights reserved.</p>
            <div>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>