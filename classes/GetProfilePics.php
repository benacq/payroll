<?php
include_once 'database/Connection.php';
class GetProfilePic{
    protected $conn;
    // private $errorArray;

    public function __construct(){
        $this->errorArray = array();
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
        }

        private function fetchPic(){
            $sql = "SELECT `profilePic` FROM `employee`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $pic = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pic;
        }

        public function  loadPic(){
            $this->fetchPic();
        }

}

// // $testString1 = "../uploads/profilePics/5cac93dd3ef0c1.36967926.jpg";
// $testString2 = "uploads/profilePics/5cac93dd3ef0c1.36967926.jpg";
// echo strstr($testString2,'uploads')."<br>";
