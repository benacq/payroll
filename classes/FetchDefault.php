<?php
include_once 'database/Connection.php';
class FetchDefault{
    private $conn;

    public function __construct(){
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }

    private function getGender(){
        $sql = "SELECT * FROM `gender`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $genders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $genders;
    }
    
    private function getMaritalStatus(){
        $sql = "SELECT * FROM `marital_status`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $maritalStatus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $maritalStatus;
    }

    private function getPositions(){
        $sql = "SELECT * FROM `positions`";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $positions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $positions;
    }
    
    public function db_Gender(){
        return $this->getGender();
    }
    public function db_MaritalStatus(){
        return $this->getMaritalStatus();
    }

    public function db_Positions(){
        return $this->getPositions();
    }

}