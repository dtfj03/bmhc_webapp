<?php
include_once ('C:\xampp\htdocs\projects\miranda-healthcenter.info\config\dbconn.php');

class EditScheduleController {
    public function __construct() {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function edit($id) {
        $sched_id = mysqli_real_escape_string($this->conn,$id);
        $scheduleQuery = "SELECT * FROM eventtbl WHERE eventID='$sched_id' LIMIT 1";
        $result = $this->conn->query($scheduleQuery);
        if($result && $result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function update($inputData, $id) {
        $sched_id = mysqli_real_escape_string($this->conn, $id);
        $sched_title = mysqli_real_escape_string($this->conn, $inputData['sched_title']);
        $sched_date = mysqli_real_escape_string($this->conn, $inputData['sched_date']);
        $sched_time = mysqli_real_escape_string($this->conn, $inputData['sched_time']);
        $sched_location = mysqli_real_escape_string($this->conn, $inputData['sched_location']);
        $sched_note = mysqli_real_escape_string($this->conn, $inputData['sched_note']);
    
        $scheduleQuery = "UPDATE eventtbl SET eventTitle=?, eventDate=?, eventTime=?, eventLocation=?, eventNote=? WHERE eventID=?";
    
        $stmt = $this->conn->prepare($scheduleQuery);
        if (!$stmt) {
            return false;
        }
    
        $stmt->bind_param("sssssi", $sched_title, $sched_date, $sched_time, $sched_location, $sched_note, $sched_id);
        $success = $stmt->execute();
    
        if ($success) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}

class DeleteScheduleController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->conn;
    }

    public function delete($id) {
        $sched_id = mysqli_real_escape_string($this->conn,$id);
        $DeleteQuery = "DELETE FROM eventtbl WHERE eventID = '$sched_id' LIMIT 1";
        $result = $this->conn->query($DeleteQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}