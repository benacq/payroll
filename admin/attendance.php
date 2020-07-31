<?php 
session_start(); 
date_default_timezone_set("Africa/Accra");
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/ManageEmployee.php'; 
    $empAttendance = new ManageEmployee();
    include 'includes/sanitizeEmp.php';
    include '../classes/FetchLoginData.php'; 
    $empData = new LoginData();
    $empID = $_SESSION['empID'];
    }else{
    header("Location: ../login.php");
    die('Register to access this page');
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <link rel="stylesheet" href="css/attendance-style.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/attendance.js"></script>
    <title>ATTENDANCE</title>
  </head>
  <body>
      <?php include 'includes/nav.php'; ?>
        <?php include 'includes/sideBar.php'; ?>

        <section class="work-area">
          <h1 class="page-header">Employee Attendance - <?php echo date("F j, Y") ?></h1>
          <!-- <div class="content">  
            <div class="data-wrap" id="data-header">
              <div class="data data-head">Employee ID</div>
              <div class="data data-head">Report Time</div>
              <div class="data data-head">Sign Out</div>
              <div class="data data-head">Hours Worked</div>
            </div>
          </div> -->
        <section id="emp-attendance">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="input-wrap">
              <label for="emp-name">Employee Name</label>
              <input type="text" name="emp-name" id="emp-name" placeholder="Employee Name" disabled>
              <label for="emp-name">Employee ID</label>
              <input type="text" name="emp-id" id="emp-id" placeholder="Employee ID">
              <label for="emp-name">Time In</label>
              <input type="time" name="time_in" id="time_in" placeholder="Time In">
              <label for="emp-name">Time Out</label>
              <input type="time" name="time_out" id="time_out" placeholder="Time Out">
            </div>
            <input type="submit" name="submit-attendance" id="submit-attendance"value="Submit">
          </form>
          
        </section>




        </section>
      
        <!-- <?php //foreach ($attendance as $attenID): ?>
        <div class="hiddenID" id="<?php //echo $attenID['employee_id']; ?>" style="display:none;"></div>
        <?php //endforeach; ?> -->
  </body>
</html>
