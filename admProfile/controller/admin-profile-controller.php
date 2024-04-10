<?php

require_once ('..\config\config.php');

function admin_profile() {
    global $conn;
    $query = "SELECT *, UPPER(CONCAT(admFname, ' ', admLname)) adminName FROM admintbl";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>
