<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Course Detail</title>
  <link rel="stylesheet" href="http://localhost/Student/map/upload.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://localhost/Student/map/course.js"></script>
</head>

<body>

  <h1>A Course Details</h1>
  <P><?php echo $massage; ?></P>
  <div class="container">
    <form id="courseForm">

      <div class="row">
        <div class="col-25">
          <label for="fname">Course Name <span>* </span></label>
        </div>
        <div class="col-75">
          <input type="text" name="cname" id="cname" value="">
          <span id="ecname"></span>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="subject">Description <span>*</span></label>
        </div>
        <div class="col-75">
          <textarea name="discri" id="discri" placeholder="Write something.."
            style="height:200px"></textarea>
          <span id="ediscri"></span>
        </div>
      </div>
      <div class="row">
        <input type="submit" value="Submit" name="submit">

      </div>
    </form>
    <div id="responseMessage"></div>

  </div>
  <a href="http://localhost/Student/public/"><button>View Data</button></a>
  <div id="responseMessage"></div>
</body>

</html>