<?php

    require_once('..\config\config.php');
    require_once('..\dashboard\controller/dashboard-controller.php');
    include_once('controller/edit-schedule-controller.php');


    $announcements = announcement();
    $sched_list = schedule();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="../css/style.css?v2">
    <link rel="stylesheet" href="../css/sidebar-style.css">
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
            <span class="material-symbols-outlined" style="font-size:1.7em; text-decoration: underline;" title="SCHEDULE">calendar_month</span></a>
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
    <?php

    if(isset($_GET['id'])) {

    $schedule_id = $_GET['id'];

    $schedule = new EditScheduleController;

    $result = $schedule->edit($schedule_id);
 
    if($result) {
    ?>
        <h>EDIT SCHEDULE</h>
        <form method="POST" action="process/edit-schedule-process.php">
            <input type="hidden" name="sched_id" value="<?=htmlspecialchars($result['eventID'])?>" />
            <label for="title">Title</label><br>
                <input type="text" name="sched_title" value="<?=htmlspecialchars($result['eventTitle'])?>" required/><br>
            <label for="date">Date</label>
                <input type="date" name="sched_date" class="datetime" value="<?=htmlspecialchars($result['eventDate'])?>" />
            <label for="time">Time</label>
                <input type="text" name="sched_time" class="datetime" value="<?=htmlspecialchars($result['eventTime'])?>" /><br>
            <label for="location">Location</label><br>
                <input type="text" name="sched_location" value="<?=htmlspecialchars($result['eventLocation'])?>" /><br>
            <label for="note">Comment/Note</label><br>
                <input type="text" name="sched_note" value="<?=htmlspecialchars($result['eventNote'])?>" /><br>
            <button type="submit" name="update_schedule" value="<?= $result['eventID'] ?>" class="submit">Update Schedule</button>
            <button type="submit" style="background:#ca0b00;" name="delete_schedule" value="<?= $result['eventID'] ?>" class="submit">Delete Schedule</button>
        </form>
    <?php
    } else {
        echo "<h4>No Record Found</h4>";
    }
    } else {
    echo "<h4>Event ID is not provided</h4>";
    }
    ?>
    </div>
</body>

</html>