<?php
include_once 'database/Connection.php';
class ManageEmployee{
  private $conn;

  public function __construct(){
      $database = new Connection();
      $this->conn = $database->connect();
      return $this->conn;
    }

    private function employeeMasterlist(){

      $sql = "SELECT employee.employee_id, employee.firstName,employee.lastName, positions.position, positions.salary FROM `employee` INNER JOIN `positions` ON employee.position_id = positions.position_id ORDER BY employee.employee_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      if($stmt->rowCount()>0){
        $employeeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // return $employeeData;
        foreach ($employeeData as $employee): ?> 
          <div class='data-wrap'>
            <div class='data fname'>
              <h1><?php echo $employee['firstName']; ?></h1>
            </div>
            <div class='data lname'>
              <h1><?php echo $employee['lastName']; ?></h1>
            </div>
            <div class='data position'>
              <h1><?php echo $employee['position']; ?></h1>
            </div>
            <div class='data salary'>
              <h1><?php echo "GHS ".number_format($employee['salary'],2); ?></h1>
            </div>
            <div class='data more-info'>
              <i class='fa fa-info-circle' id="<?php echo $employee['employee_id']; ?>"></i>
            </div>
          </div>
        <?php endforeach;
      }else{
        echo "
        <div class='data no-data-error'>
          <h1>No data retrieved from the database</h1>
        </div>
        ";
      }
    }

    
    private function empAttendance($emp_id,$time_in,$time_out,$date,$hours_worked,$overtime){
      $salFixed = 0;
      $sql = "INSERT INTO attendance(`employee_id`,`time_in`,`time_out`,`date`,`hours_worked`,`overtime`) VALUES(?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$emp_id,$time_in,$time_out,$date,$hours_worked,$overtime]);

      $rateSql = "SELECT positions.* FROM employee
      INNER JOIN positions on employee.position_id = positions.position_id
      WHERE employee.employee_id = ?
      ";
      $stmt = $this->conn->prepare($rateSql);
      $stmt->execute([$emp_id]);
      if ($stmt->rowCount()>0) {
        $salary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($salary as $pay) {
          $salFixed = $pay['salary'];
        }
      }
      $salSql = "INSERT INTO salary(employee_id, salary) VALUES (?,?)";
      $stmt = $this->conn->prepare($salSql);
      $stmt->execute([$emp_id,($salFixed*($hours_worked-$overtime))]);
    }

    public function fetchAnnouncement(){
      $sql = "SELECT * FROM `announcement` LIMIT 4";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      if($stmt->rowCount()>0){
        $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($announcements as $announcement): ?>
          <div class="activity" style="padding-left:5px; font-size:17px;">
            <h1><a href="announcement.php" style="color:cornflowerblue; font-size:15px; margin-bottom:5px; font-style:italic;">Announcement</a></h1>
            <?php echo $announcement['announcement']; ?>
          </div>
        <?php endforeach;
      }else{
        echo "<div style='text-align:center;color:cornflowerblue;font-weight:600;'>NO RECENT ACTIVITIES</div>";
      }
    }


    public function __destruct(){
      $this->conn = null;
  }
    public function publicEmpAll(){
      return $this->employeeMasterlist();
    }

    public function db_empAttendance($emp_id,$time_in,$time_out,$date,$hours_worked,$overtime){
      return $this->empAttendance($emp_id,$time_in,$time_out,$date,$hours_worked,$overtime);
    }

    

}

