<?php
include_once('C:\xampp\htdocs\projects\miranda-healthcenter.info\config\dbconn.php');

class EditAnnouncementController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function edit($id)
    {
        $announcement_id = mysqli_real_escape_string($this->conn, $id);
        $announcementQuery = "SELECT * FROM announcementtbl WHERE announcementID='$announcement_id' LIMIT 1";
        $result = $this->conn->query($announcementQuery);
        if($result && $result->num_rows == 1){
            $data = $result->fetch_assoc();
            return $data;
        }else{
            return false;
        }
    }

    public function update($inputData, $id)
    {
        $announcement_id = mysqli_real_escape_string($this->conn, $id);
        $announcement_Title = mysqli_real_escape_string($this->conn, $inputData['announcement_title']);
        $announcement_Note = mysqli_real_escape_string($this->conn, $inputData['announcement_note']);

        $announcementQuery = "UPDATE announcementtbl SET announcementTitle=?, announcementNote=? WHERE announcementID=?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($announcementQuery);
        if (!$stmt) {
            // Handle query preparation error
            return false;
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ssi", $announcement_Title, $announcement_Note, $announcement_id);
        $success = $stmt->execute();
        
        // Check if the update was successful
        if($success){
            $stmt->close(); // Close the statement
            return true;
        }else{
            $stmt->close(); // Close the statement
            return false;
        }
    }
}


class DeleteAnnouncementController
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->conn;
    }

    public function delete($id)
    {
        $announcement_id = mysqli_real_escape_string($this->conn, $id);
        $DeleteQuery = "DELETE FROM announcementtbl WHERE announcementID='$announcement_id' LIMIT 1";
        $result = $this->conn->query($DeleteQuery);
        if($result){
            return true;
        } else {
            return false;
        }
    }
}
?>
