<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "group17"; // Update this with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
