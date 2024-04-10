<?php

    require_once('../config/config.php');
    require_once('../dashboard/controller/dashboard-controller.php');
    include_once('../appointment/process/search-appointment-process.php');
    

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
        <div class="menu-item"><a href="../index.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">home</span><br>HOME</a>
        </div>
        <div class="menu-item"><a href="../schedule/schedule-menu.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">calendar_month</span><br>SCHEDULE</a>
        </div>
        <div class="menu-item"><a href="add-appointment.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">user_attributes</span><br>APPOINTMENT</a>
        </div>
        <div class="menu-item"><a href="../admLogin/login.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">account_circle</span><br>LOGIN</a>
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
        <h>SCHEDULE AN APPOINTMENT</h>
    <form method="POST" action="process/add-appointment-process.php">
        <div class="patient-container">
            <div class="patient-data">
                <label for="last_name">Last Name</label><br>
                <input type="text" name="last_name" />
            </div>
            <div class="patient-data">
                <label for="first_name">First Name</label><br>
                <input type="text" name="first_name" />
            </div>
            <div class="patient-data">
                <label for="birthdate">Date of Birth</label><br>
                <input type="date" name="birthdate" max="<?php echo date("Y-m-d"); ?>"/>
            </div>
        </div><hr>

        <div class="patient-container">
            <div class="patient-data">
                <label for="service_type">Type of Service</label>
                <select name="service_type">
                    <option value="Despensing of Medicine">Despensing of Medicine</option>
                    <option value="Immunization">Immunization</option>
                    <option value="Prenatal Checkup">Prenatal Checkup</option>
                    <option value="NTP (TB-DOTS)">NTP (TB-DOTS)</option>
                    <option value="Postpartum Visit">Postpartum Visit</option>
                    <option value="Family Planning Counseling">Family Planning Counseling</option>
                    <option value="Operation Timbang">Operation Timbang</option>
                </select>
            </div>
            <div class="patient-data">
                <label for="visit_date">Date of Visit</label><br>
                <input type="date" name="visit_date" min="<?php echo date("Y-m-d"); ?>"/>
            </div>
        </div>
        <div class="patient-container">
            <div class="patient-data">
            <label for="note">Additional Note</label><br>
            <input type="text" name="note" />
            </div>
        </div>
        <input type="submit" value="Confirm Appointment" name="add_appointment" />
    </form><br><br><br><hr>

        <!-- Display search form -->
    <h>SEARCH APPOINTMENT STATUS</h>
    <form method="POST" action="">
        <div class="patient-container">
            <div class="patient-data">
        <input type="text" name="search_term" placeholder="Search term" />
            </div>
            <div class="patient-data">
        <select name="filter">
            <option value="lastName">Last Name</option>
            <option value="firstName">First Name</option>
            <option value="patientID">Patient ID</option>
        </select>
            </div>
            <div class="patient-data">
        <input type="submit" name="search_patient" value="Search">
            </div>
        </div>
    </form>

    <!-- Display search results if available -->
    <?php if(isset($search_results) && !empty($search_results)) { ?>
        <br><br><br>
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>Type of Service</th>
                <th>Date of Appointment</th>
                <th>Appointment Status</th>
            </tr>
            <?php foreach ($search_results as $row) { ?>
                <tr>
                    <td><?php echo $row['patientName']; ?></td>
                    <td><?php echo $row['serviceType']; ?></td>
                    <td><?php echo $row['dateOfVisit']; ?></td>
                    <td><?php echo $row['appointmentStatus']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } elseif(isset($search_results) && empty($search_results)) { ?>
        <p>No results found.</p>
    <?php } ?>


    </div>
</body>

</html>