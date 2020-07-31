<?php
date_default_timezone_set("Africa/Accra");
session_start(); 
if(isset($_SESSION['empID'])){
    include_once 'classes/FetchLoginData.php';
    $empID = $_SESSION['empID'];
    $empID = $_SESSION['empID'];
    $empData = new LoginData();
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
    <link rel="stylesheet" href="assets/css/modal-style.css">
    <link rel="stylesheet" href="assets/css/salary-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/print.min.js"></script>
    <script src="assets/js/salary-script.js"></script>
    
    <title>PAYROLL</title>
</head>
<body>
    <section id="main-section">
        <?php include 'includes/nav.php'; ?>
        <?php include 'includes/sideBar.php'; ?>
        <div class="work-area">
            <div class="page-header">
                <h1>SALARY</h1>
                <div class="icon-user"><i class="fa fa-user-circle"></i></div>
               <button id="print-slip" onclick="printJS('salary-data', 'html');">Print</button>
            </div>

            <div class="content">
                <div class="salary-data" id="salary-data">
                    <h1 id="company-name">JELLY PLASTICS COMPANY LIMITED</h1>
                    <div class="employee-data">
                        <div class="info"><span class="first-info-span">EMPLOYEE NAME:</span> <span class="second-info-span" id="emp-full-name"></span></div>
                        <div class="info"><span class="first-info-span">EMPLOYEE ID NUMBER: </span> <span class="second-info-span" id="emp-id"><?php echo $_SESSION['empID']; ?></span></div>
                        <div class="info"><span class="first-info-span">EMPLOYEE POSITION: </span> <span class="second-info-span" id="emp-position"></span></div>
                        <div class="info"><span class="first-info-span">DATE: </span> <span class="second-info-span"><?php echo date('d/m/Y') ?></span></div>
                    </div>

                    <div class="gross-overtime">
                        <div class="gross-wrap"><span class="gross">GROSS INCOME:</span> <span class="amount" id="gross-amount">GHS 0.00</span></div>
                        <div class="overtime-wrap"><span class="overtime">OVERTIME:</span> <span class="overtime-value" id="overtimeTotal">0</span></div>
                    </div>

                    <div class="deductNallowances flex">
                        <div class="deductions" id="deductions-div">
                        
                        </div>
                        <div class="allowances" id="allowances-div">
                            
                        </div>
                    </div>
                    <div class="net-income" id="net-income">
                        <span>NET SALARY:</span>
                        <span class="net-value">GHS 0.00</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>
</html>