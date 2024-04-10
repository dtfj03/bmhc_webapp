<?php
include('../../config/config.php');
include('..\controller\update-appointment-controller.php'); // Corrected include statement

if(isset($_POST['update_appointment']))
{
    // Initialize $db with an instance of DatabaseConnection
    $db = new DatabaseConnection;

    // Escape user input and store in $id
    $id = mysqli_real_escape_string($db->conn, $_POST['appointment_id']);
    
    // Store user input in $inputData
    $inputData = [
        'status' => $_POST['status'],
    ];

    // Instantiate UpdateAppointmentController
    $appointment = new UpdateAppointmentController;
    
    // Call update method with both parameters
    $result = $appointment->update($inputData, $id);

    // Check if update was successful
    if($result) {
        $_SESSION['message'] = "Appointment Updated Successfully";
    } else {
        $_SESSION['message'] = "Appointment Not Updated";
    }
}

// Redirect back to the dashboard
header("Location: ../../dashboard/dashboard.php");
exit(0);

?>
