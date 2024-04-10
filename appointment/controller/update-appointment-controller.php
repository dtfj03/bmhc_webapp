<?php
include_once('C:\xampp\htdocs\projects\miranda-healthcenter.info\config\dbconn.php');

class UpdateAppointmentController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function edit($id)
    {
        $appointment_id = mysqli_real_escape_string($this->conn, $id);
        $appointmentQuery = "SELECT * 
                            FROM appointmenttbl a
                            INNER JOIN patienttbl p
                            ON a.patientID = p.patientID
                            WHERE appointmentID='$appointment_id'
                            LIMIT 1";
        $result = $this->conn->query($appointmentQuery);
        if($result && $result->num_rows == 1){
            $data = $result->fetch_assoc();
            return $data;
        }else{
            return false;
        }
    }

    public function update($inputData, $id)
    {
        $appointment_id = mysqli_real_escape_string($this->conn, $id);
        $status = mysqli_real_escape_string($this->conn, $inputData['status']);

        $appointmentQuery = "UPDATE appointmenttbl SET appointmentStatus=? WHERE appointmentID=?"; // Corrected typo
        
        // Prepare the statement
        $stmt = $this->conn->prepare($appointmentQuery);
        if (!$stmt) {
            // Handle query preparation error
            return false;
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("si", $status, $appointment_id);
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

