<?php

    include('../config/config.php');
    include('../dashboard/controller/dashboard-controller.php');
    include ('process/search-patient-process.php');

    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
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
        <div class="menu-item"><a href="search-patient.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">person_search</span><br>SEARCH</a>
        </div>
        <div class="menu-item"><a href="../admProfile/edit-profile.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">account_circle</span><br></a>
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
        <button><a href="search-patient.php"><span class="material-symbols-outlined">person_search</span>
            Search Patient</a></button>
        <button><a href="add-patient.php"><span class="material-symbols-outlined">person_add</span>
            Add Patient Data</a></button>

        <br><hr>

            <?php

            ?>
<!-- Display search form -->
<h>SEARCH PATIENT</h>
<form method="POST" action="">
    <input type="text" name="search_term" placeholder="Search term" />
    <label for="filter">Filter by:</label>
    <select name="filter">
        <option value="lastName">Last Name</option>
        <option value="firstName">First Name</option>
    </select>
    <input type="submit" name="search_patient" value="Search">
</form>

<!-- Display search results if available -->
<?php if(isset($search_results) && !empty($search_results)) { ?>
    <br><br><br>
    <table border='1'>
        <tr>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Birthdate</th>
            <th>Address</th>
        </tr>
        <?php foreach ($search_results as $row) { ?>
            <tr>
                <td><?php echo $row['patientID']; ?></td>
                <td><?php echo $row['patientName']; ?></td>
                <td><?php echo $row['patientSex']; ?></td>
                <td><?php echo $row['birthDate']; ?></td>
                <td><?php echo $row['addressPurok']; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } elseif(isset($search_results) && empty($search_results)) { ?>
    <p>No results found.</p>
<?php } ?>

    </div>
</body>

</html>