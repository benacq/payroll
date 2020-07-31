<?php 
session_start(); 
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/FetchLoginData.php'; 
    $empData = new LoginData();
    $empID = $_SESSION['empID'];
    }else{
    header("Location: ../login.php");
    die('Register to access this page');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <title>ADMIN-DASHBOARD</title>
</head>
<body>
   <section id="wrapper">
       <?php include 'includes/nav.php'; ?>
       <?php include 'includes/sideBar.php'; ?>
       <section class="content-wrapper-main">
           <div class="wrapper-header">
               <h1><i class="fa fa-cogs"></i>DASHBOARD</h1>
           </div>
            <section class="wrap-inner grid">
                <div class="grid-child">
                    <a href="empMasterlist.php">
                        <div class="icon-holder"><i class="fa fa-users"></i></div>
                        <div class="desc-holder"><h1>EMPLOYEES</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="addEmployee.php">
                        <div class="icon-holder"><i class="fa fa-user-plus"></i></div>
                        <div class="desc-holder"><h1>ADD EMPLOYEE</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="../editProfile.php">
                        <div class="icon-holder"><i class="fa fa-user-cog"></i></div>
                        <div class="desc-holder"><h1>EDIT PROFILE</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="attendance.php">
                        <div class="icon-holder"><i class="fa fa-clock"></i></div>
                        <div class="desc-holder"><h1>ATTENDANCE</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="allowances.php">
                        <div class="icon-holder"><i class="fa fa-money-check-alt"></i></div>
                        <div class="desc-holder"><h1>ALLOWANCES</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="../salary.php">
                        <div class="icon-holder"><i class="fa fa-dollar-sign"></i></div>
                        <div class="desc-holder"><h1>PAYMENTS</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="reports.php">
                        <div class="icon-holder"><i class="fa fa-comments"></i></div>
                        <div class="desc-holder"><h1>REPORTS</h1></div>
                    </a>
                </div>
                <div class="grid-child">
                    <a href="announcement.php">
                        <div class="icon-holder"><i class="fa fa-bullhorn"></i></div>
                        <div class="desc-holder"><h1>ANNOUNCEMENT</h1></div>
                    </a>
                </div>
            </section>
       </section>
       
   </section>
</body>
</html>