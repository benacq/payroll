<?php
session_start(); 
if(isset($_SESSION['empID'])){
    $empID = $_SESSION['empID'];
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
    <link rel="stylesheet" href="assets/css/report-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/report-script.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <title>MAKE A REPORT</title>
</head>
<body>
    <section id="main-section">
    <div class="submit-success">REPORT SUBMITTED SUCCESSFULLY</div>
    <div class="submit-error">REPORT SUBMITTED error</div>
        <?php include 'includes/nav.php'; ?>
            <div class="work-area">
                <div class="page-header">
                    <h1 style="margin-left:20px;">MAKE A REPORT</h1>
                    <div class="icon-user"><i class="fa fa-user-circle"></i></div>
                    <span class="active new-report">New Report</span>
                    <span class="my-reports">My Reports</span>
                </div>
                <section class="report-section">
                    <textarea id="report-text-area" name="report-textarea" id="report-field" resize="none" placeholder="Report here"></textarea>
                    <input type="submit" name="submit" id="submit" value="Submit Report">
                </section>
            </div>

            <section id="view-reports">
                <div class="report-wrapper">
                    <div class="sent-report">
                        <div class="sent-date"></div>
                    </div>
                    <div class="report-reply">
                        <div class="reply-date"></div>
                    </div>
                </div>
            </section>
    </section>
</body>
</html>