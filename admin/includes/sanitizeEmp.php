<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
date_default_timezone_set("Africa/Accra");
function sanitizeNames($target){
  $target = trim($target);
  $target = ucfirst(strtolower($target));
  $target = strip_tags($target);
  $target = stripslashes($target);
  return $target;
}
function sanitizeGPS($target){
  $target = trim($target);
  $target = strip_tags($target);
  $target = stripslashes($target);
  return $target;
}
function sanitizeNum($num){
    filter_var($num,FILTER_SANITIZE_NUMBER_INT);
    return $num;
}

function sanitizeEmail($target){
  $target = trim($target);
  $target = str_replace(' ','',$target);
  $target = strip_tags($target);
  $target = stripslashes($target);
  return $target;
}

function generateRandomString($length = 6) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

if (isset($_POST['submit-emp'])) {

  $first_name = sanitizeNames($_POST['first-name']);
  $last_name = sanitizeNames($_POST['last-name']);
  $other_name = sanitizeNames($_POST['other-name']);
  $residential_addr1 = sanitizeNames($_POST['residentialAddr1']);
  $residential_addr2 = sanitizeNames($_POST['residentialAddr2']);
  $hometown1 = sanitizeNames($_POST['hometown1']);
  $hometown2 = sanitizeNames($_POST['hometown2']);
  // $ghanaPostGPS = sanitizeGPS($_POST['ghanaPostGPS']);
  $email = sanitizeEmail($_POST['email']);
  $phone_num = sanitizeNum($_POST['telephone']);
  $gender = $_POST['gender'];
  $dateOfBirth = $_POST['birth-date'];
  $marital_status = $_POST['marital-status'];
  $position = $_POST['position'];
  $profilePic = $_FILES['profile-pic'];

  $birthDate = $dateOfBirth;
  $date = new DateTime($birthDate);
  $now = new DateTime();
  $interval = $now->diff($date);
  $age = $interval->y;

  $password_default = generateRandomString();
  $now = new DateTime();
  $dateEmployed = $now->format('Y-m-d g:i a');

  $validateEmp = $validate_emp->startEmpValidation($first_name,$last_name,$other_name,$password_default,$gender,$age,$dateOfBirth,$marital_status,$position,$profilePic,$dateEmployed,$email,$phone_num,$residential_addr1,$residential_addr2, $hometown1, $hometown2);

  if (!$validateEmp) {
    echo "<div id='registration-error'>An error occured, please check your input fields for possible errors</div>";
    $password_default = "";
    $lastID = "";
  }else{
    $lastID = $_SESSION['lastID'];
    echo "<div id='registration-success'>Employee added successfully</div>";
    echo "<div style='display:none' id='passHidden'>$password_default</div>";
    echo "<div style='display:none' id='idHidden'>$lastID</div>";
  }
}


if (isset($_POST['submit-edit-info'])) {
  $first_name = sanitizeNames($_POST['first-name']);
  $last_name = sanitizeNames($_POST['last-name']);
  $other_name = sanitizeNames($_POST['other-name']);
  $residential_addr1 = sanitizeNames($_POST['resident1']);
  $residential_addr2 = sanitizeNames($_POST['resident2']);
  $hometown1 = sanitizeNames($_POST['hometown1']);
  $hometown2 = sanitizeNames($_POST['hometown2']);
  // $ghanaPostGPS = sanitizeGPS($_POST['ghanaPostGPS']);
  $email = sanitizeEmail($_POST['email']);
  $phone_num = sanitizeNum($_POST['telephone']);
  $gender = $_POST['gender'];
  $dateOfBirth = $_POST['birth-date'];
  $marital_status = $_POST['marital-status'];
  $profilePic = $_FILES['profile-pic'];
  $id = $_SESSION['empID'];

  $birthDate = $dateOfBirth;
  $date = new DateTime($birthDate);
  $now = new DateTime();
  $interval = $now->diff($date);
  $age = $interval->y;

  $validateEditedData = $validateEditProfileData->editProfileValidation($id,$first_name,$last_name,$other_name,$gender,$age,$dateOfBirth,$marital_status,$profilePic,$email,$phone_num,$residential_addr1,$residential_addr2, $hometown1, $hometown2); 


  if ($validateEditedData) {
    echo " 
      <div id='edit-success'>Changes Saved</div>
    ";
  } 

}

if(isset($_POST['submit-attendance'])){
  $empID = $_POST['emp-id'];
  $time_in = $_POST['time_in'];
  $time_out = $_POST['time_out'];
  $now = new DateTime();
  $secs = strtotime($time_out) - strtotime($time_in)."<br>";

  $date = $now->format('Y-m-d');
  $hrs_worked = intval($secs)/(60*60);
  $overtime = $hrs_worked - 6;
  $empAttendance->db_empAttendance($empID,$time_in,$time_out,$date,$hrs_worked,$overtime);

  // $a_date = '2019-05-20'; 
  // echo date("Y-m-t", strtotime($a_date)); //RETURNS LAST DAY OF MONTH

  // $empName = $_POST['emp-name'];
}


?>




