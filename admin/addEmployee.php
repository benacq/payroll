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

include_once '../classes/FetchDefault.php'; 
include_once '../classes/Validation.php'; 
$validate_emp = new Validation();
include_once 'includes/sanitizeEmp.php'; 
function setValue($target){
  if (isset($_POST[$target])) {
    echo $_POST[$target];
  }else{
    echo "";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sideBarStyle.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/addemp-script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>REGISTER EMPLOYEE</title>
  </head>
  <body id="body">
 
    <section id="main-wrapper">
      <?php include 'includes/nav.php'; ?>
      <?php 
      include 'includes/sideBar.php';
      $fetchSysDefault = new FetchDefault();
      $genders = $fetchSysDefault->db_Gender();
      $positions = $fetchSysDefault->db_Positions();
      array_shift($positions);
      $m_status = $fetchSysDefault->db_MaritalStatus();
      ?>

      <section class="work-area">
        <h1 class="page-header">Add Employee</h1>

        <div class="content">
          <form id="addEmployeeForm"  method="POST" action="addEmployee.php" enctype="multipart/form-data">
          <h1 class="form-title">PERSONAL DETAILS</h1>
              <div class="input-container-grid form-toggle">

                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="text" name="first-name" class="form-input" id="first-name" placeholder="First Name" value="<?php setValue('first-name');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$first_name_length); ?></div>
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$first_name_numeric); ?></div>
                  </div>
                  
                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="text" name="last-name" class="form-input" id="last-name" placeholder="Last Name" value="<?php setValue('last-name');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$last_name_length); ?></div>
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$last_name_numeric); ?></div>
                  </div>

                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="text" name="other-name" class="form-input" id="other-name" placeholder="Other Name" value="<?php setValue('other-name');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$other_name_numeric); ?></div>
                  </div>

                  <div class="input-container-grid-child">
                    <select name="gender" class="form-input" id="gender" form="addEmployeeForm">
                    <?php foreach ($genders as $gender): ?>
                      <option value="<?php echo $gender['gender_id']; ?>"><?php echo $gender['gender']; ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>


                  <div class="input-container-grid-child">
                    <select name="marital-status" class="form-input" id="marital-status" form="addEmployeeForm">
                      <?php foreach ($m_status as $marital): ?>
                        <option value="<?php echo $marital['marital_id']; ?>"><?php echo $marital['status']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="input-container-grid-child">
                    <input type="date" name="birth-date" class="form-input" id="birth-date">
                  </div>
              
              </div>

              <h1 class="form-title form-title-hidden">CONTACT DETAILS</h1>
              <div class="input-container-grid form-toggle form-hidden-default">
                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="email" name="email" class="form-input" id="email" placeholder="Email" value="<?php setValue('email');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$email_length); ?></div>
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$email_invalid); ?></div>
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$email_exist); ?></div>
                  </div>
                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="telephone" name="telephone" class="form-input" id="telephone" placeholder="Telephone (+233) _ _ _  _ _ _  _ _" value="<?php setValue('telephone');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$telephone_length); ?></div>
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$telephone_numeric); ?></div>
                  </div>
                  <div class="input-container-grid-child">
                    <input type="text" name="residentialAddr1" class="form-input" id="residentialAddr1" placeholder="Residential Address (Region)" value="<?php setValue('residentialAddr1');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$address_length); ?></div>

                  </div>
                  <div class="input-container-grid-child">
                    <input type="text" name="residentialAddr2" class="form-input" id="residentialAddr2" placeholder="Residential Address (City/Town)" value="<?php setValue('residentialAddr2');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$address_length); ?></div>
                  </div>
                  <div class="input-container-grid-child">
                    <input type="text" name="hometown1" class="form-input" id="hometown1" placeholder="Hometown (Region)" value="<?php setValue('hometown1');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$address_length); ?></div>
                  </div>
                  <div class="input-container-grid-child">
                    <input type="text" name="hometown2" class="form-input" id="hometown2" placeholder="Hometown (City/Town)" value="<?php setValue('hometown2');?>">
                    <div class="error"><?php echo $validate_emp->getError(Contstants::$address_length); ?></div>
                  </div>
              </div>
              <h1 class="form-title form-title-hidden">EMPLOYEE DETAILS</h1>
              <div class="input-container-grid form-toggle form-hidden-default">
                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <select name="position" class="form-input" id="position" form="addEmployeeForm">
                      <?php foreach ($positions as $position): ?>
                        <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="input-container-grid-child" style="grid-column: 1 / 3;">
                    <input type="text" name="salary" class="form-input" id="positionSalary" value="GHS 10.00/hr" disabled>
                  </div>
                  <div class="input-container-grid-child">
                    <input type="file" name="profile-pic" class="form-input" id="profile-pic">
                  </div>
                  <div class="input-container-grid-child">
                    <div class="error profile-pic-error"><?php echo $validate_emp->getError(Contstants::$empty_profilePic); ?></div>
                    <input type="text" name="pass-pic-info" class="form-input" id="pass-pic-info" placeholder="Upload a passport sized photo" disabled>
                  </div>
                  <div class="submit-btn-wrap">
                    <input type="submit" name="submit-emp" value="Add Employee">
                  </div>
              </div>

              <div class= "carousel-wrap">
                  <span class="carousel-control carousel-active"></span> 
                  <span class="carousel-control"></span> 
                  <span class="carousel-control"></span> 
              </div>
          </form>
        </div>
        <div id="passWrap"><span id="dispPass"></span><br> <span id="dispID"></span><br> <span id="countDown"></span></div>
        <div id="caution">Employees are required to change their passwords on their first Login</div>
      </section>
    </section>
    
  </body>
</html>
<!--password: SzAOhh -->