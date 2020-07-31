<?php 
session_start(); 
if(isset($_SESSION['empID']) && $_SESSION['empID']==340000){
    include '../classes/ManagePayments.php';
    include '../classes/FetchLoginData.php'; 
    $empData = new LoginData(); 
    $payment = new ManagePayments();
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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/deduction-script.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>MANAGE DEDUCTIONS</title>
  </head>
  <body>
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php include 'includes/sideBar.php'; ?>
      <section class="work-area">
        <div class="deduction-error"></div>
        <div class="deduction-success"></div>
        <h1 class="page-header">Manage Deductions</h1>
        <button type="button" class="addMore addDeduction" name="button">Add Deduction</button>
        
        <div class="content">
          <div class="data-wrap" id="data-header">
            <div class="data data-head">Deduction Name</div>
            <div class="data data-head">Amount</div>
            <div class="data data-head">Description</div>
            <div class="data data-head">Action</div>
          </div>

          <?php $payment->db_manageDeductions(); ?>

      </div> 
      </section>
    </section>

      <div class="deduction-modal-wrap">
          <div class="modal">
            <div class="modal-header"><span id="close-deduction-modal">&times;</span></div>
            <div class="modal-body">
              <input type="text" class="deduction-input" name="deduction-name" id="deduction-name" placeholder="Deduction Name">
              <input type="number" max="50" min="0" class="deduction-input" name="deduction-amount" id="deduction-amount" placeholder="Deduction Percentage">
              <textarea class="deduction-input" name="deduction-desc" id="deduction-desc" placeholder="Description"></textarea>
              <div class="submit-deduction">
                <input type="submit" name="add-deduction" class="add-deduction" id="add-deduction" value="Save">
              </div>
            </div>
          </div>
      </div>



      <div class="edit-deduction-modal">
          <div class="deduction-modal">
            <div><span class="close-deduction-modal">&times;</span></div>
              <div class="edit-wrap">
                <input type="text" class="edit-deduction-input deduction-name">
                <input type="number" class="edit-deduction-input deduction-percentage">
                <textarea class="edit-deduction-input deduction-desc" cols="30" rows="10"></textarea>
                <div class="submit-edit-deduction">
                  <input type="submit" class="save-edit-deduction" value="Save">
                </div>
              </div>
          </div>
      </div>


      <div class="delete-deduction">
         <div class="confirm-delete">
           <h1 class="confirm-dialogue">Are you sure you want to delete this?</h1>
           <h1 class="confirm"><span class="no">No</span> <span class="yes">Yes</span></h1>
         </div>
       </div>

  </body>
</html>
