<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="http://localhost/Student/map/style.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://localhost/Student/map/student.js"></script>
  <title> Registration</title>
</head>

<body>

  <h1>A <?php echo $title; ?> Registration Student</h1>
  <h1>A <?php echo $title; ?> Registration Student</h1>
  <P><?php echo $massage; ?></P>
  <div class="container">
    <form id="studentForm" >
      <input type="hidden" name="id" value="<?php echo $view['s_id'] ?>">

      <div class="row">
        <div class="col-25">
          <label>First Name <span>* </span></label>
        </div>
        <div class="col-75">
          <input type="text" name="fname" id="fname" value="<?php echo $view['firstname'] ?>"
            placeholder="your first name....">
            <span id="efname"><?php echo $efname; ?></span>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Last Name <span>* </span></label>
        </div>
        <div class="col-75">
          <input type="text" name="lname" id="lname" value="<?php echo empty($lname) ? $view['lastname'] : $lname ?>"
            placeholder="your last name....">
            <span id="elname"><?php echo $elname; ?></span>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Email <span>* </span> </label>
        </div>
        <div class="col-75">
          <input type="text" name="email" id="email" value="<?php echo empty($email) ? $view['email'] : $email ?>"
            placeholder="your email....">
            <span id="eemail"><?php echo $eemail; ?></span>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Contact Number <span>* </span> </label>
        </div>
        <div class="col-75">
          <input type="number" name="num" id="num" value="<?php echo empty($num) ? $view['phone'] : $num ?>"
            placeholder="your contact number....">
            <span id="enum"><?php echo $enum; ?></span>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="fname">Gender <span>* </span> </label>
        </div>
        <div class="col-75">
          <label class="containe">Male
            <input type="radio" name="gender" id="male" value="Male" <?php echo strcmp($view['gender'], 'Male') ?: 'checked' ?> />

          </label>
          <label class="containe">Female
            <input type="radio" name="gender" id="female" value="Female" <?php echo strcmp($view['gender'], 'Female') ?: 'checked' ?> />
          </label>
          <label class="containe">Other
            <input type="radio" name="gender" id="other" value="Other" <?php echo strcmp($view['gender'], 'Other') ?: 'checked' ?> />
          </label>
          <div  ><span id="egender"></span></div>


        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="country">Course</label>
        </div>
        <div class="col-75">
          <select name="course" id="course" class="courseid">
          <option value="">--- Choose a Gender ---</option>
            <?php foreach ($course as $value) { ?>
              <option value="<?php echo $value[0]; ?>" <?php echo $value[0] == $view['c_id'] ? 'selected' : '' ?>>
                <?php echo $value[1]; ?> </option><?php } ?>
          </select>
          <div  ><span id="ecourse"></span></div>
        </div>
      </div>

      <div class="row">
        <div class="col-75">
          <input type="submit" value="Submit" name="submit">
          <input type="reset" value="Reset">
        </div>

      </div>
    </form>
    <div id="responseMessage"></div>
              
  </div>
  <a href="http://localhost/Student/controller/StudentController.php"><button>Student Data</button></a>

</body>

</html>