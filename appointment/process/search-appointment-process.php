<?php
session_start();
include_once('..\config\dbconn.php');
include_once('controller\search-appointment-controller.php');

if(isset($_POST['search_patient'])) {
    $searchTerm = $_POST['search_term'];
    $filter = $_POST['filter'];
    
    $searchController = new SearchPatientController();
    $search_results = $searchController->searchPatient($searchTerm, $filter);
}
?>
