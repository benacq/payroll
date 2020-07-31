<?php
session_start();
include_once 'database/Connection.php';
date_default_timezone_set("Africa/Accra");
class AjaxCalls
{
    private $conn;

    public function __construct()
    {
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////ADD EMPLOYEE FETCH POSITION SALARY//////////////////////////////////////////
    private function getPositionSal($posID)
    {
        $sql = "SELECT `salary` FROM `positions` WHERE position_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$posID]);
        $salary = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($salary as $pay) {
            echo "GHS ".number_format($pay['salary'], 2)."/hr";
        }
    }

    public function db_salary($posID)
    {
        $this->getPositionSal($posID);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////EMPLOYEE MASTERLIST FETCH EMPLOYEE DETAILS///////////////////////////////////
    private function getEmpData($empID)
    {
        $sql = "SELECT
        employee.employee_id,
        employee.firstName,
        employee.lastName,
        employee.otherName,
        employee.dateEmployed,
        positions.*,
        gender.gender,
        marital_status.status
    FROM
        `employee`
    INNER JOIN `positions` ON employee.position_id = positions.position_id
    INNER JOIN `gender` ON employee.gender_id = gender.gender_id
    INNER JOIN `marital_status` 
    ON employee.marital_status_id = marital_status.marital_id
    WHERE employee_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$empID]);
        $empData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contact_sql = "SELECT email,telephone FROM `emp_contact` WHERE employee_id = ?";
        $contact_stmt = $this->conn->prepare($contact_sql);
        $contact_stmt->execute([$empID]);

        if ($contact_stmt->rowCount()>0) {
            $empContact = $contact_stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($empData as $data): ?>  
          <tr>
            <td class="row-title"><strong>Employee ID</strong></td>
            <td><?php echo $data['employee_id']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>First Name</strong></td>
            <td><?php echo $data['firstName']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Last Name</strong></td>
            <td><?php echo $data['lastName']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Other Name</strong></td>
            <td><?php echo $data['otherName']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Position</strong></td>
            <td><?php echo $data['position']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Gross Salary</strong></td>
            <td><?php echo "GHS ".number_format($data['salary'], 2)."/hr"; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Gender</strong></td>
            <td><?php echo $data['gender']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Telephone</strong></td>
            <td><?php foreach ($empContact as $contact) {
                echo $contact['telephone'];
            } ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Email</strong></td>
            <td><?php foreach ($empContact as $contact) {
                echo $contact['email'];
            } ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Marital Status</strong></td>
            <td><?php echo $data['status']; ?></td>
          </tr>
          <tr>
            <td class="row-title"><strong>Date Employed</strong></td>
            <td><?php echo $data['dateEmployed']; ?></td>
          </tr>
    <?php
    endforeach;
        }
    }
    public function db_empData($id)
    {
        $this->getEmpData($id);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////CHANGE PASSWORD////////////////////////////////////////////////////////
    private function changePass($id, $pwd, $cPwd)
    {
        if ($pwd !== $cPwd) {
            return false;
        } elseif (strlen($pwd) <= 5) {
            return false;
        } else {
            $hasedPass = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "UPDATE employee SET `password`=? WHERE employee_id=?";
            $stmt= $this->conn->prepare($sql);
            if ($stmt->execute([$hasedPass,$id])) {
                echo "Password saved";
            } else {
                echo "Something went wrong";
            }
        }
    }
    public function db_changePass($id, $pwd, $cPwd)
    {
        $this->changePass($id, $pwd, $cPwd);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////POST REPORT/////////////////////////////////////////////////
    private function postReport($id, $content)
    {
        $now = new DateTime();
        $reportDate = $now->format('D, M j, Y \a\t g:i a');
        $sql = "INSERT INTO reports(`employee_id`,`report`,`report_date`,reply) VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id, $content, $reportDate,"No Reply"]);
        if ($success) {
            echo "REPORT SUBMITTED SUCCESSFULLY";
        }
    }
    public function db_postReport($id, $content)
    {
        return $this->postReport($id, $content);
    }

    private function replyReport($id, $reply)
    {
        $now = new DateTime();
        $replyDate = $now->format('D, M j, Y \a\t g:i a');

        $sql = "UPDATE reports SET
        `reply` = ?,
        reply_date = ?
        WHERE report_id = ?
      ";
        $stmt= $this->conn->prepare($sql);
        if ($stmt->execute([$reply,$replyDate,$id])) {
            echo "Saved";
        }
    }
    public function db_replyReport($id, $reply)
    {
        $this->replyReport($id, $reply);
    }

    private function deleteReport($id)
    {
        $sql = "DELETE FROM reports WHERE report_id = ?";
        $stmt= $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }
    public function db_deleteReport($id)
    {
        $this->deleteReport($id);
    }

    private function fetchReports()
    {
        $sql = "SELECT reports.* FROM reports";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($reports as $report): ?>
          <div class="sent-report">
              <?php echo $report['report']; ?>
              <div class="sent-date"><?php echo $report['report_date']; ?></div>
          </div>

          <div class="report-reply">
              <?php echo $report['reply']; ?>
              <div class="reply-date"><?php echo $report['reply_date']; ?></div>
          </div>
        <?php endforeach;
        } else {
            echo "No data";
        }
    }
    public function db_fetchReports()
    {
        $this->fetchReports();
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////REPORT END////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////ANNOUNCEMENT/////////////////////////////////////////////////
    private function postAnnouncement($id, $content)
    {
        $now = new DateTime();
        $announceDate = $now->format('D, M j, Y \a\t g:i a');
        $sql = "INSERT INTO announcement(`employee_id`,`announcement`,`announce_date`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$id, $content, $announceDate]);
        if ($success) {
            echo "Announcement Published";
        }
    }
    public function db_postAnnouncement($id, $content)
    {
        $this->postAnnouncement($id, $content);
    }

    private function fetchAnnouncement()
    {
        $sql = "SELECT * FROM `announcement`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($announcements as $announcement): ?>
          <div class="announcement-wrap">
              <div class="announcement"><?php echo $announcement['announcement'] ?><span class="announce-date"><?php echo date('D, M j, Y \a\t g:i a'); ?></span></div>
          </div>
      <?php endforeach;
        } else {
            echo "<div class='no-announcement'>No recent announcements</div>";
        }
    }
    public function db_fetchAnnouncement()
    {
        $this->fetchAnnouncement();
    }

 
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////ALLOWANCE///////////////////////////////////////////////////////////////
    private function addAllowance($aName, $aDesc, $aAmnt)
    {
        $sql = "INSERT INTO allowances(`allowance_name`,`allowance_desc`,`allowance_amount`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$aName, $aDesc, $aAmnt]);
        if ($success) {
            echo "Allowance Saved";
        } else {
            echo "An unexpected error occured...try again later";
        }
    }
    public function db_addAllowance($aName, $aDesc, $aAmnt)
    {
        $this->addAllowance($aName, $aDesc, $aAmnt);
    }

    private function fetcheditAllowance($id)
    {
        $sql = "SELECT * FROM `allowances` WHERE allowance_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $allowances = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($allowances);
        } else {
            echo "No allowance";
        }
    }
    public function db_fetcheditAllowance($id)
    {
        $this->fetcheditAllowance($id);
    }

    private function updateAllowance($id, $name, $percentage, $description)
    {
        $sql = "UPDATE allowances SET
       `allowance_name`=?,
       `allowance_desc`=?,
       `allowance_amount`=?
       WHERE allowance_id=?";
        $stmt= $this->conn->prepare($sql);
        if ($stmt->execute([$name,$description,$percentage,$id])) {
            echo "Saved";
        } else {
            echo "Something went wrong";
        }
    }
    public function db_updateAllowance($id, $name, $percentage, $description)
    {
        $this->updateAllowance($id, $name, $percentage, $description);
    }

    private function deleteAllowance($id)
    {
        $sql = "DELETE FROM allowances WHERE allowance_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }
    public function db_deleteAllowance($id)
    {
        $this->deleteAllowance($id);
    }






    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////DEDUCTION///////////////////////////////////////////////////////////////
    private function fetcheditDeduction($id)
    {
        $sql = "SELECT * FROM `deductions` WHERE deduction_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $deductions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($deductions);
        }
    }
    public function db_fetcheditDeduction($id)
    {
        $this->fetcheditDeduction($id);
    }

    private function addDeduction($dName, $dDesc, $dAmnt)
    {
        $sql = "INSERT INTO deductions(`deduction_name`,`deduction_desc`,`deduction_amount`) VALUES(?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$dName, $dDesc, $dAmnt]);
        if ($success) {
            echo "Deduction Saved";
        } else {
            echo "An unexpected error occured...try again later";
        }
    }
    public function db_addDeduction($dName, $dDesc, $dAmnt)
    {
        $this->addDeduction($dName, $dDesc, $dAmnt);
    }

    private function updateDeduction($id, $name, $percentage, $description)
    {
        $sql = "UPDATE deductions SET
       `deduction_name`=?,
       `deduction_desc`=?,
       `deduction_amount`=?
       WHERE deduction_id=?";
        $stmt= $this->conn->prepare($sql);
        if ($stmt->execute([$name,$description,$percentage,$id])) {
            echo "Saved";
        } else {
            echo "Something went wrong";
        }
    }
    public function db_updateDeduction($id, $name, $percentage, $description)
    {
        $this->updateDeduction($id, $name, $percentage, $description);
    }

    private function deleteDeduction($id)
    {
        $sql = "DELETE FROM deductions WHERE deduction_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }
    public function db_deleteDeduction($id)
    {
        $this->deleteDeduction($id);
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////ATTENDANCE AUTO PREDICT EMPLOYEE NAME////////////////////////////////////////////
    private function getEmpName($id)
    {
        header('Content-type: text/javascript');
        $sql = "SELECT firstName, lastName FROM employee WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $empName = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($empName);
        } else {
            $error = array("error"=>"Please enter a correct ID number");
            echo json_encode($error);
        }
    }
    public function db_getEmpName($id)
    {
        $this->getEmpName($id);
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////PAYSLIP DATA///////////////////////////////////////////////////////
    private function fetchSalaryData($id)
    {
        $sql = "SELECT
        employee.employee_id,
        employee.firstName,
        employee.lastName,
        employee.otherName,
        employee.dateEmployed,
        positions.*
    FROM
        `employee`
    INNER JOIN `positions` ON employee.position_id = positions.position_id
    WHERE employee_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $empData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($empData);
        }
    }
    public function db_fetchSalaryData($id)
    {
        $this->fetchSalaryData($id);
    }

    private function fetchDeductionData()
    {
        $sql = "SELECT * FROM `deductions`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $deductions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($deductions as $deduction): ?>
          <div class="deduction-info-wrap">
              <span class="deduction-name"><?php echo ucwords(strtolower($deduction['deduction_name'])).": "; ?> </span>
              <span class="deduction-value"><?php echo $deduction['deduction_amount']."%"; ?></span>
          </div>
      <?php endforeach;
        }
    }

    public function db_fetchDeductionData()
    {
        $this->fetchDeductionData();
    }

    private function fetchAllowanceData()
    {
        $sql = "SELECT * FROM `allowances`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $allowances = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($allowances as $allowance): ?>
          <div class="allowance-info-wrap">
              <span class="allowance-name"><?php echo ucwords(strtolower($allowance['allowance_name'])).": "; ?> </span>
              <span class="allowance-value"><?php echo $allowance['allowance_amount']."%"; ?></span>
          </div>
      <?php endforeach;
        }
    }

    public function db_fetchAllowanceData()
    {
        $this->fetchAllowanceData();
    }



    private function computeNetIncome($id)
    {
        $totalSal = 0;
        $sql = "SELECT salary FROM `salary` WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $salary) {
                $totalSal += $salary['salary'];
            }
        }

        $totalOvertime = 0;
        $sql = "SELECT `overtime` FROM `attendance` WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $dataPulled) {
                $overtime = $dataPulled['overtime'];
                $totalOvertime += $overtime;
            }
            $payPerOvertime = 1.2;
            $totalSal += $totalOvertime * $payPerOvertime;
        }


        $sql = "SELECT `allowance_amount` FROM `allowances`";
        $totalAllowance = 0;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $allowances = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($allowances as $allowance) {
                $totalAllowance += $allowance['allowance_amount'];
            }
            $addedAllowance = ($totalAllowance/100) * $totalSal;
            $totalSal += $addedAllowance;
        }

        $totalDeduction = 0;
        $sql = "SELECT `deduction_amount` FROM `deductions`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $deductions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($deductions as $deduction) {
                $totalDeduction += $deduction['deduction_amount'];
            }
            $deducted = ($totalDeduction/100) * $totalSal;
            $totalSal -= $deducted;
            echo "GHS ".number_format($totalSal, 2);
        }
    }
    public function db_computeNetIncome($id)
    {
        $this->computeNetIncome($id);
    }

    private function computeGross($id)
    {
        $totalSal = 0;
        $sql = "SELECT salary FROM `salary` WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $salary) {
                $totalSal += $salary['salary'];
            }
        }

        $totalOvertime = 0;
        $sql = "SELECT `overtime` FROM `attendance` WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $dataPulled) {
                $overtime = $dataPulled['overtime'];
                $totalOvertime += $overtime;
            }
            $payPerOvertime = 1.2;
            $totalSal += $totalOvertime * $payPerOvertime;
        }
   
        $sql = "SELECT `allowance_amount` FROM `allowances`";
        $totalAllowance = 0;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()>0) {
            $allowances = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($allowances as $allowance) {
                $totalAllowance += $allowance['allowance_amount'];
            }
            $addedAllowance = ($totalAllowance/100) * $totalSal;
            $totalSal += $addedAllowance;
          
            echo "GHS ".number_format($totalSal, 2);
        }
    }
    public function db_computeGross($id)
    {
        $this->computeGross($id);
    }

    private function getOvertime($id)
    {
        $totalOvertime = 0;
        $sql = "SELECT `overtime` FROM `attendance` WHERE employee_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if ($stmt->rowCount()>0) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $dataPulled) {
                $overtime = $dataPulled['overtime'];
                $totalOvertime += $overtime;
            }
            echo $totalOvertime." hours";
        }
    }
    public function db_getOvertime($id)
    {
        $this->getOvertime($id);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////PAYSLIP DATA ENDS/////////////////////////////////////////////
}


if (isset($_GET['positionID'])) {
    $posID = $_GET['positionID'];
    $ajax = new AjaxCalls();
    $ajax->db_salary($posID);
}
if (isset($_GET['empID'])) {
    $empID = $_GET['empID'];
    $ajax = new AjaxCalls();
    $ajax->db_empData($empID);
}

if (isset($_POST['changePass'])) {
    $id = $_POST['changePass'];
    $pwd = $_POST['pwd'];
    $cPwd = $_POST['cPwd'];
    $ajax = new AjaxCalls();
    $ajax->db_changePass($id, $pwd, $cPwd);
}
if (isset($_POST['submitBtn'])) {
    $empID = $_SESSION['empID'];
    $reportData = $_POST['reportContent'];
    $ajax = new AjaxCalls();
    $ajax->db_postReport($empID, $reportData);
}
if (isset($_GET['replyReport'])) {
    $reportID = $_GET['replyReport'];
    $reportReply = $_GET['reply'];
    $ajax = new AjaxCalls();
    $ajax->db_replyReport($reportID, $reportReply);
}

if (isset($_GET['deleteReport'])) {
    $reportID = $_GET['deleteReport'];
    $ajax = new AjaxCalls();
    $ajax->db_deleteReport($reportID);
}

if (isset($_GET['reports'])) {
    $ajax = new AjaxCalls();
    $ajax->db_fetchReports();
}


if (isset($_POST['submitAnnouncement'])) {
    $empID = $_SESSION['empID'];
    $announcementData = $_POST['announcementData'];
    $ajax = new AjaxCalls();
    $ajax->db_postAnnouncement($empID, $announcementData);
}
if (isset($_GET['fetchAnnoucement'])) {
    $ajax = new AjaxCalls();
    $ajax->db_fetchAnnouncement();
}
if (isset($_POST['addDeduction'])) {
    $ajax = new AjaxCalls();
    $dName = $_POST['deductionName'];
    $dAmntPcntge = $_POST['deductionPercentage'];
    $dDesc = $_POST['deductionDescription'];
    $ajax->db_addDeduction($dName, $dDesc, $dAmntPcntge);
}

if (isset($_POST['addAllowance'])) {
    $ajax = new AjaxCalls();
    $allowaceName = $_POST['allowanceName'];
    $allowanceAmntPcntge = $_POST['allowancePercentage'];
    $allowanceDesc = $_POST['allowanceDescription'];
    $ajax->db_addAllowance($allowaceName, $allowanceDesc, $allowanceAmntPcntge);
}
if (isset($_GET['fetchAllowance'])) {
    $ajax = new AjaxCalls();
    // $ajax->db_fetchAllowance();
}
if (isset($_GET['fetchDeduction'])) {
    $ajax = new AjaxCalls();
    // $ajax->db_fetchDeduction();
}
if (isset($_GET['nameID'])) {
    $id = $_GET['nameID'];
    $ajax = new AjaxCalls();
    $ajax->db_getEmpName($id);
}
if (isset($_GET['fetchEditAllowance'])) {
    $id = $_GET['fetchEditAllowance'];
    $ajax = new AjaxCalls();
    $ajax->db_fetcheditAllowance($id);
}
if (isset($_GET['updateAllowance'])) {
    $id = $_GET['updateAllowance'];
    $allowanceName = $_GET['allowanceName'];
    $allowancePercentage = $_GET['allowancePercentage'];
    $allowanceDesc = $_GET['allowanceDesc'];
    $ajax = new AjaxCalls();
    $ajax->db_updateAllowance($id, $allowanceName, $allowancePercentage, $allowanceDesc);
}
if (isset($_GET['deleteAllowance'])) {
    $id = $_GET['deleteAllowance'];
    $ajax = new AjaxCalls();
    $ajax->db_deleteAllowance($id);
}

if (isset($_GET['fetchEditDeduction'])) {
    $id = $_GET['fetchEditDeduction'];
    $ajax = new AjaxCalls();
    $ajax->db_fetcheditDeduction($id);
}
if (isset($_GET['deleteDeduction'])) {
    $id = $_GET['deleteDeduction'];
    $ajax = new AjaxCalls();
    $ajax->db_deleteDeduction($id);
}

if (isset($_GET['updateDeduction'])) {
    $id = $_GET['updateDeduction'];
    $deductionName = $_GET['deductionName'];
    $deductionPercentage = $_GET['deductionPercentage'];
    $deductionDesc = $_GET['deductionDesc'];
    $ajax = new AjaxCalls();
    $ajax->db_updateDeduction($id, $deductionName, $deductionPercentage, $deductionDesc);
}



if (isset($_GET['fetchSalary'])) {
    $id = $_GET['fetchSalary'];
    $ajax = new AjaxCalls();
    $ajax->db_fetchSalaryData($id);
}
if (isset($_GET['fetchDeductionData'])) {
    $ajax = new AjaxCalls();
    $ajax->db_fetchDeductionData();
}
if (isset($_GET['fetchAllowanceData'])) {
    $ajax = new AjaxCalls();
    $ajax->db_fetchAllowanceData();
}
if (isset($_GET['computeNetIncome'])) {
    $id = $_GET['computeNetIncome'];
    $ajax = new AjaxCalls();
    $ajax->db_computeNetIncome($id);
}
if (isset($_GET['computeGross'])) {
    $id = $_GET['computeGross'];
    $ajax = new AjaxCalls();
    $ajax->db_computeGross($id);
}
if (isset($_GET['getOvertime'])) {
    $id = $_GET['getOvertime'];
    $ajax = new AjaxCalls();
    $ajax->db_getOvertime($id);
}
