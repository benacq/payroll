<?php 
session_start(); 
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/FetchLoginData.php'; 
    $empData = new LoginData();
    $reports = new LoginData();
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
    <link rel="stylesheet" href="css/report-style.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/report-script.js"></script>
    <title>MANAGE REPORTS</title>
  </head>
  <body>
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php include 'includes/sideBar.php'; ?>
      <section class="work-area">
        <div class="success">success</div>
        <div class="error">error</div>
        <h1 class="page-header">REPORTS</h1>
        <div class="content">
              
          <table id="report-table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>DATE</th>
                  <th>REPORT</th>
                  <th>ACTION</th>
                </tr>
            </thead>
            <tbody id="report-tbody">
              <?php $reports->db_fetchReports(); ?>
            </tbody>
          </table>
        </div>
        <div class="reply-report">    
          <div class="close-report">&times;</div>
          <div class="reply-wrap">
              <div class="show-report">The report</div>
              <textarea name="reply" id="reply" cols="30" rows="10"></textarea>
              <button class="send-reply" id="send-reply">Send</button>
          </div>
        </div>

        <div class="delete-report-warning">
          <div class="dialogue">
            <h3>Are you sure you want to delete this?</h3>
            <div class="no">No</div>
            <div class="yes">Yes</div>
          </div>
        </div>
      </section>
    </section>
  </body>
</html>
