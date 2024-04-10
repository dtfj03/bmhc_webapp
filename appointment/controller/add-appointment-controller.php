<?php
include_once('../../config/dbconn.php');

class AddAppointmentController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addAppointment($inputData) {
        $last_name = $inputData['last_name'];
        $first_name = $inputData['first_name'];
        $birthdate = $inputData['birthdate'];
        $service_type = $inputData['service_type'];
        $visit_date = $inputData['visit_date'];
        $note = $inputData['note'];

        // Check if the patient exists in the database
        $patient_query = "SELECT patientID FROM patienttbl WHERE lastName = ? AND firstName = ? AND birthDate = ?";
        $stmt = $this->conn->prepare($patient_query);
        $stmt->bind_param("sss", $last_name, $first_name, $birthdate);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            // Patient exists, fetch patientID
            $row = $result->fetch_assoc();
            $patientID = $row['patientID'];
   
            // Insert appointment data into appointmenttbl
            $appointment_query = "INSERT INTO appointmenttbl (
                                                              patientID, 
                                                              serviceType, 
                                                              dateOfVisit,
                                                              appointmentNote
                                                             ) VALUES (?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($appointment_query);         
            $stmt->bind_param("isss", $patientID, $service_type, $visit_date, $note);
            $result = $stmt->execute(); 
            $stmt->close();

            if($result) {
                return true; // Appointment added successfully
            } else { 
                return false; // Failed to add appointment
            }
        } else {
            return false; // Patient not found in the database
        }
    }
}
?>
