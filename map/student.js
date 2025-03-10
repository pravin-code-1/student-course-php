function submit() {
  let form = document.getElementById("form");
  form.submit();
  //alert("Data stored in database!");
}

var currentPage = 1;  // Default page
var limit = 10;
let recoredLenght;
let id, fillter, searchGender, searchCourse, searchFirstName, searchLastName, searchEmail, searchContact, searchStatus, searchCreatedDate, searchUpdateDate, totalPages;
$(document).ready(function () {
  document.getElementById('darkModeToggle').addEventListener('change', function() {
    document.body.classList.toggle('dark-mode', this.checked);
    document.querySelector('header').classList.toggle('bg-dark', this.checked);
  });
  $('#createDaterangeInput').hide();
  $(".filter-form").hide();
  $('[name="page"]').val(currentPage);
  // Example (can be dynamically set)
  // Initialize datepickers
  $('[name="limitSelect"]').change(function () {
    limit = $(this).val();
    getAllStudentData();
  })
  // Initialize the daterangepicker
  $('#searchCreatedDate').change(function () {
    var selectedValue = $(this).val();

    // Check if the custom date range option is selected
    if (selectedValue === 'custom') {
      // Open the DateRangePicker
      $(this).daterangepicker({
        opens: 'center',
        autoUpdateInput: true,
        locale: {
          format: 'MM/DD/YYYY HH:mm:ss',
          cancelLabel: 'Clear'
        }
      }, function (start, end) {
        // When date range is selected, set the value of the custom option
        var dateRangeText = start.format('MM/DD/YYYY HH:mm:ss') + ' - ' + end.format('MM/DD/YYYY HH:mm:ss');
        // Set the value and text of the custom option
        $('#searchCreatedDate option:selected').val(dateRangeText).text('Custom Date Range: ' + dateRangeText);
      });
    }
  });
  $('#searchUpdateDate').change(function () {
    var selectedValue = $(this).val();

    // Check if the custom date range option is selected
    if (selectedValue === 'custom') {
      // Open the DateRangePicker
      $(this).daterangepicker({
        opens: 'center',
        autoUpdateInput: true,
        locale: {
          format: 'MM/DD/YYYY HH:mm:ss',
          cancelLabel: 'Clear'
        }
      }, function (start, end) {
        // When date range is selected, set the value of the custom option
        var dateRangeText = start.format('MM/DD/YYYY HH:mm:ss') + ' - ' + end.format('MM/DD/YYYY HH:mm:ss');
        // Set the value and text of the custom option
        $('#searchUpdateDate option:selected').val(dateRangeText).text('Custom Date Range: ' + dateRangeText);
      });
    }
  });


  // Show the custom date range input when 'Custom Date Range' is selected from the dropdown

  // Delegate event listener to handle pagination clicks
  $(document).on('click', '.page-link', function (e) {
    e.preventDefault();
    currentPage = $(this).data('page'); // Update the current page
    getAllStudentData();  // Fetch new pagination data for the clicked page
  });


  //Mass section............................................
  // Array to hold selected student values

  // Handle "Select All" checkbox click
  $(document).on('click', '[name="allSelectStudent"]', function () {
    if ($(this).is(':checked')) {
      $('[name="allSelectStudent"]').prop('checked', true);
      $.ajax({
        type: 'GET',
        url: '/Student/controller/StudentController.php',
        data: { getID: 1 },
        dataType: 'json',
        success: function (response) {
          selectedStudent = [];
          selectedStudent = response;
          count = selectedStudent.length
          sessionStorage.setItem('selectedStudent', JSON.stringify(selectedStudent));
          sessionStorage.setItem('totalStudentLength', count);
          $('[name="countSelected"]').val(selectedStudent.length);
          getAllStudentData();
        },
      });
    } else {
      selectedStudent = [];
      sessionStorage.removeItem('selectedStudent');
      sessionStorage.removeItem('totalStudentLength');
      sessionStorage.clear();
      $('[name="countSelected"]').val(selectedStudent.length);
      getAllStudentData();
    }
  });

  // Handle individual checkbox change
  $(document).on('change', '[name="SelectStudent"]', function () {
    let selectedStudent = sessionStorage.getItem('selectedStudent') === null
      ? []
      : JSON.parse(sessionStorage.getItem('selectedStudent'));

    let value = $(this).val();

    if ($(this).is(':checked')) {
      // Add value if it's not already in the array
      if (!selectedStudent.includes(value)) {
        selectedStudent.push(value);
      }
    } else {
      // Remove value from the array if unchecked
      selectedStudent = selectedStudent.filter(option => option !== value);
    }

    // Save the updated array back to sessionStorage
    sessionStorage.setItem('selectedStudent', JSON.stringify(selectedStudent));
    $('[name="countSelected"]').val(selectedStudent.length);
    sessionStorage.setItem('selectedStudent', JSON.stringify(selectedStudent));
    if ($('[name="SelectStudent"]:checked').length === $('[name="SelectStudent"]').length) {
      $('[name="allSelectStudent"]').prop('checked', true);
    } else {
      $('[name="allSelectStudent"]').prop('checked', false);
    }
  });

  // delete mass section.......
  $(document).on('click', '[name="selectedDelete"]', function (event) {
    event.preventDefault();
    if (JSON.parse(sessionStorage.getItem('selectedStudent')).length > 0) {
      if (confirm("ID number " + JSON.parse(sessionStorage.getItem('selectedStudent')) + " to be deleted ") == true) {
        $.ajax({
          type: 'GET',
          url: '/Student/controller/StudentController.php',
          data: { id: selectedStudent, delete: 1 },
          //dataType: 'json',
          success: function () {
            getAllStudentData();
            $('[name="allSelectStudent"]').prop('checked', false);
            $('#messege').text("Id number " + selectedStudent + " has been Deleted");
            $('#messageModal').modal('show');
            selectedStudent = [];
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
    if (JSON.parse(sessionStorage.getItem('selectedStudent')).length > 0) {
      if (confirm("ID number " + JSON.parse(sessionStorage.getItem('selectedStudent')) + " to be Create CSV file") == true) {
        $.ajax({
          type: 'GET',
          url: '/Student/controller/StudentController.php',
          data: { id: JSON.parse(sessionStorage.getItem('selectedStudent')), csv: 1 },
          //dataType: 'json',
          success: function () {
            getAllStudentData();
            $('[name="allSelectStudent"]').prop('checked', false);
            $('#messege').text("ID number " + selectedStudent + " has be add in CSV file");
            $('#messageModal').modal('show');
            selectedStudent = [];
          },
        });
      }
    } else {
      alert("Please Select ID....");
    }
  });

  $(document).on('click', '[name="selectedPDF"]', function (event) {
    //console.log(JSON.parse(sessionStorage.getItem('selectedStudent')));
    event.preventDefault();
    if (JSON.parse(sessionStorage.getItem('selectedStudent')).length > 0) {
      if (confirm("ID number " + JSON.parse(sessionStorage.getItem('selectedStudent'))+ " to be Create PDF file") == true) {

        $.ajax({
          type: 'POST',
          url: '/Student/controller/StudentController.php',
          data: { id: 1, pdf: 1 },
          success: function (data, status, xhr) {
            console.log(1);
          },
          error: function (xhr, status, error) {
            console.error("Error while generating the PDF: ", error);
          }
        });
      }
    }
    else {
      alert("Please Select ID....");
    }
  });



  //Mass section ens
  //Student all data
  getAllStudentData();
  getAllCoursedata();
  getAllGender();
  $("#studentForm")[0].reset();

  const namePattern = /^[A-Za-z]+$/;
  const emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  const phonePattern = /^\d{10}$/;

  function validateInput(input, errorMessage, pattern) {
    const inputValue = input.val();
    if (inputValue.trim() === "") {
      errorMessage.text("Enter the " + input.attr("name") + ".");
    } else if (!inputValue.match(pattern)) {
      errorMessage.text("Enter a valid " + input.attr("name") + ".");
    } else {
      errorMessage.text("");
      return true;
    }
  }

  $(document).on('keyup focusout', 'input', function () {
    const input = $(this);
    const errorMessage = $("#e" + input.attr("id"));
    switch (input.attr("id")) {
      case "fname":
        validateInput(input, errorMessage, namePattern);
        break;
      case "lname":
        validateInput(input, errorMessage, namePattern);
        break;
      case "email":
        validateInput(input, errorMessage, emailPattern);
        break;
      case "num":
        validateInput(input, errorMessage, phonePattern);
        break;
      case "other", 'female', 'male':
        const gender = $('input[name="gender"]:checked');
        if (gender.length === 0) {
          $("#egender").text("Select your gender.");
        } else {
          $("#egender").text("");
        }
        break;
    }

  });

  $(document).on('submit', "#studentForm", function (event) {
    let studentid = $('[name="id"]').val();
    event.preventDefault();
    var paginationData = {
      id: id,
      fillter: fillter,
      currentPage: currentPage,
      gender: searchGender,
      course: searchCourse
    };
    const formData = $(this).serialize();
    let isValid = true;

    $("input").each(function () {
      const input = $(this);
      const errorMessage = $("#e" + input.attr("id"));
      switch (input.attr("id")) {
        case "fname":
          if (!validateInput(input, errorMessage, namePattern)) {
            isValid = false;
          }
          break;
        case "lname":
          if (!validateInput(input, errorMessage, namePattern)) {
            isValid = false;
          }
          break;
        case "email":
          if (!validateInput(input, errorMessage, emailPattern)) {
            isValid = false;
          }
          break;
        case "num":
          if (!validateInput(input, errorMessage, phonePattern)) {
            isValid = false;
          }
          break;
      }
    });

    const gender = $('input[name="gender"]:checked');
    const genderError = $("#egender");
    if (gender.length === 0) {
      genderError.text("Select your gender.");
      isValid = false;
    }

    if (isValid) {
      $.ajax({
        url: '/Student/controller/StudentController.php',
        type: 'POST',
        data: formData,
        success: function (response) {
          if (!studentid) {
            id = fillter = searchGender = searchCourse = searchFirstName = searchLastName = searchEmail = searchContact = searchStatus = searchCreatedDate = searchUpdateDate = "";
            getAllStudentData();
          }
          if (response.check) {
            $('#messege').text(response.message);
            $('#messageModal').modal('show');
            $('#editModal').modal('hide');
            $("#studentForm")[0].reset();
            $('[name="studentFormErrorMessage"]').text("");
            if (response.page != null) {
              currentPage = response.page
            } genderError.text("");
            getAllStudentData();
          }
          else {
            $('[name="studentFormErrorMessage"]').text(response.messages);
          }
        },
        error: function (xhr, status, error) {
          $('#messege').text("errorrr" + error);
        }
      });
    }
  });
  //filler sorting button click event
  $("#filterButton").click(function () {
    $(".filter-form").slideToggle(); // Toggle the visibility with a slide effect
  });

  $(document).on('click', ".filler", function () {
    let clickCount = 1;
    id = $(this).data('id');
    fillter = $(this).data('fillter');
    let id_name = "#" + id + fillter;
    $('.filler').css('background-color', '#0d6efd');
    $(id_name).css('background-color', '#212529');
    getAllStudentData(id, fillter);
  });

  $(document).on('submit', '[name="searchForm"]', function (event) {
    event.preventDefault();
    searchGender = $('[name="searchGender"]').val()
    searchCourse = $('[name="searchCourse"]').val()
    searchFirstName = $('[name="searchFirstName"]').val()
    searchLastName = $('[name="searchLastName"]').val()
    searchEmail = $('[name="searchEmail"]').val()
    searchContact = $('[name="searchContact"]').val()
    searchStatus = $('[name="searchStatus"]').val()
    searchCreatedDate = $('[name="searchCreatedDate"]').val()
    searchUpdateDate = $('[name="searchUpdateDate"]').val()
    $("#customDateInputs").hide();
    getAllStudentData();
  });



  // View student detial the popup when the button is clicked
  $(document).on('click', '.view-student', function () {
    var id = $(this).data('id');
    $.ajax({
      type: 'GET',
      url: '/Student/controller/StudentController.php',
      data: { id: id, view: 1 },
      dataType: 'json',
      success: function (data) {
        $('#viewModal').modal('show');
        $('#firstname').text(data.firstname);
        $('#lastname').text(data.lastname);
        $('#emailadd').text(data.email);
        $('#number').text(data.phone);
        $('#gender').text(data.gender);
        $('#status').text(data.status);
        $('#courseview').text(data.name ? data.name : 'Not Selected (Please selecte Course)');
        data.name ? '' : $('#courseview').append(`<button type="button" class="btn btn-warning btn-sm update-student me-2" data-id="${data.s_id}" data-toggle="modal">
                            <i class="bi bi-pencil"></i>
                        </button>`);
        
      }
    });
  });

  // Delete student detial the popup when the button is clicked
  $(document).on('click', '.delete-student', function () {
    var id = $(this).data('id');
    if (confirm("ID number " + id + " to be deleted ") == true) {
      $.ajax({
        type: 'GET',
        url: '/Student/controller/StudentController.php',
        data: { id: id, delete: 1 },
        //dataType: 'json',
        success: function () {
          $('#messege').text("Id number " + id + " has been Deleted");
          $('#messageModal').modal('show');
          getAllStudentData();

        },
        // complete: function () {
        //   //getdata();

        // }
      });
    }
  });


  // Show the popup when the button is clicked
  $(document).on('click', '#edit-student', function () {
    $('[name="studentFormErrorMessage"]').text("");
    $('#resetbutton').show();
    $('#editModal').modal('show');
    $("#studentForm")[0].reset();
    $('#id').val(null);
  });

  // Show the popup when the button is clicked
  $(document).on('click', '.update-student', function () {
    $('[name="studentFormErrorMessage"]').text("");
    $('#viewModal').modal('hide');
    $('#resetbutton').hide();
    var id = $(this).data('id');
    $.ajax({
      type: 'GET',
      url: '/Student/controller/StudentController.php',
      data: { id: id },
      dataType: 'json',
      success: function (data) {
        $('#editModal').modal('show');
        $('#id').val(data.s_id);
        $('#fname').val(data.firstname);
        $('#lname').val(data.lastname);
        $('#email').val(data.email);
        $('#num').val(data.phone);
        $('[name="selectCourse"]').val(data.c_id);
        $('#' + data.gender.toLowerCase()).prop("checked", true);

      }
    });
  });


  // Close the View popup when the close button is clicked
  $(document).on('click', '#viewClose-modal', function () {
    $('#viewModal').modal('hide');
  });

  // Close the Edit popup when the close button is clicked
  $(document).on('click', '[name="editClose"]', function () {
    $('[name="studentFormErrorMessage"]').text("");
    $('#efname').text("");
    $('#elname').text("");
    $('#eemail').text("");
    $('#enum').text("");
    getAllCoursedata();
    $("#studentForm")[0].reset();
    $('#editModal').modal('hide');
  });
});

function getAllStudentData() {
  $('[name="studentFormErrorMessage"]').text("");
  $("#studentForm")[0].reset();
  setTimeout(function () {
    $('#messageModal').modal('hide');
  }, 3000);
  $.ajax({
    type: 'GET',
    data: { name: id, fillter: fillter, limit: limit, page: currentPage, searchGender: searchGender, searchCourse: searchCourse, searchFirstName: searchFirstName, searchLastName: searchLastName, searchContact: searchContact, searchEmail: searchEmail, searchStatus: searchStatus, searchCreatedDate: searchCreatedDate, searchUpdateDate: searchUpdateDate },
    dataType: 'json',
    url: '/Student/controller/StudentController.php',
    success: function (response) {
      if (typeof response === "string") {
        response = JSON.parse(response);
      }
      var studentData = Object.keys(response).filter(key => !isNaN(key)).map(key => response[key]);
      // Ensure the response is a 2D array
      recoredLenght = studentData.length;
      if (Array.isArray(studentData)) {
        studentDataStore(studentData);
        var paginationData = {
          currentPage: response.currentPage,
          startPage: response.startPage,
          endPage: response.endPage,
          totalPages: response.totalPages,
          gender: response.gender,
          course: response.course
        };
        totalPages = paginationData.totalPages;
        if (totalPages == 0) {
          $('[name="studentDetailTable"]').hide()
          $('#messege').text("No Recored Found");
          $('#messageModal').modal('show');
        } else { $('[name="studentDetailTable"]').show(); }
        if (currentPage > totalPages && totalPages != 0) {
          currentPage = totalPages;
          getAllStudentData();
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



//geting Course ajax
function getAllCoursedata() {
  $.ajax({
    type: 'GET',
    url: '/Student/controller/Controller.php',
    data: { course: 1 },
    success: function (response) {


      // If the response is not in JSON format, parse it
      if (typeof response === "string") {
        response = JSON.parse(response);
      }

      // Ensure the response is a 2D array
      if (Array.isArray(response)) {
        $getalldata = `<option value="">--- Choose a Course ---</option>`;
        $.each(response, function (index, course) {
          $getalldata += `<option value="${course[0]}" data-id="${course[0]}" > ${course[1]} </option>`
        });
        $('[name="selectCourse"]').html($getalldata);
        $('[name="searchCourse"]').html($getalldata);

      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data: " + error);
    }
  });
}

//Getting Course and gender
function getAllGender() {
  $.ajax({
    type: 'GET',
    data: { gender: 1 },
    url: '/Student/controller/StudentController.php',
    success: function (response) {
      if (typeof response === "string") {
        response = JSON.parse(response);
      }

      // Ensure the response is a 2D array
      if (Array.isArray(response)) {
        $getalldata = `<option value="">--- Choose a Gender ---</option>`;
        $.each(response, function (index, gender) {
          $getalldata += `<option value="${gender}" data-id="${gender}" > ${gender} </option>`
        });
        $('[name="searchGender"]').html($getalldata);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data: " + error);
    }
  });
}

function studentDataStore(studentData) {
  $getalldata = "";
  $('[name="recordCount"]').text(studentData.length);
  $.each(studentData, function (index, student) {
    $getalldata += `<tr>
                <td class="text-center align-middle">
                    <input type="checkbox" name="SelectStudent" value="${student[0]}" id="student${student[0]}" class="form-check-input">
                </td>
                <td class="text-center align-middle">${student[0]}</td>
                <td class="text-center align-middle">${student[1]}</td>
                <td class="text-center align-middle">${student[2]}</td>
                <td class="text-center align-middle">${student[3]}</td>
                <td class="text-center align-middle">${student[4]}</td>
                <td class="text-center align-middle">${student[5]}</td>
                <td class="text-center align-middle">${student[7]}</td>
                <td class="text-center align-middle">${student[8]}</td>
                <td class="text-center align-middle">${student[9]}</td>
                <td class="text-center align-middle">${student[10] ? student[10] : 'N/A'}</td>
                <td class="text-center align-middle">
                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                        <button type="button" class="btn btn-warning btn-sm update-student me-2" data-id="${student[0]}" data-toggle="modal">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm delete-student me-2" data-id="${student[0]}" data-toggle="modal">
                            <i class="bi bi-trash"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm view-student" data-id="${student[0]}" data-toggle="modal">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>`

  });

  $('.studentdata').html($getalldata);
  var countSelected = JSON.parse(sessionStorage.getItem('selectedStudent')) == null ? 0 : JSON.parse(sessionStorage.getItem('selectedStudent')).length;
  $('[name="countSelected"]').val(countSelected);
  if(sessionStorage.getItem('totalStudentLength') == countSelected ){
    $('[name="allSelectStudent"]').prop('checked', true);
  }
  var selectedStudent = JSON.parse(sessionStorage.getItem('selectedStudent')) == null ? [] : JSON.parse(sessionStorage.getItem('selectedStudent'));
  selectedStudent.forEach(function (item) {
    $(`#student${item}`).prop('checked', true);
  });
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
