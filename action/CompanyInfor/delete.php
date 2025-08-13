<?php
include("../../Config/conect.php");
//delete company
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Company") {
    $code = $_POST['code'];

    // Validate input
    if (empty($code)) {
        http_response_code(400);
        echo "Company code is required";
        exit;
    }

    // Delete the company
    $sql = "DELETE FROM hrcompany WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $code);

    if ($stmt->execute()) {
        echo "Company deleted successfully";
    } else {
        http_response_code(500);
        echo "Error deleting company: " . $con->error;
    }

    $stmt->close();
} 

$con->close();
?>
