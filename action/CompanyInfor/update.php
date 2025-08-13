<?php
include("../../Config/conect.php");
//update company
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Company") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Validate inputs
    if (empty($code) || empty($name) || empty($status)) {
        http_response_code(400);
        echo "All fields are required";
        exit;
    }

    // Update the company
    $sql = "UPDATE hrcompany SET Description = ?, Status = ? WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $status, $code);

    if ($stmt->execute()) {
        echo "Company updated successfully";
    } else {
        echo "Error updating company: " . $con->error;
    }

    $stmt->close();
} 


$con->close();
?>
