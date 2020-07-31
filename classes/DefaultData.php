<?php
include_once 'database/Connection.php';
date_default_timezone_set("Africa/Accra");
class DefaultData{
    protected $conn;
    private $errorArray;

    public function __construct(){
        $this->errorArray = array();
        $database = new Connection();
        $this->conn = $database->connect();
        
        return $this->conn;
        }

    private function addGender($gender){
        $sql = "INSERT INTO gender (gender)
        SELECT * FROM (SELECT (?)) AS tmp
        WHERE NOT EXISTS (
            SELECT gender FROM gender WHERE gender = (?)
        ) LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$gender,$gender]);
    }
    
    private function addMaritalStatus($status){
        $sql = "INSERT INTO marital_status (`status`)
        SELECT * FROM (SELECT (?)) AS tmp
        WHERE NOT EXISTS (
            SELECT `status` FROM marital_status WHERE `status` = (?)
        ) LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$status,$status]);

    }
    
    private function addPosition($position,$salary){
        $sql = "INSERT INTO positions (position,salary)
        SELECT * FROM (SELECT (?),(?)) AS tmp
        WHERE NOT EXISTS (
            SELECT `position` FROM positions WHERE `position` = (?)
        ) LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$position,$salary,$position]);
    }
    
    private function addHR($firstName,$lastName,$otherName,$gender_id,$age,$marital_id,$position_id){
      $now = new DateTime();
      $employDate = $now->format('Y-m-d, g:i a');
      $profilePicDefault = "../uploads/profilePics/default.png";
      $birthDate = "1998-05-10";
      $hashed = password_hash('default_password',PASSWORD_DEFAULT);

      $sql = "INSERT IGNORE INTO employee(
        `employee_id`,`firstName`,`lastName`,`otherName`, `password`,`gender_id`,`age`,`dateOfBirth`,`marital_status_id`,`position_id`,`profilePic`,`dateEmployed`
    )VALUES( 
        (?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?),(?)  
        )";
      $stmt = $this->conn->prepare($sql);
      $success = $stmt->execute([340000,$firstName,$lastName,$otherName,$hashed,$gender_id,$age,$birthDate,$marital_id,$position_id,$profilePicDefault,$employDate]);
      if($success){
          $this->addHRcontact('benacq44@gmail.com','0545953496','Central Region','Salt Pont','Greater Accra','Adenta');
      }else {
          echo "error";
      }

    }

    private function addHRcontact($email,$phone,$homeTown1,$homeTown2,$resident1,$resident2){
        $sql = "INSERT IGNORE INTO emp_contact(
            `contact_id`, `email`, `telephone`,	`hometownRegion`, `hometownCity`, `residentialAddrRegion`, `residentialAddrCity`, `employee_id` 
        )VALUES
            ( (?),(?),(?),(?),(?),(?),(?),(?)  )
          ";
          $stmt = $this->conn->prepare($sql);
          $success = $stmt->execute([1,$email,$phone,$homeTown1,$homeTown2,$resident1,$resident2,340000]);
          if($success){
            return true;
          }else {
              return false;
          }

    }

    public function db_AddHr($firstName,$lastName,$otherName,$gender_id,$age,$marital_id,$position_id){
        $this->addHR($firstName,$lastName,$otherName,$gender_id,$age,$marital_id,$position_id);
    }

    public function db_AddGender(){
        $this->addGender('Male');
        $this->addGender('Female');
        $this->addGender('Other');
    }
    
    public function db_AddMaritalStatus(){
        $this->addMaritalStatus('Married');
        $this->addMaritalStatus('Divorced');
        $this->addMaritalStatus('Single');
        $this->addMaritalStatus('Widow');
        $this->addMaritalStatus('Separated');
    }
    
    public function db_AddPosition(){
        $this->addPosition('Human Resource Manager (HR)',7);
        $this->addPosition('Chief Executive Officer (CEO)',10);
        $this->addPosition('Chief Operating Officer',5);
        $this->addPosition('Chief Financial Officer',4.3);
        $this->addPosition('Chief Technology Officer',4);
        $this->addPosition('Recruit',3);
        $this->addPosition('Intern',2);
    }

}


// $data_default = new DefaultData();
// $data_default->db_AddPosition();