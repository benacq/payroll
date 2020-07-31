<?php
session_start(); 
if(isset($_SESSION['empID'])){
    include_once 'classes/FetchLoginData.php';
    include_once 'classes/FetchDefault.php';
    include_once 'classes/Validation.php';
    $validateEditProfileData = new Validation();
    include_once 'admin/includes/sanitizeEmp.php';
    $empID = $_SESSION['empID'];
    $empData = new LoginData();
    $default = new fetchDefault();
    $marital = $default->db_MaritalStatus();
    $genders = $default->db_Gender();
    $loginData = $empData->db_fetchLoginData($empID);
    $contactData = $empData->db_fetchLoginContactData($empID);
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
    <link rel="stylesheet" href="assets/css/modal-style.css">
    <link rel="stylesheet" href="assets/css/edit-profile-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <title>Edit Profile</title>
</head>
<body>
    <section id="main-section">
        <?php include 'includes/nav.php'; ?>
        <?php //include 'includes/sideBar.php'; ?>
        <div class="work-area">
            <div class="page-header">
                <h1>EDIT PROFILE</h1>
                <div class="icon-user"><i class="fa fa-user-circle"></i></div>
            </div>
            <section class="edit-profile-wrap">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="editProfile" method="POST" enctype="multipart/form-data">
                <?php foreach ($loginData as $data): ?>
                    <div class="grid-child">
                        <input class="form-input" type="text" name="first-name" placeholder="First Name" value="<?php echo $data['firstName']; ?>">
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$first_name_length); ?></div>
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$first_name_numeric); ?></div>
                    </div>

                    <div class="grid-child">
                        <input class="form-input" type="text" name="last-name" placeholder="Last Name" value="<?php echo $data['lastName']; ?>">
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$last_name_length); ?></div>
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$last_name_numeric); ?></div>
                    </div>

                    <div class="grid-child">
                        <input class="form-input" type="text" name="other-name" placeholder="Other Name" value="<?php echo $data['otherName']; ?>">
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$other_name_length); ?></div>
                        <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$other_name_numeric); ?></div>
                    </div>

                    <div class="grid-child">
                        <select class="form-input" name="marital-status" id="marital-status" form="editProfile">
                            <?php foreach ($marital as $m_status): ?>
                                <option value="<?php echo $m_status['marital_id']; ?>"><?php echo $m_status['status']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="grid-child">
                        <select class="form-input" name="gender" id="gender" form="editProfile">
                            <?php foreach ($genders as $gender): ?>
                                    <option value="<?php echo $gender['gender_id']; ?>"><?php echo $gender['gender']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="grid-child"><input class="form-input" name="birth-date" type="date"></div>
                    <?php endforeach; ?>
                    <!-- CONTACT TABLE -->
                <?php foreach ($contactData as $contact): ?>
                <div class="grid-child">
                    <input class="form-input" name="email" type="text" placeholder="Email" value="<?php echo $contact['email']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$email_length); ?></div>
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$email_invalid); ?></div>
                    <div class="error"><?php //echo $validateEditProfileData->getError(Contstants::$email_exist); ?></div>
                </div>

                <div class="grid-child">
                    <input class="form-input" name="telephone" type="text" placeholder="Telephone" value="<?php echo $contact['telephone']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$telephone_length); ?></div>
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$telephone_numeric); ?></div>
                </div>

                <div class="grid-child">
                    <input class="form-input" name="resident1" type="text" placeholder="Residential Address (Region)" value="<?php echo $contact['residentialAddrRegion']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$address_length); ?></div>
                </div>

                <div class="grid-child">
                    <input class="form-input" name="resident2" type="text" placeholder="Residential Address (City/Town)" value="<?php echo $contact['residentialAddrCity']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$address_length); ?></div>
                </div>

                <div class="grid-child">
                    <input class="form-input" name="hometown1" type="text" placeholder="Hometown (Region)" value="<?php echo $contact['hometownCity']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$address_length); ?></div>
                </div>

                <div class="grid-child">
                    <input class="form-input" name="hometown2" type="text" placeholder="Hometown (City/Town)" value="<?php echo $contact['hometownRegion']; ?>">
                    <div class="error"><?php echo $validateEditProfileData->getError(Contstants::$address_length); ?></div>
                </div>


                <div class="grid-child">
                    <input class="form-input" id="file" name="profile-pic" type="file" placeholder="profile-pic" accept="image/*" >
                    <div class="error file-error" style="display:none;"></div>
                </div>
    
                <?php endforeach; ?>
                <div class="submit-btn-wrap"><input class="form-input" id="submit-edit" type="submit" name="submit-edit-info" id="submit-edit-info" value="Save Changes"></div>
                </form>   
            </section>
            
        </div>
    </section>
</body>
</html>
