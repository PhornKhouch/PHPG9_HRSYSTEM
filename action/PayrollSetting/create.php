<?php
include("../../Config/conect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $code = $_POST['code'];
        $description = $_POST['description'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $hourPerDay = floatval($_POST['hourPerDay']);
        $workDay = floatval($_POST['workDay']);
        
        // Get day values (0 if unchecked, 1 if checked)
        $mon = isset($_POST['mon']) ? 1 : 0;
        $tue = isset($_POST['tue']) ? 1 : 0;
        $wed = isset($_POST['wed']) ? 1 : 0;
        $thu = isset($_POST['thu']) ? 1 : 0;
        $fri = isset($_POST['fri']) ? 1 : 0;
        $sat = isset($_POST['sat']) ? 1 : 0;
        $sun = isset($_POST['sun']) ? 1 : 0;

        // Get hours for each day
        $monHours = $mon ? floatval($_POST['monHours']) : 0;
        $tueHours = $tue ? floatval($_POST['tueHours']) : 0;
        $wedHours = $wed ? floatval($_POST['wedHours']) : 0;
        $thuHours = $thu ? floatval($_POST['thuHours']) : 0;
        $friHours = $fri ? floatval($_POST['friHours']) : 0;
        $satHours = $sat ? floatval($_POST['satHours']) : 0;
        $sunHours = $sun ? floatval($_POST['sunHours']) : 0;
        // Calculate total hours
        $totalHours = $monHours + $tueHours + $wedHours + $thuHours + $friHours + $satHours + $sunHours;
      
        // Check if total hours exceed 40
        if ($totalHours > 48) {
            throw new Exception("Total work hours cannot exceed 48 hours per week");
            exit();
        }
        // Insert new record with lowercase column names
        $sql = "INSERT INTO prpaypolicy (code, description, workday, hourperday, hourperweek, fromdate, todate, 
                mon, monhours, tues, tueshours, wed, wedhours, thur, thurhours, 
                fri, frihours, sat, sathours, sun, sunhours) 
                VALUES ('$code', '$description', '$workDay', '$hourPerDay', '', '$fromDate', '$toDate', 
                '$mon', '$monHours', '$tue', '$tueHours', '$wed', '$wedHours', '$thu', '$thuHours', 
                '$fri', '$friHours', '$sat', '$satHours', '$sun', '$sunHours')";
                
        $stmt = $con->query($sql);
        if (!$stmt) {
            throw new Exception("Query failed: " . $con->error);
        }
        
        // Return success response for AJAX
        echo json_encode([
            'status' => 'success',
            'message' => 'Payroll policy saved successfully!'
        ]);
      

    } catch (Exception $e) {
        // Return error response for AJAX
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit();
    }
} else {
    // Return error response for invalid request
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
    exit();
}

$con->close();
?>