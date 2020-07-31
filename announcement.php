<?php
session_start(); 
if(isset($_SESSION['empID'])){
    include_once 'classes/FetchLoginData.php';
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
    <link rel="stylesheet" href="assets/css/announcement-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/announcement-script.js"></script>
    <title>ANNOUNCEMENTS</title>
</head>
<body>
    <section id="main-section">
        <?php include 'includes/nav.php'; ?>
        <?php include 'includes/sideBar.php'; ?>
        <div class="work-area">
            <div class="page-header">
                <h1>ANNOUNCEMENTS</h1>
                <div class="icon-user"><i class="fa fa-user-circle"></i></div>
            </div>
            <div class="content">
                <!-- <div class='no-announcement'>No recent announcements</div> -->
            </div>
        </div>
    </section>
</body>
</html>