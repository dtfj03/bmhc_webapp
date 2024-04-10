<?php
include('../config/dbconn.php');

class ChangePasswordController
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->getConnection(); // Change the method name to getConnection
    }

    public function edit($admin_password) {
        $admin_pass = mysqli_real_escape_string($this->conn, $admin_password);
        $passwordQuery = "SELECT * FROM admintbl WHERE admPassword='$admin_pass' LIMIT 1";
        $result = $this->conn->query($passwordQuery);
        if($result && $result->num_rows == 1) { // Add $ before result
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function update($inputData, $admin_password) {
        $current_password = mysqli_real_escape_string($this->conn, $inputData['current_password']);
        $new_password = mysqli_real_escape_string($this->conn, $inputData['new_password']);

        // Update the password in the database
        $passwordQuery = "UPDATE admintbl SET admPassword=? WHERE admPassword=?";

        $stmt = $this->conn->prepare($passwordQuery);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ss", $new_password, $admin_password);
        $success = $stmt->execute();

        if ($success) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
}
?>
