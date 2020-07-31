<?php
include_once 'database/Connection.php';
class Reports{


    public function __construct()
    {
        $database = new Connection();
        $this->conn = $database->connect();
        return $this->conn;
    }

    ///////////////////////////////////// INSERTS /////////////////////////////////////////////////////////

    private function add_gwer_report($volumeID, $reportID, $reportTitle, $reportSummary, $reportHighlights, $reportThisIssue, $reportDescription, $reportAuthors)
    {
        $now = new DateTime();
        $reportDate = $now->format('D, M j, Y \a\t g:i a');

        $sql = "INSERT INTO `gwer_report`(`Volume_id`,`Report_id`,`Report_title`,`Report_summary`,`Report_highlights`,`Report_this_issue`,`Report_date`,`Report_description`,`Report_authors`) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$volumeID, $reportID, $reportTitle, $reportSummary, $reportHighlights, $reportThisIssue, $reportDate, $reportDescription, $reportAuthors]);
        if ($success) {
            echo "New report added";
        }
    }


    private function add_gwer_volume($volumeID, $volumeTitle, $volumeYear, $volumeDescription)
    {
      
        $sql = "INSERT INTO `add_gwer_volume`(`Volume_id`,`Volume_title`,`Volume_year`,`Volume_description`) VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$volumeID, $volumeTitle, $volumeYear, $volumeDescription]);
        if ($success) {
            echo "New volume added";
        }
    }


    private function add_user($ID, $firstName, $lastName, $email, $password, $role)
    {
      
        $sql = "INSERT INTO `users`(`ID`,`FirstName`,`LastName`,`Email`,`Password`,`Role`) VALUES(?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $success = $stmt->execute([$ID, $firstName, $lastName, $email, $password, $role]);
        if ($success) {
            echo "New user added";
        }
    }


    ///////////////////////////////////// UPDATES /////////////////////////////////////////////////////////
    private function update_gwer_report($volumeID, $reportID, $reportTitle, $reportSummary, $reportHighlights, $reportThisIssue, $reportDescription, $reportAuthors)
    {    
        $sql = "UPDATE `gwer_report` SET
        `Volume_id` = ?,
        `Report_title`= ?,
        `Report_summary`= ?,
        `Report_highlights`= ?,
        `Report_this_issue`= ?,
        `Report_description`= ?,
        `Report_authors`= ?
        WHERE Report_id=?";
         $stmt= $this->conn->prepare($sql);
         if ($stmt->execute([$volumeID, $reportTitle, $reportSummary, $reportHighlights, $reportThisIssue, $reportDescription, $reportAuthors, $reportID])) {
             echo "Saved";
         } else {
             echo "Something went wrong";
         }
    }

    private function update_gwer_volume($volumeID, $volumeTitle, $volumeYear, $volumeDescription)
    {    
        $sql = "UPDATE `gwer_volume` SET
        `Volume_title`= ?,
        `Volume_year`= ?,
        `Volume_description`= ?
        WHERE Volume_id=?";
         $stmt= $this->conn->prepare($sql);
         if ($stmt->execute([$volumeTitle, $volumeYear, $volumeDescription,$volumeID])) {
             echo "Saved";
         } else {
             echo "Something went wrong";
         }
    }


    private function update_user($ID, $firstName, $lastName, $email, $password, $role)
    {    
        $sql = "UPDATE `users` SET
        `FirstName` = ?,
        `LastName`= ?,
        `Email`= ?,
        `Password`= ?,
        `Role`= ?
        WHERE `ID`=?";
         $stmt= $this->conn->prepare($sql);
         if ($stmt->execute([$firstName, $lastName, $email, $password, $role, $ID])) {
             echo "Saved";
         } else {
             echo "Something went wrong";
         }
    }



    ///////////////////////////////////// DELETE /////////////////////////////////////////////////////////
    private function delete_gwer_report($id)
    {
        $sql = "DELETE FROM `delete_gwer_report` WHERE Report_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }
    private function delete_gwer_volume($id)
    {
        $sql = "DELETE FROM `delete_gwer_volume` WHERE Volume_id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }

    private function delete_user($id)
    {
        $sql = "DELETE FROM `users` WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Deleted";
        }
    }
    

    
}