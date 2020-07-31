<?php
class Connection{
  private $serverName;
  private $userName;
  private $password;
  private $dbName;

public function connect(){
  $this->serverName = "localhost";
  $this->userName = "root";
  $this->password = "";
  $this->dbName = "employee_payroll";
  
  try {
    $dsn = "mysql:host=".$this->serverName;
    $pdo = new PDO($dsn, $this->userName, $this->password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query("CREATE DATABASE IF NOT EXISTS $this->dbName");
    $pdo->query("use $this->dbName");
    return $pdo;
  } catch (PDOException $e) {
    echo "Connection failed".$e->getMessage();
  }
 }

}
