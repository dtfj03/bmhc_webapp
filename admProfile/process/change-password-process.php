<?php
session_start();
require_once('../../config/dbconn.php');
require_once('../controller/change-password-controller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs from the form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $reenter_password = $_POST['reenter_password'];
    $admin_password = $_POST['admin_password'];

    // Check if the current password matches the password in the database
    if (password_verify($current_password, $admin_password)) {
        // Check if the new password matches the re-entered password
        if ($new_password === $reenter_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Create an instance of DatabaseConnection
            $db = new DatabaseConnection;

            // Create an instance of ChangePasswordController
            $changepasswordController = new ChangePasswordController();

            // Call the update method to update the password
            $inputData = [
                'current_password' => $current_password,
                'new_password' => $new_password,
            ];
            $result = $changepasswordController->update($inputData, $admin_password);

            if ($result) {
                // Password updated successfully
                $_SESSION['message'] = "Password changed successfully";
                header("Location: ../edit-profile.php");
                exit();
            } else {
                // Failed to update password
                $_SESSION['message'] = "Failed to change password. Please try again.";
                header("Location: ../edit-profile.php");
                exit();
            }
        } else {
            // New passwords do not match
            $_SESSION['message'] = "New passwords do not match";
            header("Location: ../edit-profile.php");
            exit();
        }
    } else {
        // Current password is incorrect
        $_SESSION['message'] = "Incorrect current password";
        header("Location: ../edit-profile.php");
        exit();
    }
}
?>
