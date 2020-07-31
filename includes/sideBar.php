<?php $loginData = $empData->db_fetchLoginData($_SESSION['empID']); ?>

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

<section id="side-bar">
    <div class="clear"></div>

    <div class="side-bar-profile">
    <?php foreach ($loginData as $data):?>
        <div class="profile-pic"><img src="<?php echo strstr($data['profilePic'],'uploads'); ?>" alt="Unavailable"></div>
        <div class="empInfo">
            <h1 class="emp-name"><?php echo $data['firstName']; ?></h1>
            <h1 class="emp-id"><?php echo $data['employee_id']; ?></h1>
        </div>
    <?php endforeach; ?>
    </div>


    <div class="side-bar-menu">
        <ul>
            <li class="menu-list"><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
            <li class="menu-list"><a href="editProfile.php"><i class="fa fa-user-cog"></i>Edit Profile</a></li>
            <li class="menu-list"><a href="allowances.php"><i class="fa fa-money-check-alt"></i>My Allowances</a></li>
            <li class="menu-list"><a href="taxes.php"><i class="fa fa-money-check"></i>Taxes and Deductions</a></li>
            <li class="menu-list"><a href="salary.php"><i class="fa fa-dollar-sign"></i>Salary</a></li>
            <li class="menu-list"><a href="report.php"><i class="fa fa-comments"></i>Make a Report</a></li>
            <li class="menu-list"><a href="announcement.php"><i class="fa fa-bullhorn"></i>Announcements</a></li>    
            <li class="menu-list change-pass"><i class="fa fa-key"></i>CHANGE PASSWORD</li>
          
            
        </ul>
    </div>
</section>