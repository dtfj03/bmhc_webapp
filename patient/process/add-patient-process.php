<?php
session_start();

include('../../config/dbconn.php');
include('..\controller\add-patient-controller.php');

if(isset($_POST['add_patient'])) {
    if(isset($_POST['last_name'], $_POST['first_name'], $_POST['middle_name'], $_POST['patient_sex'], $_POST['patient_dob'], $_POST['patient_purok'], $_POST['patient_purok'], $_POST['patient_pob'], $_POST['patient_pobcity'], $_POST['patient_pobprov'])) {

        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $patient_sex = $_POST['patient_sex'];
        $patient_dob = $_POST['patient_dob'];
        $patient_purok = $_POST['patient_purok'];
        $patient_pob = $_POST['patient_pob'];
        $patient_pobcity = $_POST['patient_pobcity'];
        $patient_pobprov = $_POST['patient_pobprov'];

        $db = new DatabaseConnection;

        $patientController = new AddPatientController($db->conn);

        $inputData = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'patient_sex' => $patient_sex,
            'patient_dob' => $patient_dob,
            'patient_purok' => $patient_purok,
            'patient_pob' => $patient_pob,
            'patient_pobcity' => $patient_pobcity,
            'patient_pobprov' => $patient_pobprov
        ];

        $result = $patientController->create($inputData);

        if($result) {
            // Set session variable to indicate success
            $_SESSION['message'] = "Patient added successfully";
        } else {
            $_SESSION['message'] = "Failed to add patient";
        }
    } else {
        $_SESSION['message'] = "Fill up required details";
    }
}

// Redirect to the referring page (search-patient.php in this case)
header("Location: ../search-patient.php");
exit;
?>
