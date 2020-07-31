<?php
 $loginData = $empData->db_fetchLoginData($_SESSION['empID']); 
?>

<section id="change-pass-modal">
    <div class="success"></div>
    <div class="modal-frame">
        <div class="modal-header">CHANGE PASSWORD <span id="close-modal">&times;</span></div>
        <div class="modal-body">
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <div class="pass-error error"></div>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
            <div class="cPass-error error"></div>
            <input type="submit" name="submit" class="submit" id="<?php echo $_SESSION['empID']; ?>" value="Save">
        </div>
    </div>
</section>

<section id="quick-access-side">
  <div class="clear"></div>
  <?php foreach ($loginData as $data): ?>
  <section class="quick-access-profile">
    <div class="profile-img-wrap profile-inline">
      <img src="<?php echo $data['profilePic']; ?>" alt="N/A" id="profile-pic-holder">
    </div>
    <div class="user-info profile-inline">
      <h1><?php echo $data['firstName']; ?></h1>
      <h3>Admin</h3>
    </div>
  </section>
<?php endforeach; ?>

  <section class="quick-menu-wrap">
    <ul>
      <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
      <li class="caret-toggle"><i class="fa fa-dollar-sign"></i>Manage Payments<i class="caret fa fa-caret-down"></i></li>
      <ul class="sub-list">
        <li><a href="allowances.php">Manage Allowances</a></li>
        <li><a href="deductions.php">Manage Deductions</a></li>
        
      </ul>
      <li class="caret-toggle"><i class="fa fa-users-cog"></i>Manage Employee<i class="caret fa fa-caret-down"></i></li>
      <ul class="sub-list">
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="empMasterList.php">Employee Masterlist</a></li>
        <li><a href="attendance.php">Attendance</a></li>
      </ul>
      <li><i class="fa fa-comments"></i><a href="reports.php">Manage Reports</a></li>
      <li><i class="fa fa-bullhorn"></i><a href="announcement.php">Make Announcement</a></li>
      <li class="menu-list change-pass" id="change-pass"><i class="fa fa-key"></i>CHANGE PASSWORD</li>
    </ul>
  </section>
</section>
