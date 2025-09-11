<?php
include("../../Config/conect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $empcode = $_POST['employeeID'];
  $ottype = $_POST['overtimeType'];
    $otdate = $_POST['overtimeDate'];
    $fromtime = $_POST['fromTime'];
    $totime = $_POST['toTime'];
    $reason = $_POST['reason'];

    // Calculate hours
    $from = new DateTime($fromtime);
    $to = new DateTime($totime);
    $interval = $from->diff($to);
    $hours = $interval->h + ($interval->i / 60);

    $sql = "UPDATE provertime SET 
            Empcode = ?, 
            OTType = ?, 
            OTDate = ?, 
            FromTime = ?, 
            ToTime = ?, 
            hour = ?, 
            Reason = ?
            WHERE ID = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssssi", $empcode, $ottype, $otdate, $fromtime, $totime, $hours, $reason, $id);
    
    if ($stmt->execute()) {
        header("Location: ../../view/PROvertime/index.php?success=" . urlencode("Overtime request updated successfully"));
        exit();
    } else {
        header("Location: ../../view/PROvertime/edit.php?id=" . urlencode($id) . "&error=" . urlencode("Error updating overtime request"));
        exit();
    }
}
?>