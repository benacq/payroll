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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <title>Admin - Edit Profile</title>
  </head>
  <body>
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php include 'includes/sideBar.php'; ?>
      <section class="work-area">
        <h1 class="page-header">EDIT PROFILE</h1>
        <!-- <div class="header">Contain search bar and page heading</div> -->
        <div class="content">
          <div class="data-wrap">
            <div class="data data-head">Action</div>
            <div class="data data-head">Deduction Name</div>
            <div class="data data-head">Description</div>
            <div class="data data-head">Amount</div>
          </div>
          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-pencil"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

          <div class="data-wrap">
            <div class="data">
              <button type="button" class="edit" name="button"><i class="fa fa-users"></i>Edit</button>
              <button type="button" class="delete" name="button"><i class="fa fa-users"></i></button>
            </div>
            <div class="data">
              <h1>NHIS TAX</h1>
            </div>
            <div class="data">
              <h1>Health Insurance Tax</h1>
            </div>
            <div class="data">
              <h1>GHS 200</h1>
            </div>
          </div>

        </div>
      </section>
    </section>
  </body>
</html>
