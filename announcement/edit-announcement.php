<?php

    require_once('../config/config.php');
    require_once('../dashboard/controller/dashboard-controller.php');
    include_once('controller/edit-announcement-controller.php');

    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebar-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,700,1,0" />
</head>

<body>
    <div class="menu-container">
        <div>
        <img src="../media/bmhcmh-logo.png" style="height: 70px; margin: none;">
        </div>
        <div class="menu-title">
            <span style="font-size: 0.9em; font-weight:bolder;">Miranda Health Center<br>
                Multipurpose Hub<br></span>
            <span style="font-size:0.6em;">Brgy. Miranda, Pontevedra, Negros Occidental</span>
        </div>
        <div class="menu-item"><a href="../dashboard/dashboard.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">home</span><br>HOME</a>
        </div>
        <div class="menu-item"><a href="../schedule/add-schedule.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">calendar_month</span><br>SCHEDULE</a>
        </div>
        <div class="menu-item"><a href="../patient/search-patient.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">person_search</span><br>SEARCH</a>
        </div>
        <div class="menu-item"><a href="../admProfile/edit-profile.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">account_circle</span><br></a>
            <a href="../admLogin/process/logout-session.php">LOGOUT</a>
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
                    <td><?php echo $row['appointmentStatus']; ?> </td>

                </tr>
                <?php
                }
                ?>
            </tr>
        </table><br>
    <?php

// Ensure that $_GET['id'] is set
if(isset($_GET['id'])) {
    // Get the announcement ID from the URL
    $announcement_id = $_GET['id'];
    
    // Instantiate the AnnouncementController class
    $announcement = new EditAnnouncementController;
    
    // Attempt to fetch the announcement details
    $result = $announcement->edit($announcement_id);
    
    // Check if the announcement details are fetched successfully
    if($result) {
?>
    <h>EDIT ANNOUNCEMENT<h>
        <form action="process/edit-announcement-process.php" method="POST">
        <input type="hidden" name="announcement_id" value="<?=htmlspecialchars($result['announcementID'])?>">
        <label for="announcement_title">Announcement Title</label><br>
        <input type="text" name="announcement_title" value="<?=htmlspecialchars($result['announcementTitle'])?>" required /><br>
        <label for="announcement_note">Announcement Note</label><br>
        <input type="text" name="announcement_note" value="<?=htmlspecialchars($result['announcementNote'])?>" required /><br>
        <button type="submit" name="update_announcement" value="<?= $result['announcementID'] ?>">Update Announcement</button>
        <button type="submit" name="delete_announcement" value="<?= $result['announcementID'] ?>">Delete Announcement</button>
</form>
<?php
    } else {
        echo "<h4>No Record Found</h4>";
    }
} else {
    echo "<h4>Announcement ID is not provided</h4>";
}
?>

    </div>
</body>

</html>