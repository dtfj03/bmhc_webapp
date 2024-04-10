<?php
include_once('..\config\dbconn.php');

class SearchPatientController
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function searchPatient($search_term, $filter)
    {
        $search_term = mysqli_real_escape_string($this->conn, $search_term);
        
        // Construct the WHERE clause based on the selected filter
        $where_clause = "$filter LIKE '%$search_term%'";
        
        // Construct the SQL query with the WHERE clause
        $search_query = "SELECT *, CONCAT(lastName, ', ', firstName, ' ', middleName) AS patientName
                        FROM patienttbl p
                        INNER JOIN appointmenttbl a ON p.patientID = a.patientID
                        WHERE $where_clause";

        $result = $this->conn->query($search_query);
    
        if ($result && $result->num_rows > 0) {
            $search_results = [];
            while ($row = $result->fetch_assoc()) {
                $search_results[] = $row;
            }
            return $search_results;
        } else {
            return false;
        }
    }
    
}
?>
