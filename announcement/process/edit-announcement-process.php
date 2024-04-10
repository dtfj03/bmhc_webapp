<?php
include('..\..\config\config.php');
include('..\controller\edit-announcement-controller.php');


if(isset($_POST['update_announcement']))
{
    // Initialize $db with an instance of DatabaseConnection
    $db = new DatabaseConnection;

    // Escape user input and store in $id
    $id = mysqli_real_escape_string($db->conn, $_POST['announcement_id']);
    
    // Store user input in $inputData
    $inputData = [
        'announcement_title' => $_POST['announcement_title'],
        'announcement_note' => $_POST['announcement_note'],
    ];

    // Instantiate EditAnnouncementController
    $announcement = new EditAnnouncementController;
    
    // Call update method with both parameters
    $result = $announcement->update($inputData, $id);

    // Check if update was successful
    if($result) {
        $_SESSION['message'] = "Announcement Updated Successfully";
    } else {
        $_SESSION['message'] = "Announcement Not Updated";
    }
}


// Check if delete_announcement is set in $_POST
else if(isset($_POST['delete_announcement'])) {
    // Initialize $db with an instance of DatabaseConnection
    $db = new DatabaseConnection;

    // Instantiate DeleteAnnouncementController with $db object
    $announcement = new DeleteAnnouncementController($db);
    
    // Escape user input and store in $id
    $id = mysqli_real_escape_string($db->conn, $_POST['delete_announcement']);
    
    // Call delete method
    $result = $announcement->delete($id);

    // Check if delete was successful
    if($result) {
        $_SESSION['message'] = "Deleted Successfully";
    } else {
        $_SESSION['message'] = "Deletion Failed";
    }
}

// Redirect back to the dashboard
header("Location: ../../dashboard/dashboard.php");
exit(0);

?>