<?php
include_once('..\..\config\dbconn.php');

class AddAnnouncementController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function create($inputData)
    {
        $title = $inputData['title'];
        $note = $inputData['note'];
        $date = $inputData['date'];

        $announcementQuery = "INSERT INTO announcementtbl (announcementTitle, announcementNote, announcementDate) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($announcementQuery);
        $stmt->bind_param("sss", $title, $note, $date);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>