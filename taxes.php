<?php
session_start(); 
if(isset($_SESSION['empID'])){
    include_once 'classes/FetchLoginData.php';
    include_once 'classes/ManagePayments.php';
    $empID = $_SESSION['empID'];
    $empID = $_SESSION['empID'];
    $empData = new LoginData();
    $empPayment = new ManagePayments();
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
    <link rel="stylesheet" href="assets/css/tax-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/index-script.js"></script>
    <title>TAXES AND DEDUCTIONS</title>
</head>
<body>
    <section id="main-section">
        <?php include 'includes/nav.php'; ?>
        <?php include 'includes/sideBar.php'; ?>
        <div class="work-area">
            <div class="page-header">
                <h1>TAXES AND DEDUCTIONS</h1>
                <div class="icon-user"><i class="fa fa-user-circle"></i></div>
            </div>

            <div class="content">
                <table>
                    <tr>
                        <th>Deduction Name</th>
                        <th>Percentage</th>
                        <th>Description</th>
                    </tr>
                    
                   <?php $empPayment->db_fetchDeduction() ?> 
                    <!-- <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                    </tr>
                    <tr>
                        <td>Centro comercial Moctezuma</td>
                        <td>Francisco Chang</td>
                        <td>Mexico</td>
                    </tr>
                    <tr>
                        <td>Ernst Handel</td>
                        <td>Roland Mendel</td>
                        <td>Austria</td>
                    </tr>
                    <tr>
                        <td>Island Trading</td>
                        <td>Helen Bennett</td>
                        <td>UK</td>
                    </tr>
                    <tr>
                        <td>Laughing Bacchus Winecellars</td>
                        <td>Yoshi Tannamuri</td>
                        <td>Canada</td>
                    </tr>
                    <tr>
                        <td>Magazzini Alimentari Riuniti</td>
                        <td>Giovanni Rovelli</td>
                        <td>Italy</td>
                    </tr> -->
                </table>
            </div>
        </div>
    </section>
</body>
</html>