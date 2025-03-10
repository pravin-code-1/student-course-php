
var currentPage = 1;  // Default page
var limit = 5;
let selectedCourse = [];
let id, fillter, searchCourse, searchDiscription, totalPages;

$(document).ready(function () {
    $(".filter-form").hide();
    $('[name="courseFormError"]').text("");
    getAllCourseData();
    //course name
    let course_name = $("#cname").val();
    $(document).on('keyup focusout', '#cname', courseNameValidation);
    //limiter change method
    $('[name="limitSelect"]').change(function () {
        limit = $(this).val();
        getAllCourseData();
    });
    //pagination function
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        currentPage = $(this).data('page'); // Update the current page
        getAllCourseData();  // Fetch new pagination data for the clicked page
    });

    //sorting starting
    $(document).on('click', ".filler", function () {
        id = $(this).data('id');
        fillter = $(this).data('fillter');
        let id_name = "#" + id + fillter;
        $('.filler').css('background-color', '#0d6efd');
        $(id_name).css('background-color', '#212529');
        getAllCourseData();
    });
    //sorting ending

    $("#filterButton").click(function () {
        $(".filter-form").slideToggle(); // Toggle the visibility with a slide effect
    });

    //massa Section.....
    $(document).on('click', '[name="allSelectCourse"]', function () {
        if ($(this).is(':checked')) {
            $('[name="SelectCourse"]').prop('checked', true);
        }
        else {
            $('[name="SelectCourse"]').prop('checked', false);
        }
    });

    // Handle individual checkbox change
    $(document).on('change', '[name="SelectCourse"]', function () {
        $('[name="allSelectCourse"]').prop('checked', false);
        if ($('[name="SelectCourse"]').length === $('[name="SelectCourse"]:checked').length) {
            $('[name="allSelectCourse"]').prop('checked', true);
        }

    });

    $(document).on('click', '[name="selectedDelete"]', function (event) {
        event.preventDefault();
        if (selectedCourse.length > 0) {
            if (confirm("ID number " + selectedCourse + " to be deleted ") == true) {
                $.ajax({
                    type: 'GET',
                    url: '/Student/controller/Controller.php',
                    data: { id: selectedCourse, delete: 1 },
                    //dataType: 'json',
                    success: function () {
                        getAllCourseData();
                        $('[name="allSelectStudent"]').prop('checked', false);
                        $('#messege').text("Id number " + selectedCourse + " has been Deleted");
                        $('#messageModal').modal('show');
                        selectedCourse = [];
                    },
                });
            }
        } else {
            alert("Please Select ID....");
        }
    });

    // Create a CSV file mass section.......
    $(document).on('click', '[name="selectedCSV"]', function (event) {
        event.preventDefault();
        if (selectedCourse.length > 0) {
            if (confirm("ID number " + selectedCourse + " to be Create CSV file") == true) {
                $.ajax({
                    type: 'GET',
                    url: '/Student/controller/Controller.php',
                    data: { id: selectedCourse, csv: 1 },
                    //dataType: 'json',
                    success: function () {
                        getAllCourseData();
                        $('[name="allSelectStudent"]').prop('checked', false);
                        $('#messege').text("ID number " + selectedCourse + " has be add in CSV file");
                        $('#messageModal').modal('show');
                        selectedCourse = [];
                    },
                });
            }
        } else {
            alert("Please Select ID....");
        }
    });

    $(document).on('click', '[name="selectedPDF"]', function (event) {
        event.preventDefault();
        if (selectedCourse.length > 0) {
            if (confirm("ID number " + selectedCourse.join(', ') + " to be Create PDF file") == true) {

                $.ajax({
                    type: 'POST',
                    url: '/Student/controller/Controller.php',
                    data: { id: 1, pdf: 1 },
                    success: function (data, status, xhr) {
                        var blob = new Blob([data], { type: 'application/pdf' });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "Student_.pdf"; // Filename for the PDF file
                        link.click(); // Programmatically trigger the download
                    },
                    error: function (xhr, status, error) {
                        console.error("Error while generating the PDF: ", error);
                    }
                });
            }
        }
    });

    // filter search function
    $(document).on('submit', '[name="searchForm"]', function (event) {
        event.preventDefault();
        searchCourse = $('[name="searchCourseName"]').val();
        searchDiscription = $('[name="searchDiscriptionName"]').val();
        getAllCourseData();
    });

    //validation starting
    function courseNameValidation() {
        course_name = $("#cname").val();
        let pattern = /^[a-zA-Z.-]+$/;
        if (course_name.trim() === "") {
            $("#ecname").html("Enter the course name");
        }
        else if (!course_name.match(pattern)) {
            $("#ecname").html("Enter a valid Course name (only letters)");
        }
        else {
            $("#ecname").html("");
            return true;
        }
    }


    // Course Discription Validation
    let course_discri = $("#discri").val();
    $(document).on('keyup focusout', '#discri', courseDiscriValidation);

    function courseDiscriValidation() {
        $("#ediscri").html("");
        course_discri = $("#discri").val();
        $("#discri").html("");
        if (course_discri.trim() === "") {
            $("#ediscri").html("Enter the Discription");
        }
        else {
            $("#ediscri").html("");
            return true;
        }
    }

    // Ajax call 
    $(document).on('submit', "#courseForm", function (event) {
        event.preventDefault();
        if (courseNameValidation() && courseDiscriValidation()) {
            var formData = $(this).serialize();
            $.ajax({
                url: '/Student/controller/Controller.php',
                type: 'POST',
                data: formData,
                success: function (response) {

                    if (response.check) {
                        $('#messege').text(response.message);
                        $('#messageModal').modal('show');
                        $('#courseForm')[0].reset();
                        $('#editModal').modal('hide');
                        getAllCourseData();
                        $('[name="courseFormError"]').text("");
                    }
                    else {
                        console.log(response.message)
                        $('[name="courseFormError"]').text(response.message);
                    }

                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur
                    $('#responseMessage').html('<p>' + response.message + '</p>');
                }
            });
        }
    });


    // Show the popup when the button is clicked
    $(document).on('click', '.view-course', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/Student/controller/Controller.php',
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                $('#viewModal').modal('show')
                $('#name').text(data.name);
                $('#discription').text(data.discription);
                $('#popup-box').fadeIn();
            }
        });
    });

    // Close the View popup when the close button is clicked
    $(document).on('click', '.close', function () {
        $('[name="courseFormError"]').text("");
        $('#editModal').modal('hide');
        $('#viewModal').modal('hide');
    });
    $(document).on('click', '.update-course', function () {
        $('#courseForm')[0].reset();
        $('#resetbutton').hide();
    });

    $(document).on('click', '[name="editCourse"]', function () {
        $('#resetbutton').show();
        $('#editModal').modal('show');
        $('#courseForm')[0].reset();
        $('#courseForm').trigger('reset');
        $('#courseForm input[type="hidden"]').val('');
    });

    $(document).on('click', '.update-course', function () {
        $('#resetbutton').hide();
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/Student/controller/Controller.php',
            data: { id: id },
            dataType: 'json',
            success: function (data) {
                $('#editModal').modal('show');
                $('[name="id"]').val(data.c_id);
                $('[name="cname"]').val(data.name);
                $('[name="discri"]').val(data.discription);
            }
        });
    });

    $(document).on('click', '.editClose', function () {
        $('#editModal').modal('hide');
    });

    // Close the popup when the close button is clicked
    $('#close-popup').on('click', function () {
        $('#popup-box').fadeOut();
    });

    // Delete course detial the popup when the button is clicked
    $(document).on('click', '.delete-course', function () {
        var id = $(this).data('id');
        if (confirm("ID number " + id + " to be deleted ") == true) {
            $.ajax({
                type: 'GET',
                url: '/Student/controller/Controller.php',
                data: { id: id, delete: 1 },
                //dataType: 'json',
                success: function () {
                    $('#messege').text("Id number " + id + " has been Deleted");
                    $('#messageModal').modal('show');
                    getAllCourseData();
                },
                // complete: function () {
                //   //getdata();

                // }
            });
        }
    });
});

function getAllCourseData() {
    setTimeout(function () {
        $('#messageModal').modal('hide');
        $('#messege').text("");
    }, 3000);
    $.ajax({
        type: 'GET',
        data: { name: id, fillter: fillter, limit: limit, page: currentPage, searchCourse: searchCourse, searchDiscription: searchDiscription },
        dataType: 'json',
        url: '/Student/controller/Controller.php',
        success: function (response) {
            if (typeof response === "string") {
                response = JSON.parse(response);
            }
            var courseData = Object.keys(response).filter(key => !isNaN(key)).map(key => response[key]);
            // Ensure the response is a 2D array
            if (Array.isArray(courseData)) {
                courseDataStore(courseData);
                var paginationData = {
                    currentPage: response.currentPage,
                    startPage: response.startPage,
                    endPage: response.endPage,
                    totalPages: response.totalPages,
                };
                totalPages = paginationData.totalPages;
                if (totalPages == 0) {
                    $('[name="courseDetailTable"]').hide()
                    $('#messege').text("No Recored Found");
                    $('#messageModal').modal('show');
                } else { $('[name="courseDetailTable"]').show(); }
                if (currentPage > totalPages && totalPages != 0) {
                    currentPage = totalPages;
                    getAllCourseData();
                }
                buildPagination(paginationData);
            } else {
                console.error("Response is not an array");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data: " + error);
        }
    });
}

function courseDataStore(courseData) {
    $getalldata = "";
    $.each(courseData, function (index, course) {
        $getalldata += `<tr>
                <td class="text-center align-middle">
                    <input type="checkbox" name="SelectCourse" value="${course[0]}" id="course${course[0]}" class="form-check-input">
                </td>
            <td>${course[0]}</td>
            <td>${course[1]}</td>
            <td>${course[2]}</td>
            <td>
  
                <button type='button' class='btn btn-warning btn-sm update-course' data-id='${course[0]}'
                    data-toggle='modal'>
                    <i class="bi bi-pencil"></i>
                </button>
                <button type='button' class='btn btn-danger btn-sm delete-course' data-id='${course[0]}'
                    data-toggle='modal'>
                    <i class="bi bi-trash"></i>
                </button>
                <button type='button' class='btn btn-primary btn-sm view-course' data-id='${course[0]}'
                    data-toggle='modal'>
                    <i class="bi bi-eye"></i> 
                </button>
            
          </td>
          </tr>`

    });
    $('[name="coursedata"]').html($getalldata);
    if ($('[name="allSelectCourse"]').is(':checked')) {
        $('[name="SelectCourse"]').prop('checked', true);
    }
}

function buildPagination(pagination) {
    var $paginationList = $('.pagination');
    $paginationList.empty(); // Clear any previous pagination
    if (pagination.totalPages > 1) {
        // Previous page and first page icons
        if (pagination.currentPage > 1) {
            $paginationList.append('<li class="page-item"><a href="#" class="page-link" data-page="1"><i class="bi bi-chevron-double-left"></i></a></li>');
            $paginationList.append('<li class="page-item"><a href="#" class="page-link" data-page="' + (pagination.currentPage - 1) + '"><i class="bi bi-chevron-left"></i></a></li>');
        } else {
            $paginationList.append('<li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-double-left"></i></span></li>');
            $paginationList.append('<li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>');
        }

        // Page numbers
        for (var i = pagination.startPage; i <= pagination.endPage; i++) {
            if (i == pagination.currentPage) {
                $paginationList.append('<li class="page-item active"><span class="page-link">' + i + '</span></li>');
            } else {
                $paginationList.append('<li class="page-item"><a href="#" class="page-link" data-page="' + i + '">' + i + '</a></li>');
            }
        }

        // Next page and last page icons
        if (pagination.currentPage < pagination.totalPages) {
            $paginationList.append('<li class="page-item"><a href="#" class="page-link" data-page="' + (pagination.currentPage + 1) + '"><i class="bi bi-chevron-right"></i></a></li>');
            $paginationList.append('<li class="page-item"><a href="#" class="page-link" data-page="' + pagination.totalPages + '"><i class="bi bi-chevron-double-right"></i></a></li>');
        } else {
            $paginationList.append('<li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>');
            $paginationList.append('<li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-double-right"></i></span></li>');
        }
    }
}
