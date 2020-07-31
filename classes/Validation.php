<?php
include_once 'database/Connection.php';
include 'Constants.php';
date_default_timezone_set("Africa/Accra");
class Validation{
    private $conn;
    private $errorArray;

    public function __construct(){
        $database = new Connection();
        $this->conn = $database->connect();
        $this->errorArray = array();
        return $this->conn;
    }


    public function getError($error){
        if (!in_array($error, $this->errorArray)) {
        $error ="";
        }
        return $error;
    }

    public function editProfileValidation($id,$fName,$lName,$OtherName,$gender,$age,$dateOfBirth,$maritalStatus, $profilePic,$em,$telephone,$residential1,$residential2,$hometown1,$hometown2){
      $this->validateFirstName($fName);
      $this->validateLastName($lName);
      $this->validateOthername($OtherName);
      $this->validateAddr($residential1,$residential2,$hometown1,$hometown2);
      $this->validateEditDataEmail($em);
      $this->validateTelephone($telephone);

      if (empty($this->errorArray)) {
        $picPath = "";
        if (empty($profilePic['name'])) {
          $sql = "SELECT profilePic FROM `employee` WHERE employee_id = ?";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute([$id]);
          if($stmt->rowCount()>0){
            $returnedPath = $stmt->fetchObject();
            $picPath = $returnedPath->profilePic;
            $this->updateData($fName,$lName,$OtherName,$gender,$age,$dateOfBirth,$maritalStatus,$picPath,$id, $em,$telephone,$hometown1,$hometown2,$residential1,$residential2);
          }
        }else{
          //PROCESS SELECTED FILE AND UPDATE PATH
          $fileName = $profilePic['name'];
          $fileTmpName = $profilePic['tmp_name'];
          $fileSize = $profilePic['size'];
          $ext = explode('.', $fileName);
          $fileExt = strtolower(end($ext));
          $allowedFile = array('jpg', 'jpeg', 'png', 'gif');
          
            if (!in_array($fileExt, $allowedFile)) {
              return false;
            }else
            if ($fileSize > 2000000) {
              return false;
            }       
              $fileUniqueName = uniqid("", true).".".$fileExt;
              $fileDestination = "uploads/profilePics/".$fileUniqueName;
              $uploaded = move_uploaded_file($fileTmpName, $fileDestination);
              
              if ($uploaded) {
                $picPath = $fileDestination;
                $this->updateData($fName,$lName,$OtherName,$gender,$age,$dateOfBirth,$maritalStatus,$picPath,$id, $em,$telephone,$hometown1,$hometown2,$residential1,$residential2); 
            }

          }
          return true;
        }
        
      }



       //REGISTER VALIDATION
       public function startEmpValidation($fName,$lName,$OtherName,$password,$gender,$age,$dateOfBirth,$maritalStatus,$position,$profilePic,$dateEmployed,$em,$telephone,$residential1,$residential2,$hometown1,$hometown2){
        $this->validateFirstName($fName);
        $this->validateLastName($lName);
        $this->validateOthername($OtherName);
        $this->validateAddr($residential1,$residential2,$hometown1,$hometown2);
        $this->validateEmail($em);
        $this->validateTelephone($telephone);
        $this->validateProfilePic($profilePic);
 
        if (empty($this->errorArray)) {

          $hash = password_hash($password, PASSWORD_DEFAULT);
          $fileName = $profilePic['name'];
          $fileTmpName = $profilePic['tmp_name'];
          $fileSize = $profilePic['size'];
          $ext = explode('.', $fileName);
          $fileExt = strtolower(end($ext));
          $allowedFile = array('jpg', 'jpeg', 'png', 'gif');
  
          if (!in_array($fileExt, $allowedFile)) {
            return false;
          }else {
            if ($fileSize > 2000000) {
              return false;
            }else {
              
              $fileUniqueName = uniqid("", true).".".$fileExt;
              $fileDestination = "../uploads/profilePics/".$fileUniqueName;
              $uploaded = move_uploaded_file($fileTmpName, $fileDestination);
              if ($uploaded) {
                $picPath = $fileDestination;

                $sql = "INSERT INTO employee(firstName,lastName,otherName,`password`,gender_id,age,dateOfBirth,marital_status_id,position_id,profilePic,dateEmployed) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$fName,$lName,$OtherName,$hash,$gender,$age,$dateOfBirth,$maritalStatus,$position,$picPath,$dateEmployed]);
                $emp_id = $this->conn->lastInsertId();
                $_SESSION['lastID'] = $emp_id;
      
                //INSERT CONTACT INTO CONTACT TABLE
                $contact_sql = "INSERT INTO emp_contact(email,telephone,hometownRegion,hometownCity,residentialAddrRegion,residentialAddrCity,employee_id) VALUES(?,?,?,?,?,?,?)";
                $stmt = $this->conn->prepare($contact_sql);
                $stmt->execute([$em,$telephone,$hometown1,$hometown2,$residential1,$residential2,$emp_id]);
              }
            }
          }

          return true;
        }
     } 
      
     private function validateFirstName($fName){
     if (strlen($fName) > 30 || strlen($fName) <= 2) {
       array_push($this->errorArray, Contstants::$first_name_length);
       return;
     }
     if (is_numeric($fName)) {
       array_push($this->errorArray, Contstants::$first_name_numeric);
       return;
     }
   }
 
     private function validateLastName($lName){
       if (strlen($lName) > 30 || strlen($lName) <= 2) {
         array_push($this->errorArray, Contstants::$last_name_length);
         return;
       }
       if (is_numeric($lName)) {
         array_push($this->errorArray, Contstants::$last_name_numeric);
         return;
       }
     }

     private function validateOthername($OtherName){
       if (is_numeric($OtherName)) {
         array_push($this->errorArray, Contstants::$other_name_numeric);
         return;
       }
     }

     private function validateAddr($residential1,$residential2,$hometown1,$hometown2){
        if (strlen($residential1) > 40 || strlen($residential1) < 3) {
          array_push($this->errorArray, Contstants::$address_length);
          return;
        }
        if (strlen($residential2) > 40 || strlen($residential2) < 3) {
             array_push($this->errorArray, Contstants::$address_length);
            
             return;
        }
        if (strlen($hometown1) > 40 || strlen($hometown1) < 3) {
             array_push($this->errorArray, Contstants::$address_length);
            
             return;
        }
        if (strlen($hometown2) > 40 || strlen($hometown2) < 3) {
             array_push($this->errorArray, Contstants::$address_length);
           
             return;
        }

      }
 
     private function validateEmail($em){
       if (strlen($em) > 60 || strlen($em) < 6) {
         array_push($this->errorArray, Contstants::$email_length);
         return;
       }
       if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
         array_push($this->errorArray, Contstants::$email_invalid);
         return;
       }
       $sql = "SELECT 1 FROM `emp_contact` WHERE email = ?";
       $stmt = $this->conn->prepare($sql);
       $stmt->execute([$em]);
       if($stmt->fetchColumn()){
         array_push($this->errorArray, Contstants::$email_exist);
         return;
       }
     }
 
     private function validateTelephone($telephone){
        if (strlen($telephone) > 12 || strlen($telephone) < 6) {
          array_push($this->errorArray, Contstants::$telephone_length);
          return;
        }
        if (!is_numeric($telephone)) {
           array_push($this->errorArray, Contstants::$telephone_numeric);
           return;
         }
      }


      private function validateProfilePic($profilePic){
        if (empty($profilePic['name'])) {
          array_push($this->errorArray, Contstants::$empty_profilePic);
          return;
          }
      }


      
      private function validateEditDataEmail($em){
        if (strlen($em) > 60 || strlen($em) < 6) {
          array_push($this->errorArray, Contstants::$email_length);
          return;
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
          array_push($this->errorArray, Contstants::$email_invalid);
          return;
        }
      }
      private function updateData($fName,$lName,$OtherName,$gender,$age,$dateOfBirth,$maritalStatus,$path,$id, $em,$telephone,$hometown1,$hometown2,$residential1,$residential2){
        $sql =  "UPDATE employee SET
        firstName = ?,
        lastName = ?,
        otherName = ?,
        gender_id = ?,
        age = ?,
        dateOfBirth = ?,
        marital_status_id = ?,
        profilePic = ?
        WHERE employee_id = ?
      ";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$fName,$lName,$OtherName,$gender,$age,$dateOfBirth,$maritalStatus,$path,$id]);
      $emp_id = $this->conn->lastInsertId();


      $contact_sql =  "UPDATE emp_contact SET
      email = ?,
      telephone = ?,
      hometownRegion = ?,
      hometownCity = ?,
      residentialAddrRegion = ?,
      residentialAddrCity = ?
      WHERE emp_contact.employee_id = ?
    ";
    $stmt = $this->conn->prepare($contact_sql);
    $stmt->execute([$em,$telephone,$hometown1,$hometown2,$residential1,$residential2,$id]);

      }

}



