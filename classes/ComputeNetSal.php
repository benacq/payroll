<?php
session_start();
include_once "database/Connection.php";
class ComputeNetSalary{
    private $conn;
    private $totalOvertime = 0;
    private $totalHrsWorked = 0;

    public function __construct(){
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }



    private function fetchAttendance(){
      $sql = "SELECT `hours_worked`,`overtime` FROM `attendance` WHERE employee_id = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$_SESSION['empID']]);
      if($stmt->rowCount()>0){
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $dataPulled) {
         $overtime = $dataPulled['overtime'];
         $hours_worked = $dataPulled['hours_worked'];
         $this->totalOvertime += $overtime;
         $this->totalHrsWorked += $hours_worked;
        }
        echo $this->totalOvertime."<br>";
        echo $this->totalHrsWorked - $this->totalOvertime."<br>";
      }else{
        echo "No data"."<br>";
      }
    }


    public function db_hoursANDovertime(){
      // var_dump($this->fetchAttendance());
      $this->fetchAttendance();
   }





































    private function fetchAllowance(){
        $sql = "SELECT `allowance_name`,`allowance_amount` FROM `allowances`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
          $allowances = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($allowances as $allowance) {
            $this->allowa += $allowance['allowance_amount'];
          }
          echo $this->allowa/100;
        }else{
            echo "No data";
        }
      }     
  
      private function fetchDeduction(){
        $sql = "SELECT `deduction_name`,`deduction_amount` FROM `deductions`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
          $deductions = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $deductions; 
        }else{
          echo "No data"."<br>";
        }
      }

     



    
      private function fetchGross(){
        $currentEmp = $_SESSION['empID'];

        $sql = "SELECT employee.employee_id,positions.salary FROM `employee`
          INNER JOIN positions ON employee.position_id = positions.position_id
          WHERE employee.employee_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$currentEmp]);
        if($stmt->rowCount()>0){
          $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $data; 
        }else{
          echo "No data"."<br>";
        }
      }


    private function calNetPay(){
      $deductions = $this->fetchDeduction();
      $allowances = $this->fetchAllowance();
      $grossPay = $this->fetchGross();
      foreach ($grossPay as $gross) {
        echo $gross['salary'];
      }
    }

  


}

$testNetSal = new ComputeNetSalary();
$testNetSal->db_hoursANDovertime();