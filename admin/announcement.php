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
    <link rel="stylesheet" href="css/announcement-style.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/announcement-script.js"></script>
    <title>MAKE ANNOUNCEMENT</title>
  </head>
  <body>
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php include 'includes/sideBar.php'; ?>
      <section class="work-area">
        <div class="announce-error"></div>
        <div class="announce-success"></div>
        <h1 class="page-header">Announcement</h1>
        <button id="addAnnouncement">Add Announcement</button>
        <div class="content">
            
        </div>
      </section>

      <div class="announcement-modal-wrap">
        <div class="modal">
          <div class="modal-header"><span id="close-modal">&times;</span></div>
          <div class="modal-body">
            <textarea name="announcement" id="announcement-textArea"></textarea>
            <div class="submit-announcement">
              <input type="submit" name="publish-announcement" class="publish-announcement" id="<?php echo $empID; ?>" value="Publish Announcement">
            </div>
          </div>
        </div>
      </div>

    </section>
  </body>
</html>
