<?php

    require_once('../config/config.php');
    require_once('../dashboard/controller/dashboard-controller.php');
    

    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
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
                <a href="../schedule/edit-sched.php?id=<?=$row['eventID'];?>"><u>Edit Event</u></a>
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

        <h>ADD NEW PATIENT</h>
<form method="POST" action="process/add-patient-process.php">
    <div class="patient-container">
        <div class="patient-data">
            <label for="last_name">Last Name</label><br>
            <input type="text" name="last_name" required />
        </div>
        <div class="patient-data">
            <label for="first_name">First Name</label><br>
            <input type="text" name="first_name" required />
        </div>
        <div class="patient-data">
            <label for="middle_name">Middle Name</label><br>
            <input type="text" name="middle_name" required />
        </div>
    </div>
    <div class="patient-container">
        <div class="patient-data">
            <label for="patient_sex">Sex</label><br>
            <select name="patient_sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="patient-data">
            <label for="patient_dob">Date of Birth</label><br>
            <input type="date" name="patient_dob" max="<?php echo date("Y-m-d"); ?>" required />
        </div>
    </div><hr>
        <h>ADDRESS</h>
    <div class="patient-container">
        <div class="patient-data">
            <label for="patient_purok">Purok</label><br>
            <input type="text" name="patient_purok" required />
        </div>
    </div><hr>
    <div class="patient-container">
        <div class="patient-data">
            <label for="patient_pob">Place of Birth</label><br>
            <input type="text" name="patient_pob" required />
        </div>
    </div>
    <div class="patient-container">
        <div class="patient-data">
            <label for="patient_pobprov">Province</label><br>
            <select name="patient_pobprov" id="patient_pobprov" onchange="populateCities()" required>
                <option value="neg_occ">Negros Occidental</option>
                <option value="neg_or">Negros Oriental</option>
            </select>
        </div>
        <div class="patient-data">
            <label for="patient_pobcity">City/Municipality</label><br>
            <select name="patient_pobcity" id="patient_pobcity" required>
                <!-- Options will be populated dynamically using JavaScript -->
            </select>
        </div>
    </div>
    <hr>
    <input type="submit" value="Add Patient" name="add_patient" />
</form>

<script>
    function populateCities() {
        var province = document.getElementById("patient_pobprov").value;
        var cityDropdown = document.getElementById("patient_pobcity");

        // Clear existing options
        cityDropdown.innerHTML = "";

        // Populate options based on selected province
        if (province === "neg_occ") {
            var cities = ["Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"];
        } else if (province === "neg_or") {
            var cities = ["Amlan", "Ayungon", "Bacong", "Bais City", "Basay", "Bayawan City", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita"];
        }

        // Add options to the dropdown
        for (var i = 0; i < cities.length; i++) {
            var option = document.createElement("option");
            option.text = cities[i];
            cityDropdown.add(option);
        }
    }

    // Call populateCities initially to populate cities based on the default province
    populateCities();
</script>

    </div>
</body>

</html>
