<?php
require('controller/fpdf/fpdf.php');
$servername = "localhost";
$username = "root";
$password = "";
$database = "group17"; // Update this with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function appointment_slip($appointmentID){
    global $conn;
    $query = "SELECT *, CONCAT(lastName, ', ', firstName, ' ', middleName) patientName FROM appointmenttbl a INNER JOIN patienttbl p ON p.patientID = a.patientID WHERE appointmentID = '$appointmentID'";
    $result = mysqli_query($conn, $query);
    return $result;
}

$appointmentID = $_GET['id'];
$result = appointment_slip($appointmentID);
$row = mysqli_fetch_assoc($result);

$appointmentNumber = $row['appointmentID'];
$patientName = $row['patientName'];
$birthdate = date('F j, Y', strtotime($row['birthDate']));
$serviceType = $row['serviceType'];
$note = $row['appointmentNote'];
$patientLastName = $row['lastName'];
$dateOfVisit = $row['dateOfVisit'];

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../media/bmhcmh-logo.png',5,5,20);
        // Arial bold 15
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(20);
        // Title
        $this->Cell(30,5,'Brgy. Miranda Health Center',0,'C');
        $this->Cell(30,5,'Online Appointment Slip',0,'C');
        // Line break
        $this->Ln(15);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Get the current date and time
        $generatedDateTime = date('Y-m-d H:i:s');
        // Display the generated date and time
        $this->Cell(0,10,'Generated date: '.$generatedDateTime,0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', array(100,100));
$pdf->SetFont('Arial','',11);

$pdf->Cell(0,0,'Name:           '.$patientName ,0,1);
$pdf->Cell(0,10,'Date of Birth: '.$birthdate ,0,1);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 75, $pdf->GetY());
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,$serviceType ,0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0,'Appointment Note: '.$note ,0,1);

$pdf->Output('D', 'appointment_'.$patientLastName.$dateOfVisit.'.pdf');
?>
