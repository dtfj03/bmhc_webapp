<?php
session_start();

    require_once('../config/config.php');
    require_once('../dashboard/controller/dashboard-controller.php');
    include_once('controller/update-appointment-controller.php');

    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
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
    <?php
    if(isset($_GET['id'])) {
        $appointment_id = $_GET['id'];

        $appointment = new UpdateAppointmentController;

        $result = $appointment->edit($appointment_id);

        if($result) {
    ?>
        <h>UPDATE AN APPOINTMENT</h>
    <form method="POST" action="process/update-appointment-process.php">
    <input type="hidden" name="appointment_id" value="<?= $appointment_id ?>">
        <div class="patient-container">
            <div class="patient-data">
                <label for="last_name">Last Name</label><br>
                <input type="text" name="last_name" value="<?=htmlspecialchars($result['lastName'])?>" disabled />
            </div>
            <div class="patient-data">
                <label for="first_name">First Name</label><br>
                <input type="text" name="first_name" value="<?=htmlspecialchars($result['firstName'])?>" disabled />
            </div>
            <div class="patient-data">
                <label for="birthdate">Date of Birth</label><br>
                <input type="date" name="birthdate" value="<?=htmlspecialchars($result['birthDate'])?>" disabled />
            </div>
        </div><hr>

        <div class="patient-container">
            <div class="patient-data">
                <label for="service_type">Type of Service</label>
                <input type="text" name="service_type" value="<?=htmlspecialchars($result['serviceType'])?>" disabled >
            </div>
            <div class="patient-data">
                <label for="visit_date">Date of Visit</label><br>
                <input type="date" name="visit_date" value="<?=htmlspecialchars($result['dateOfVisit'])?>" disabled />
            </div>
        </div>
        <div class="patient-container">
            <div class="patient-data">
            <label for="note">Additional Note</label><br>
            <input type="text" name="note" value="<?=htmlspecialchars($result['appointmentNote'])?>" disabled />
            </div>
        <div class="patient-container">
            <div class="patient-data">
            <label for="status">Appointment Status</label><br>
            <select name="status">
                <option value="PENDING">Pending</option>
                <option value="CONFIRMED">Confirmed</option>
            </select>
            </div>
        </div>
        <input type="submit" value="Update Appointment" name="update_appointment" />
    </form>
    <?php
        } else {
            echo "<h>No Record Found</h>";
        }
    } else {
        echo "<h>Appointment ID is not provided</h>";
    }
    ?>

    </div>
</body>

</html>