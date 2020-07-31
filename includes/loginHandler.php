<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function sanitizeNum($num){
    filter_var($num,FILTER_SANITIZE_NUMBER_INT);
    return $num;
}
if (isset($_POST['empLogin'])) {
    $empID = htmlentities(sanitizeNum($_POST['empID']));
    $empPassword = htmlentities($_POST['password']);
    $valid_data = $login->db_login($empID,$empPassword);
    if($valid_data){
        header("Location: index.php");
    }else{
        return false;
    }
}
?>  