<?php
require_once 'database/Connection.php';
class ManagePayments{
  private $conn;

  public function __construct(){
    $database = new Connection();
    $this->conn = $database->connect();
    return $this->conn;
  }

  private function manageAllowance(){
    $sql = "SELECT * FROM  `allowances`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $allowanceData = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($allowanceData as $allowance): ?>   

          <div class="data-wrap">
            <div class="data">
              <h1><?php echo $allowance['allowance_name']; ?></h1>
            </div>
            <div class="data">
              <h1><?php echo $allowance['allowance_amount']."%"; ?></h1>
            </div>
            <div class="data">
              <h1><?php echo $allowance['allowance_desc']; ?></h1>
            </div>
            <div class="data">
              <button type="button" class="edit" id="<?php echo $allowance['allowance_id'] ?>" name="button">Edit <i class="fa fa-edit"></i></button>
              <button type="button" class="delete" id="<?php echo $allowance['allowance_id'] ?>" name="button"><i class="fa fa-trash-alt"></i></button>
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

  private function manageDeductions(){
    $sql = "SELECT * FROM  `deductions`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $deductionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($deductionsData as $deduction): ?>   

          <div class="data-wrap">
            <div class="data">
              <h1><?php echo $deduction['deduction_name']; ?></h1>
            </div>
            <div class="data">
              <h1><?php echo $deduction['deduction_amount']."%"; ?></h1>
            </div>
            <div class="data">
              <h1><?php echo $deduction['deduction_desc']; ?> </h1>
            </div>
            <div class="data">
              <button type="button" class="edit" name="button" id="<?php echo $deduction['deduction_id'] ?>">Edit <i class="fa fa-edit"></i></button>
              <button type="button" class="delete" name="button" id="<?php echo $deduction['deduction_id'] ?>"><i class="fa fa-trash-alt"></i></button>
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

  public function __destruct(){
    $this->conn = null;
}

  private function managePayroll(){

  }

  public function db_manageAllowance(){
    $this->manageAllowance();
  }

  public function db_manageDeductions(){
    $this->manageDeductions();
  }
  //ADMIN DATA ENDS


  //EMPLOYEE PAYMENT DATA
  private function fetchAllowance(){
    $sql = "SELECT * FROM  `allowances`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $allowanceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($allowanceData as $allowance): ?>
        <tr>
          <td><?php echo ucwords(strtolower($allowance['allowance_name'])); ?></td>
          <td><?php echo $allowance['allowance_amount']."%"; ?></td>
          <td><?php echo $allowance['allowance_desc']; ?></td>
        </tr>
      <?php endforeach;
    }

  }

  private function fetchDeduction(){
    $sql = "SELECT * FROM  `deductions`";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $deductionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($deductionsData as $deduction): ?>
         <tr>
          <td><?php echo ucwords(strtolower($deduction['deduction_name'])); ?></td>
          <td><?php echo $deduction['deduction_amount']."%"; ?></td>
          <td><?php echo $deduction['deduction_desc']; ?></td>
        </tr>
      <?php endforeach;
    }

  }
  public function db_fetchDeduction(){
    $this->fetchDeduction();
  }

  public function db_fetchAllowance(){
    $this->fetchAllowance();
  }


}
