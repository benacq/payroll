<?php
session_start(); 
if(isset($_SESSION['empID'])){
    if ($_SESSION['empID'] == 340000) {
        header("Location: admin/index.php");
    }else{
        include_once 'classes/FetchLoginData.php';
        include_once 'classes/ManageEmployee.php';
        $empID = $_SESSION['empID'];
        $empData = new LoginData();
        $employeeActivities = new ManageEmployee();
    }
}else{
header("Location: login.php");
die('Register to access this page');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/side-bar-style.css">
    <link rel="stylesheet" href="assets/css/nav-style.css">
    <link rel="stylesheet" href="assets/css/index-style.css">
    <link rel="stylesheet" href="assets/css/modal-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/index-script.js"></script>
    <title>DASHBOARD</title>
</head>
<body>
    <section id="main-section">
    <?php include 'includes/nav.php'; ?>
    <?php include 'includes/sideBar.php'; ?>
        <div class="work-area">
           <div class="page-header">
                <h1>DASHBOARD</h1>
               <div class="icon-user"><i class="fa fa-user-circle"></i></div>
           </div>
           
           <section class="wrap-inner grid">
                <div class="grid-child">
                    <a href="report.php">
                        <div class="icon-holder"><i class="fa fa-comments"></i></div>
                        <div class="desc-holder"><h1>REPORTS</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="editProfile.php">
                        <div class="icon-holder"><i class="fa fa-user-cog"></i></div>
                        <div class="desc-holder"><h1>EDIT PROFILE</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="allowances.php">
                        <div class="icon-holder"><i class="fa fa-money-check-alt"></i></div>
                        <div class="desc-holder"><h1>ALLOWANCES</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="salary.php">
                        <div class="icon-holder"><i class="fa fa-dollar-sign"></i></div>
                        <div class="desc-holder"><h1>PAYROLL</h1></div>
                    </a>
                </div>
            </section>

            <div class="recent-activities">
                <div class="recent-act-header">
                   <h1>Recent Activities</h1>
                </div>
                <div class="activities-wrap">
                    <?php $employeeActivities->fetchAnnouncement(); ?>
                </div>
            </div>

        </div>
    </section>
</body>
</html>