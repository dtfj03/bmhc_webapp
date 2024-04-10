<?php
session_start();

include('../../config/dbconn.php');
include('../controller/add-announcement-controller.php');

// Check if form is submitted
if(isset($_POST['save_announcement'])) {
    // Check if title and note are set
    if(isset($_POST['title'], $_POST['note'], $_POST['date'])) {
        // Sanitize input data
        $title = $_POST['title'];
        $note = $_POST['note'];
        $date = $_POST['date'];
        
        // Create DatabaseConnection object
        $db = new DatabaseConnection;
        
        // Create AnnouncementController object
        $announcementController = new AddAnnouncementController($db->conn);
        
        // Create input data array
        $inputData = [
            'title' => $title,
            'note' => $note,
            'date' => $date
        ];
        
        // Attempt to create announcement
        $result = $announcementController->create($inputData);
        
        // Check result and set session message accordingly
        if($result) {
            $_SESSION['message'] = "Announcement added successfully";
        } else {
            $_SESSION['message'] = "Failed to add announcement";
        }
    } else {
        $_SESSION['message'] = "Title is required";
    }
}

// Redirect to dashboard
header("Location: ../../dashboard/dashboard.php");
exit;
?>
