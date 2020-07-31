<?php
session_start(); 
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/ManagePayments.php';
    include '../classes/FetchLoginData.php'; 
    $payment = new ManagePayments();
     
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
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/allowance-script.js"></script>

    <title>MANAGE ALLOWANCES</title>
  </head>
  <body>
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php include 'includes/sideBar.php'; ?>
      <section class="work-area">
        <div class="allowance-error"></div>
        <div class="allowance-success"></div>
        <h1 class="page-header">Manage Allowances </h1>
        <button type="button" class="addMore addAllowance" name="button">Add Allowance</button>

    <div class="content">
          <div class="data-wrap" id="data-header">
            <div class="data data-head">Allowance Name</div>
            <div class="data data-head">Amount</div>
            <div class="data data-head">Description</div>
            <div class="data data-head">Action</div>
          </div>

    <?php $payment->db_manageAllowance(); ?>



       <div class="allowance-modal-wrap">
        <div class="modal">
          <div class="modal-header"><span id="close-allowance-modal">&times;</span></div>
          <div class="modal-body">
              <input type="text" class="allowance-input" name="allowance-name" id="allowance-name" placeholder="Allowance Name">
              <input type="number" max="50" min="0" class="allowance-input" name="allowance-amount" id="allowance-amount" placeholder="Allowance Percentage">
              <textarea class="allowance-input" name="allowance-desc" id="allowance-desc" placeholder="Description"></textarea>
              <div class="submit-allowance">
                <input type="submit" name="add-allowance" class="add-allowance" id="add-allowance" value="Save">
              </div>
          </div>
        </div>
       </div>


      <div class="edit-allowance-modal">
          <div class="allowance-modal">
            <div><span class="close-allowance-modal">&times;</span></div>
              <div class="edit-wrap">
                <input type="text" class="edit-allowance-input allowance-name">
                <input type="number" class="edit-allowance-input allowance-percentage">
                <textarea class="edit-allowance-input allowance-desc" cols="30" rows="10"></textarea>
                <div class="submit-edit-allowance">
                  <input type="submit" class="save-edit-allowance" value="Save">
                </div>
              </div>
          </div>
      </div>


       <div class="delete-allowance">
         <div class="confirm-delete">
           <h1 class="confirm-dialogue">Are you sure you want to delete this?</h1>
           <h1 class="confirm"><span class="no">No</span> <span class="yes">Yes</span></h1>
         </div>
       </div>
          
    </div> 

      </section>
    </section>
  </body>
</html>
