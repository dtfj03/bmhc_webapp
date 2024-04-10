<?php

    require_once('../config/config.php');
    require_once('../dashboard/controller/dashboard-controller.php');
    include_once('controller/add-schedule-controller.php');


    $announcements = announcement();
    $sched_list = schedule();
    $archive = past_schedule();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
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
            <a href="../admProfile/edit-profile.php"><span class="material-symbols-outlined" style="font-size:1.7em;">account_circle</span><br></a>
            <a href="../admLogin/process/logout-session.php">LOGOUT</a>
        </div>
    </div>

    <div class="sidebar-container">
        UPCOMING EVENTS
        <hr>
        <?php
            while ($row = mysqli_fetch_assoc($sched_list)) {
                $formatted_date = date('F j, Y', strtotime($row['eventDate']));
                ?>
                <?php echo $formatted_date; ?> <br>
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

    <div class="content">
        <h>ADD NEW SCHEDULE</h>
        <form method="POST" action="process/add-schedule-process.php">
            <label for="title">Title</label><br>
                <input type="text" name="title" required/><br>
            <label for="date">Date</label>
                <input type="date" name="date" min="<?php echo date("Y-m-d"); ?>" />
            <label for="time">Time</label>
                <input type="text" name="time" class="datetime"/><br>
            <label for="location">Location</label><br>
                <input type="text" name="location"/><br>
            <label for="note">Comment/Note</label><br>
                <input type="text" name="note"/><br>
            <input type="submit" name="add_schedule" value="Add Schedule" />
        </form>

        <br><br><br>

        <h>ARCHIVED SCHEDULES</h><br><hr>
        <div class="sched-container">
        <?php
            while ($row = mysqli_fetch_assoc($archive)) {
                ?>
                <div class="sched-item">
                <?php echo $row['eventDate']; ?> <br>
                <?php echo $row['eventTitle']; ?> <br>
                <?php echo $row['eventLocation']; ?> <br>
                <form method="POST" action="process/delete-schedule-process.php">
                <input type="hidden" name="sched_id" value="<?=htmlspecialchars($result['eventID'])?>" />
                <button type="submit" name="delete_schedule" value="<?= $result['eventID'] ?>" class="submit">Delete Schedule</button>
                </form>
                <br><br>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>