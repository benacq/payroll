<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set("Africa/Accra");
include_once "database/Connection.php";
class Logout{
    private $conn;
        public function __construct(){
            $database = new Connection();
            $this->conn = $database->connect();
            return $this->conn;
        }

    public function destroySession($id){
        $now = new DateTime();
        $timeSignOut  = $now->format('g:i a');

        $sql = "UPDATE attendance SET time_out=? WHERE employee_id=?";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([$timeSignOut,$id]);
        session_destroy();
        header("Location: ../login.php");
    }
}
$logout = new Logout();
$logout->destroySession($_SESSION['empID']);