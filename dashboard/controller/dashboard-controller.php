<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "group17";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function appointment_table(){
    global $conn;
    $query = "SELECT *, CONCAT(lastName, ', ', firstName) patientName FROM appointmenttbl a INNER JOIN patienttbl p ON p.patientID = a.patientID WHERE dateOfVisit >= CURDATE() ORDER BY dateOfVisit ASC;";
    $result = mysqli_query($conn, $query);
    return $result;
}

function announcement(){
    global $conn;
    $query = "SELECT * FROM announcementtbl;";
    $result = mysqli_query($conn, $query);
    return $result;
}

function schedule(){
    global $conn;
    $query = "SELECT * FROM eventtbl WHERE eventdate >= CURDATE() ORDER BY eventdate ASC;";
    $result = mysqli_query($conn, $query);
    return $result;
}

function past_schedule(){
    global $conn;
    $query = "SELECT * FROM eventtbl WHERE eventdate <= CURDATE() ORDER BY eventdate ASC;";
    $result = mysqli_query($conn, $query);
    return $result;
}