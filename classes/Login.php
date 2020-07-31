<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "database/Connection.php";
include_once 'Constants.php';
date_default_timezone_set("Africa/Accra");
class Login{
    private $conn;
    private $errorArray;

    public function __construct(){
        $database = new Connection();
        $this->conn = $database->connect();
        $this->errorArray = array();
        return $this->conn;
    }

    private function empLogin($empID,$password){
        $sql = "SELECT employee_id,`password` FROM employee WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$empID]);
        if ($stmt->rowCount() > 0) {
            $empLoginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($empLoginData as $loginData):  
            if (password_verify($password, $loginData['password'])) {  
                $_SESSION['empID'] = $empID;
                return true;
              }else{
                array_push($this->errorArray,Contstants::$password_invalid);
              }
            endforeach;
        }else{
            array_push($this->errorArray,Contstants::$id_invalid);
        }
    }

    public function getError($error){
        if (!in_array($error, $this->errorArray)) {
        $error ="";
        }
        return $error;
    }

    public function db_login($empID,$password){
        return $this->empLogin($empID,$password);
    }

    // public function upDateHrsWorked($id){
    //     $time_sql = "SELECT time_in,hours_worked FROM attendance WHERE employee_id = ?";
    //     $stmt = $this->conn->prepare($time_sql);
    //     $stmt->execute([$id]);
    //     $attendanceData = $stmt->fetchObject();
    //     if($stmt->rowCount()>0){
    //         $time =  strtotime($attendanceData->time_in);
    //         $timeDiff = time() - $time;        
    //         $hrsWorked = date('H', $timeDiff);

    //         $sql = "UPDATE attendance SET hours_worked=? WHERE employee_id=?";
    //         $stmt= $this->conn->prepare($sql);
    //         $stmt->execute([$hrsWorked,$id]);
    //     }
    // }

}


// if(isset($_POST['empHrsID'])){
//     $empID = $_POST['empHrsID'];
//     $updateHours = new Login();
//     $updateHours->upDateHrsWorked($empID);
// }
// $updateHours = new Login();
// $updateHours->upDateHrsWorked(340000);
