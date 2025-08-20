<?php
include("../../Config/conect.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = intval($_POST['id']);
        $code = $_POST['code'];
        $description = $_POST['description'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $hourPerDay = floatval($_POST['hour_per_day']);
        $workDay = floatval($_POST['work_day']);
        
        // Convert checkboxes to boolean values (0 or 1)
        $mon = isset($_POST['mon']) ? 1 : 0;
        $tue = isset($_POST['tue']) ? 1 : 0;
        $wed = isset($_POST['wed']) ? 1 : 0;
        $thu = isset($_POST['thu']) ? 1 : 0;
        $fri = isset($_POST['fri']) ? 1 : 0;
        $sat = isset($_POST['sat']) ? 1 : 0;
        $sun = isset($_POST['sun']) ? 1 : 0;

        // Get hours for each day, default to 8 if not set
        $monHours = isset($_POST['mon_hours']) ? $_POST['mon_hours'] : 8;
        $tueHours = isset($_POST['tue_hours']) ? $_POST['tue_hours'] : 8;   
        $wedHours = isset($_POST['wed_hours']) ? $_POST['wed_hours'] : 8;
        $thuHours = isset($_POST['thu_hours']) ? $_POST['thu_hours'] : 8;
        $friHours = isset($_POST['fri_hours']) ? $_POST['fri_hours'] : 8;
        $satHours = isset($_POST['sat_hours']) ? $_POST['sat_hours'] : 8;
        $sunHours = isset($_POST['sun_hours']) ? $_POST['sun_hours'] : 8;   

        // Prepare the update query
        $sql = "UPDATE prpaypolicy SET
            description = '$description', 
            code = '$code',
            fromDate = '$fromDate',
            toDate = '$toDate',
            hourperday = '$hourPerDay', 
            hourperweek = '$workDay',
            mon = '$mon',
            monHours = '$monHours',
            tue = '$tue', 
            tueHours = '$tueHours', 
            wed = '$wed',
            wedHours = '$wedHours',
            thu = '$thu', 
            thuHours = '$thuHours', 
            fri = '$fri',
            friHours = '$friHours',
            sat = '$sat',
            satHours = '$satHours',
            sun = '$sun',
            sunHours = '$sunHours'
            WHERE id = '$id'";

        $stmt = $con->query($sql);
        echo json_encode([
            'status' => 'success',
            'message' => 'Policy updated successfully'
        ]);
    } catch (Exception $e) {
        error_log("Error in update.php: " . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'Error updating policy: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

$con->close();
?>
