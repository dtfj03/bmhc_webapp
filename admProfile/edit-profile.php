<?php
include('../admLogin/process/login-session.php');
require_once('../config/config.php');
require_once('../dashboard/controller/dashboard-controller.php');
require_once('controller/admin-profile-controller.php');
require_once('controller/change-password-controller.php');

// Check if the user is logged in and if the adminID session variable is set
if (!isset($_SESSION['adminID'])) {
    // If not logged in, redirect to the login page or perform any other action
    header("Location: ../admLogin/index.php");
    exit(); // Stop further execution of the script
}

// Get the adminID from the session
$adminID = $_SESSION['adminID'];

// Perform SQL query to fetch admFname
$sql = "SELECT *, CONCAT(admFname, ' ', admLname) adminName FROM admintbl WHERE adminID = '$adminID'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    // Store the admFname in a variable
    $adminName = $row['adminName'];
    $adminRole = $row['admRole'];
    $adminUsername = $row['username'];
    $adminAddress = $row['admAddress'];
    $adminContact = $row['admContact'];
    $adminPhoto = $row['admPhoto'];
    $adminPassword = $row['admPassword'];
}

$announcements = announcement();
$sched_list = schedule();
$admin_profile = admin_profile();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css?v2">
    <link rel="stylesheet" href="../css/sidebar-style.css">
    <link rel="stylesheet" href="../css/admprofile-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,700,1,0" />
</head>

<body>
<div class="menu-container">
        <div>
        <img src="../media/bmhcmh-logo.png?v2" style="height: 70px; margin: none;">
        </div>
        <div class="menu-title">
            <span style="font-size: 0.9em; font-weight:bolder;">Miranda Health Center<br>
                Multipurpose Hub<br></span>
            <span style="font-size:0.6em;">Brgy. Miranda, Pontevedra, Negros Occidental</span>
        </div>
        <div class="menu-item"><a href="../dashboard/dashboard.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;" title="HOME">home</span></a>
        </div>
        <div class="menu-item"><a href="../schedule/add-schedule.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;" title="SCHEDULE">calendar_month</span></a>
        </div>
        <div class="menu-item"><a href="../patient/add-patient.php">
            <span class="material-symbols-outlined" style="font-size:1.7em; text-decoration: underline;" title="PATIENTS">person_add</span></a>
        </div>
        <div class="menu-item"><a href="../admProfile/edit-profile.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;" title="PROFILE">account_circle</span><br></a>
        </div>
        <div class="menu-item">
            <span style="color: #ca0b00; cursor: pointer; text-decoration: underline;" onclick="location.href='../admLogin/process/logout-session.php'">LOGOUT</span>
        </div>
    </div>

    <div class="sidebar-container">
        <div class="sidebar-wrapper">
        UPCOMING EVENTS
        <hr>
        <?php
            while ($row = mysqli_fetch_assoc($sched_list)) {
                $formatted_date = date('F j, Y', strtotime($row['eventDate']));
                ?>
                <?php echo $formatted_date ?> <br>
                <?php echo $row['eventTitle']; ?> <br>
                <?php echo $row['eventLocation']; ?> <br>
                <a href="../schedule/edit-schedule.php?id=<?=$row['eventID'];?>"><u>Edit Event</u></a>
                <br><br>
            <?php
            }
            ?>
        <br>

        ANNOUNCEMENTS
        <hr>
        <?php
            while ($row = mysqli_fetch_assoc($announcements)) {
                $formatted_date = date('F j, Y', strtotime($row['announcementDate']));
                ?>
                <?php echo $row['announcementTitle']; ?> <br>
                <?php echo $row['announcementNote']; ?> <br>
                posted on <?php echo $formatted_date; ?> <br>
                <a href="../announcement/edit-announcement.php?id=<?=$row['announcementID'];?>"><u>Edit Announcement</u></a>
                <br><br>
            <?php
            }
            ?>
        </div>

    </div>

    <div class="content">
        <div class="profile-container">
            <div class="profile-photo">
                <h>EDIT ADMIN PROFILE</h><br>
                <img src="admPhoto\<?php echo $adminPhoto; ?>" class="admPhoto">
            </div>
            <div class="profile-details">
                <?php echo $adminName; ?> <br>
                <?php echo $adminRole; ?><br>
                <hr>
                <b>Username: </b> <?php echo $adminUsername; ?><br>
                <b>Address: </b> <?php echo $adminAddress; ?><br>
                <b>Contact Number: </b> <?php echo $adminContact; ?><br>
                <br>
                <h>CHANGE PASSWORD</h><br>
                <form method="POST" action="process/change-password-process.php">
                <input type="hidden" name="admin_password" value="<?php echo $adminPassword ?>">
                <label for="current_password">Current Password</label><br>
                <input type="password" name="current_password" /><br>
                <label for="new_password">New Password</label><br>
                <input type="password" name="new_password" /><br>
                <label for="reenter_password">Re-enter password</label><br>
                <input type="password" name="reenter_password" /><br>
                <input type="submit" name="change_password" value="Save password" /> <!-- Ensure name attribute is set -->
            </form>

            </div>
        </div>
    </div>

</body>

</html>
