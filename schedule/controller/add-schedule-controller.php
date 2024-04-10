<?php
include_once ('..\config\dbconn.php');

class AddScheduleController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($inputData) {
        $title = $inputData['title'];
        $date = $inputData['date'];
        $time = $inputData['time'];
        $location = $inputData['location'];
        $note = $inputData['note'];

        $scheduleQuery = "INSERT INTO eventtbl (eventTitle, eventDate, eventTime, eventLocation, eventNote) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($scheduleQuery);
        $stmt->bind_param("sssss", $title, $date, $time, $location, $note);
        $return = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}