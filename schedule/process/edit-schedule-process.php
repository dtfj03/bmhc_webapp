<?php
include('../../config/config.php');
include('../controller/edit-schedule-controller.php');


if(isset($_POST['update_schedule']))
{
    $db = new DatabaseConnection;

    $id = mysqli_real_escape_string($db->conn, $_POST['sched_id']);
    
    $inputData = [
        'sched_title' => $_POST['sched_title'],
        'sched_date' => $_POST['sched_date'],
        'sched_time' => $_POST['sched_time'],
        'sched_location' => $_POST['sched_location'],
        'sched_note' => $_POST['sched_note'],
    ];

    $schedule = new EditScheduleController;
    
    $result = $schedule->update($inputData, $id);

    if($result) {
        $_SESSION['message'] = "Schedule Updated Successfully";
    } else {
        $_SESSION['message'] = "Schedule Not Updated";
    }
}

else if(isset($_POST['delete_schedule'])) {
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