<?php
include_once('../../config/dbconn.php');

class AddPatientController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($inputData) {
        $last_name = $inputData['last_name'];
        $first_name = $inputData['first_name'];
        $middle_name = $inputData['middle_name'];
        $patient_sex = $inputData['patient_sex'];
        $patient_dob = $inputData['patient_dob'];
        $patient_purok = $inputData['patient_purok'];
        $patient_pob = $inputData['patient_pob'];
        $patient_pobcity = $inputData['patient_pobcity'];
        $patient_pobprov = $inputData['patient_pobprov'];
    
        $patientQuery = "INSERT INTO patienttbl (lastName, firstName, middleName, patientSex, birthDate, addressPurok, placeOfBirth, pobCity, pobProv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($patientQuery);
        $stmt->bind_param("sssssssss", $last_name, $first_name, $middle_name, $patient_sex, $patient_dob, $patient_purok, $patient_pob, $patient_pobcity, $patient_pobprov);
        
        // Execute the query and handle errors
        if ($stmt->execute()) {
            $stmt->close();
            return true; // Successful insertion
        } else {
            // Log the error and return false
            error_log("Error: " . $this->conn->error);
            $stmt->close();
            return false;
        }
    }
    
    }
