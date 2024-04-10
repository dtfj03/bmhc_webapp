<?php

    require_once('config/config.php');
    require_once('dashboard/controller/dashboard-controller.php');

    $result_table = appointment_table();
    $announcements = announcement();
    $sched_list = schedule();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,700,1,0" />
</head>

<body>
    <div class="menu-container">
        <div>
        <img src="media/bmhcmh-logo.png" style="height: 70px; margin: none;">
        </div>
        <div class="menu-title">
            <span style="font-size: 0.9em; font-weight:bolder;">Miranda Health Center<br>
                Multipurpose Hub<br></span>
            <span style="font-size:0.6em;">Brgy. Miranda, Pontevedra, Negros Occidental</span>
        </div>
        <div class="menu-item"><a href="index.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">home</span><br>HOME</a>
        </div>
        <div class="menu-item"><a href="schedule/schedule-menu.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">calendar_month</span><br>SCHEDULE</a>
        </div>
        <div class="menu-item"><a href="appointment/add-appointment.php">
            <span class="material-symbols-outlined" style="font-size:1.7em;">user_attributes</span><br>APPOINTMENT</a>
        </div>
        <div class="menu-item"> <a href="admLogin/login.php">
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
            <h class="title">ABOUT BARANGGAY MIRANDA HEALTH CENTER</h><br>
        <span>
        Miranda Health Center, situated in Brgy. Miranda, Pontevedra, Negros Occidental, stands as a government-owned bastion of 
        community health and well-being. With a clear vision of fostering a healthy community devoid of any forms of malnutrition, 
        the health center is committed to ensuring that the residents of the barangay lead fulfilling lives marked by optimal health 
        and well-being. The center's mission is dedicated to delivering essential health services and providing nutritious goods, 
        particularly to households with malnourished children. In addition to addressing immediate health needs, Miranda Health 
        Center aims to empower the community by offering guidance and education on simple yet effective practices for maintaining a 
        healthy lifestyle within the confines of their homes. Through its tireless efforts, the health center strives to enable 
        individuals to reach their full potential in health, fostering a resilient and vibrant community in the process.
        </span><br>
        <hr>
            <h class="title">SERVICES OFFERED</h><br>
            <div>
            <img src="media/home-icons/s1.png" class="service-icon">
            <span style="font-size: 1.2em">PRENATAL CHECKUP</span><br>
            <span>Comprehensive prenatal care ensuring the health and well-being of expectant mothers and their unborn babies. </span><br>
            <a href="appointment/add-appointment.php">
            <button>Schedule an Appointment</button><a>
            </div><br>
            <div>
            <img src="media/home-icons/s2.png" class="service-icon">
            <span style="font-size: 1.2em">POSTPARTUM VISIT</span><br>
            <span>Tailored care and support for mothers in the crucial post-delivery period to promote optimal recovery and newborn care. </span><br>
            <button>Schedule an Appointment</button>
            </div><br>
            <img src="media/home-icons/s3.png" class="service-icon">
            <span style="font-size: 1.2em">IMMUNIZATION</span><br>
            <span>Vital vaccinations provided to newborns and senior citizens, safeguarding them against preventable diseases.</span><br>
            <button>Schedule an Appointment</button>
            </div><br>
            <img src="media/home-icons/s4.png" class="service-icon">
            <span style="font-size: 1.2em">FAMILY PLANNING COUNSELING</span><br>
            <span>Personalized guidance and support for individuals and couples in making informed decisions regarding contraception and family planning.</span><br>
            <button>Schedule an Appointment</button>
            </div><br>
            <img src="media/home-icons/s5.png" class="service-icon">
            <span style="font-size: 1.2em">DESPENSING OF MEDICINE</span><br>
            <span>Accessible provision of essential medications, ensuring effective treatment and management of various health conditions.</span><br>
            <button>Schedule an Appointment</button>
            </div><br>
            <img src="media/home-icons/s6.png" class="service-icon">
            <span style="font-size: 1.2em">NTP (TB-DOTS)</span><br>
            <span>Specialized tuberculosis management program offering Directly Observed Treatment Short-course (DOTS) for effective TB control and patient support.</span><br>
            <button>Schedule an Appointment</button>
            </div><br>
            <img src="media/home-icons/s7.png" class="service-icon">
            <span style="font-size: 1.2em">OPERATION TIMBANG</span><br>
            <span>Community-based nutritional assessment program aimed at monitoring the growth and nutritional status of children to combat malnutrition effectively.</span><br>
            <button>Schedule an Appointment</button>
            </div><br>

    </div>
</body>

</html>