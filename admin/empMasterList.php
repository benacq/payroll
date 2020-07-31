<?php
session_start(); 
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/ManageEmployee.php'; 
    include '../classes/FetchLoginData.php'; 
    $empData = new LoginData();
    $manageEmp = new ManageEmployee();
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
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/emp-masterlist.js"></script>
    <title>All Employees</title>
  </head>
  <body>
      
      <?php include 'includes/nav.php'; ?>
        <?php include 'includes/sideBar.php'; ?>

        <section class="work-area">
          
          <h1 class="page-header">Employee Masterlist</h1>
          <a href="addEmployee.php" class="addEmp">Add Employee</a>
          <!-- <div class="header">Contain search bar and page heading</div> -->
          
          <div class="content">
            <div class="data-wrap">
              <div class="data data-head">First Name</div>
              <div class="data data-head">Last Name</div>
              <div class="data data-head">Position</div>
              <div class="data data-head">Gross Salary</div>
              <div class="data data-head">More</div>
            </div>   
            <?php $manageEmp->publicEmpAll(); ?>
          </div>
        </section>

        <section class="modal-wrap" id="modal-wrap">
          <div class="more-on-emp-modal">
            <div class="modal-head">MORE ABOUT EMPLOYEE<span id="close-modal" class="emp-info-close">&times;</span></div>
            <div class="modal-body">
              <table class="modal-table">
              </table>
            </div>
          </div>
        </section>
        
  </body>
</html>




