<?php
require_once "Connection.php";
class CreateTables
{
    private $conn;

    public function __construct()
    {
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }

    private function employeeTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS employee(
        `employee_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `firstName` VARCHAR(40) NOT NULL,
        `lastName` VARCHAR(40) NOT NULL,
        `otherName` VARCHAR(40),
        `password` VARCHAR(250),
        `gender_id` INT,
        `age` INT NOT NULL,
        `dateOfBirth` VARCHAR(30) NOT NULL,
        `marital_status_id` INT,
        `position_id` INT,
        `profilePic` VARCHAR(200) NOT NULL,
        `dateEmployed` VARCHAR(30), 
        FOREIGN KEY (position_id) REFERENCES positions(position_id),
        FOREIGN KEY (gender_id) REFERENCES gender(gender_id),
        FOREIGN KEY (marital_status_id) REFERENCES marital_status(marital_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating employee table";
        }
    }
    private function initialiseAI()
    {
        $sql = "ALTER TABLE employee AUTO_INCREMENT = 340000";
        return $sql;
    }

    private function positionTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS positions(
        `position_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `position` VARCHAR(50) NOT NULL,
        `salary` INT NOT NULL
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating positions table";
        }
    }

    private function contactTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS emp_contact(
        `contact_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `email` VARCHAR(70),
        `telephone` VARCHAR(20) NOT NULL,
        `hometownRegion` VARCHAR(50) NOT NULL,
        `hometownCity` VARCHAR(50) NOT NULL,
        `residentialAddrRegion` VARCHAR(50) NOT NULL,
        `residentialAddrCity` VARCHAR(50) NOT NULL,
        `employee_id` INT,
        FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating CONTACT table";
        }
    }

    private function genderTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS gender(
        `gender_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `gender` VARCHAR(20) NOT NULL
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating gender table";
        }
    }

    private function maritalStatusTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS marital_status(
        `marital_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `status` VARCHAR(20) NOT NULL
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating marital table";
        }
    }

    private function allowancesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS allowances(
        `allowance_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `allowance_name` VARCHAR(40) NOT NULL,
        `allowance_desc` TEXT,
        `allowance_amount` INT NOT NULL
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating allowances table";
        }
    }

    private function deductionsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS deductions(
        `deduction_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `deduction_name` VARCHAR(40) NOT NULL,
        `deduction_desc` VARCHAR(100),
        `deduction_amount` INT NOT NULL
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating deductions table";
        }
    }

    private function attendanceTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS attendance(
        `employee_id` INT NOT NULL,
        `time_in` TIME,
        `time_out` TIME,
        `date` DATE,
        `hours_worked` INT DEFAULT 0,
        `overtime` INT UNSIGNED DEFAULT 0,
        FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating ATTENDANCE TABLE";
        }
    }
    private function reports()
    {
        $sql = "CREATE TABLE IF NOT EXISTS reports(
        `report_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `employee_id` INT NOT NULL,
        `report` TEXT,
        `report_date` VARCHAR(30),
        `reply` TEXT,
        `reply_date` VARCHAR(40),
        FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating REPORTS TABLE";
        }
    }


    private function announcement()
    {
        $sql = "CREATE TABLE IF NOT EXISTS announcement(
        `announcement_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `employee_id` INT NOT NULL,
        `announcement` TEXT,
        `announce_date` VARCHAR(30),
        FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating ANNOUNCEMENT TABLE";
        }
    }

    private function salary()
    {
        $sql = "CREATE TABLE IF NOT EXISTS salary(
        `employee_id` INT NOT NULL,
        `salary` INT,
        FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
        )";
        if ($sql) {
            return $sql;
        } else {
            echo "An error ocurred while creating ANNOUNCEMENT TABLE";
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function create()
    {
        try {
            $this->conn->query($this->positionTable());
            $this->conn->query($this->genderTable());
            $this->conn->query($this->maritalStatusTable());
            $this->conn->query($this->deductionsTable());
            $this->conn->query($this->allowancesTable());
            $this->conn->query($this->employeeTable());
            $this->conn->query($this->initialiseAI());
            $this->conn->query($this->attendanceTable());
            $this->conn->query($this->reports());
            $this->conn->query($this->salary());
            $this->conn->query($this->announcement());
            $this->conn->query($this->contactTable());
        } catch (PDOException $e) {
            echo "An error occured whilst creating table :: " . $e->getMessage();
        }
    }
}



$table = new CreateTables();
$table->create();