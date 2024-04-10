<?php
session_start();

include('../../config/dbconn.php');
include('../controller/add-schedule-controller.php');

if(isset($_POST['add_schedule'])) {
    if(isset($_POST['title'], $_POST['date'], $_POST['time'], $_POST['location'], $_POST['note'])) {

        $title = $_POST['title'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $note = $_POST['note'];

        $db = new DatabaseConnection;

        $scheduleController = new AddScheduleController($db->conn);

        $inputData = [
            'title' => $title,
            'date' => $date,
            'time' => $time,
            'location' => $location,
            'note' => $note
        ];

        $result = $scheduleController->create($inputData);

        if($result) {
            $_SESSION['message'] = "Schedule added successfully";
        } else {
            $_SESSION['message'] = "Failed to add schedule";
        }
    } else {
        $_SESSION['message'] = "Fill up required details";
    }
}

header("Location: ../../dashboard/dashboard.php");
exit;