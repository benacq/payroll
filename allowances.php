<?php
session_start(); 
if(isset($_SESSION['empID'])){
    $empID = $_SESSION['empID'];
    include_once 'classes/ManagePayments.php';
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
    <link rel="stylesheet" href="assets/css/allowance-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section id="main-section">
        <?php include 'includes/nav.php'; ?>
        <div class="work-area">
            <div class="page-header">
                <h1>ALLOWANCES</h1>
                <div class="icon-user"><i class="fa fa-user-circle"></i></div>
            </div>
            <table>
                    <tr>
                        <th>Allowance Name</th>
                        <th>Percentage</th>
                        <th>Description</th>
                    </tr>
                    
                   <?php $empPayment->db_fetchAllowance() ?> 
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
    </section>
</body>
</html>