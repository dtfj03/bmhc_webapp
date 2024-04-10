<?php

    require_once('..\config\config.php');
    require_once('..\dashboard\controller\dashboard-controller.php');
    //include ('controller/calendar-controller.php');


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
    <link rel="stylesheet" href="../css/calendar-style.php">
    <link rel="stylesheet" href="../css/schedule-style.css">
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
        <div class="menu-item"><a href="../index.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">home</span><br>HOME</a>
        </div>
        <div class="menu-item"><a href="schedule-menu.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">calendar_month</span><br>SCHEDULE</a>
        </div>
        <div class="menu-item"><a href="../appointment/add-appointment.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">user_attributes</span><br>APPOINTMENT</a>
        </div>
        <div class="menu-item"> <a href="../admLogin/login.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">account_circle</span><br>
           LOGIN</a>
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
                <?php echo $formatted_date; ?> <br>
                <?php echo $row['eventTitle']; ?> <br>
                <?php echo $row['eventLocation']; ?> <br>
                <?php $eventNote = $row['eventNote']; 
                    if (strlen($eventNote) > 0) { ?>
                <span>Note:<br>
                    "<?php echo $row['eventNote']?>"</span>
                    <?php } else  { ?>
                        
                        <?php } ?>
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
                <br>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="content">
        <h>UPCOMING SCHEDULES</h>
        <div class="sched-container">
        <?php while ($row = mysqli_fetch_assoc($sched_list)) {
                $formatted_date = date('F j, Y', strtotime($row['eventDate'])); ?>
                <div class="schedules">
                <?php echo $formatted_date; ?> <br>
                <?php echo $row['eventTitle']; ?> <br>
                <?php echo $row['eventLocation']; ?> <br>
                <?php $eventNote = $row['eventNote']; ?>
                </div>
        <?php } ?>
        </div>

</div>
</body>

</html>