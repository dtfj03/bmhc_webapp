<?php
session_start();

include('../../config/dbconn.php');
include('../controller/add-appointment-controller.php');

if(isset($_POST['add_appointment'])) {
    if(isset($_POST['last_name'], $_POST['first_name'], $_POST['birthdate'], $_POST['service_type'], $_POST['visit_date'], $_POST['note'])) {

        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $birthdate = $_POST['birthdate'];
        $service_type = $_POST['service_type'];
        $visit_date = $_POST['visit_date'];
        $note = $_POST['note'];

        $db = new DatabaseConnection;

        $addAppointmentController = new AddAppointmentController($db->conn);

        $inputData = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'birthdate' => $birthdate,
            'service_type' => $service_type,
            'visit_date' => $visit_date,
            'note' => $note
        ];

        $result = $addAppointmentController->addAppointment($inputData);

        if($result) {
            $_SESSION['message'] = "Appointment added successfully";
        } else {
            $_SESSION['message'] = "Failed to add appointment";
        }
    } else {
        $_SESSION['message'] = "Fill up required details";
    }
}

header("Location: ../add-appointment.php");
exit;
?>
