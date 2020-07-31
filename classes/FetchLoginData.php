<?php
include_once 'database/Connection.php';
class LoginData{
    private $conn;

    public function __construct(){
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }
    private function fetchLoginData($id){
        $sql = "SELECT * FROM `employee`
        INNER JOIN positions ON employee.position_id=positions.position_id
        INNER JOIN gender ON employee.gender_id = gender.gender_id
        INNER JOIN marital_status ON employee.marital_status_id = marital_status.marital_id
        WHERE employee_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }

    private function fetchLoginContactData($id){
        $sql = "SELECT * FROM `emp_contact`
        INNER JOIN employee ON emp_contact.employee_id=employee.employee_id WHERE emp_contact.employee_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

    }

    public function db_fetchLoginData($id){
        return $this->fetchLoginData($id);
    }
    public function db_fetchLoginContactData($id){
        return $this->fetchLoginContactData($id);
    }

    private function fetchReports(){
        $sql = "SELECT * FROM `reports`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0){
          $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($reports as $report): ?>
            <tr>
              <td class="emp-id"><?php echo $report['employee_id']; ?></td>
              <td><?php echo $report['report_date']; ?></td>
              <td class="report-content" id="<?php echo $report['report_id']; ?>"><?php echo $report['report']; ?></td>
              <td class="report-action"><i class="fa fa-reply" title="Reply" id="<?php echo $report['report_id']; ?>"></i> <i class="fa fa-trash" title="Delete" id="<?php echo $report['report_id']; ?>"></i></td>
            </tr>
        <?php endforeach;
        }else{
           echo "<div class='no-reports'>No recent reports</div>";
        }
    }
    public function db_fetchReports(){
        $this->fetchReports();
    }
}