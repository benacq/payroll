<?php
  include_once 'classes/DefaultData.php';
  include_once 'classes/database/CreateTables.php';
  $tables = new CreateTables();
  $tables->create();
  $defaultData = new DefaultData();
  $defaultData->db_AddGender();
  $defaultData->db_AddMaritalStatus();
  $defaultData->db_AddPosition();
  $defaultData->db_AddHr('Ben','Acq','Arhin',1,34,3,1);
  
include "classes/Login.php";
$login = new Login();
include "includes/loginHandler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/login-style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <title>LOGIN</title>
</head>
<body>
    <section id="main-wrapper">
        <div class="form-wrap">
            <h1>LOGIN</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="number" step="1" name="empID" placeholder="Employee ID">
                <div class="id_error"><?php echo $login->getError(Contstants::$id_invalid); ?></div>
                <input type="password" name="password" placeholder="Password">
                <div class="pwd_error"><?php echo $login->getError(Contstants::$password_invalid); ?></div>
                <input type="submit" name="empLogin" value="Sign in">
            </form>
        </div>
    </section>
</body>
</html>