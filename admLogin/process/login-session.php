<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "group17";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform SQL query to validate the credentials
    $sql = "SELECT * FROM admintbl WHERE username = '$username' AND admPassword = '$password'";
    $result = $conn->query($sql);

    // If there is a match, start a session and store the adminID in a session variable
    if ($result->num_rows > 0) {
        // Fetch the adminID from the result set
        $row = $result->fetch_assoc();
        $adminID = $row['adminID'];

        // Store the adminID in a session variable
        $_SESSION['adminID'] = $adminID;

        // Redirect to a secure page or perform any other actions
        header("Location: ../../dashboard/dashboard.php");
        exit();
    } else {
        // If credentials are invalid, redirect back to login page
        header("Location: ../login.php");
        exit();
    }
}

// Close the database connection
$conn->close();
