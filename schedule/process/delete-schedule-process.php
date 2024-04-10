<?php
include('..\..\config\config.php');
include('..\controller\edit-schedule-controller.php');

if(isset($_POST['delete_schedule'])) {
    $db = new DatabaseConnection;

    $schedule = new DeleteScheduleController($db);

    $id = mysqli_real_escape_string($db->conn, $_POST['delete_schedule']);

    $result = $schedule->delete($id);

    if($result) {
        $_SESSION['message'] = "Deleted Successfully";
    } else {
        $_SESSION['message'] = "Deletion Failed";
    }
}

// Redirect back to the dashboard
header("Location: ../../dashboard/dashboard.php");
exit(0);