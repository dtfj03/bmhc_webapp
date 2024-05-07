<?php

    include('../admLogin/process/login-session.php');
    require_once('../config/config.php');
    require_once('controller/dashboard-controller.php');

    // Check if the user is logged in and if the adminID session variable is set
    if (!isset($_SESSION['adminID'])) {
        // If not logged in, redirect to the login page or perform any other action
        header("Location: ../admLogin/index.php");
        exit(); // Stop further execution of the script
}
    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();
    $adminID = $_SESSION['adminID'];

    $sql = "SELECT * FROM admintbl WHERE adminID = $adminID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admPhoto = $row['admPhoto'];
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css?v2">
    <link rel="stylesheet" href="../css/sidebar-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,700,1,0" />
    <style>
        th, td { border: 3px solid #388e3c; }
        hr { border: 1px solid #388e3c; }
    </style>
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
        <div class="menu-item"><a href="dashboard.php">
            <span class="material-symbols-outlined" style="font-size:1.7em; text-decoration: underline;" title="HOME">home</span></a>
        </div>
        <div class="menu-item"><a href="../schedule/add-schedule.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;" title="SCHEDULE">calendar_month</span></a>
        </div>
        <div class="menu-item"><a href="../patient/add-patient.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;" title="PATIENTS">person_add</span></a>
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
        APPOINTMENTS<br>
        <table id="myTable" border="1">
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Request</th>
                    <th>Date of Visit</th>
                    <th>Status</th>
                </tr>
            <tr>
                <?php
                while ($row = mysqli_fetch_assoc($result_table)) {
                    ?>
                    <td><?php echo $row['patientID']; ?> </td>
                    <td><?php echo $row['patientName']; ?> </td>
                    <td><?php echo $row['serviceType']; ?> </td>
                    <td><?php echo $row['dateOfVisit']; ?> </td>
                    <td><a href="../appointment/update-appointment.php?id=<?php echo $row['appointmentID']; ?>"><u><?php echo $row['appointmentStatus']; ?></u></a></td>

                </tr>
                <?php
                }
                ?>
            </tr>
        </table><br>

        ADD NEW ANNOUNCEMENT<br>
        <form action="../announcement/process/add-announcement-process.php" method="POST">
        <label for="title">Title</label><br>
        <input type="text" name="title" required/><br>
        <label for="note">Additional Note</label><br>
        <input type="text" name="note"/><br>
        <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" hidden>
        <input type="submit" name="save_announcement" value="Add Announcement" />
            </form>

    </div>
</body>

</html>