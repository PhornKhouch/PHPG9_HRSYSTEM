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


//update department
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Department") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Validate inputs
    if (empty($code) || empty($name) || empty($status)) {
        http_response_code(400);
        echo "All fields are required";
        exit;
    }

    // Update the department
    $sql = "UPDATE hrdepartment SET Description = ?, Status = ? WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $status, $code);

    if ($stmt->execute()) {
        echo "Department updated successfully";
    } else {
        echo "Error updating department: " . $con->error;
    }

    $stmt->close();
}

//update division
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Division") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Validate inputs
    if (empty($code) || empty($name) || empty($status)) {
        http_response_code(400);
        echo "All fields are required";
        exit;
    }

    // Update the division
    $sql = "UPDATE hrdivision SET Description = ?, Status = ? WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $status, $code);

    if ($stmt->execute()) {
        echo "Division updated successfully";
    } else {
        echo "Error updating division: " . $con->error;
    }

    $stmt->close();
}

//update level
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Level") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Validate inputs
    if (empty($code) || empty($name) || empty($status)) {
        http_response_code(400);
        echo "All fields are required";
        exit;
    }

    // Update the level
    $sql = "UPDATE hrlevel SET Description = ?, Status = ? WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $status, $code);

    if ($stmt->execute()) {
        echo "Level updated successfully";
    } else {
        echo "Error updating level: " . $con->error;
    }

    $stmt->close();
}


//update position
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type']) && $_POST['type'] == "Position") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // Validate inputs
    if (empty($code) || empty($name) || empty($status)) {
        http_response_code(400);
        echo "All fields are required";
        exit;
    }

    // Update the level
    $sql = "UPDATE hrposition SET Description = ?, Status = ? WHERE Code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $status, $code);

    if ($stmt->execute()) {
        echo "Position updated successfully";
    } else {
        echo "Error updating level: " . $con->error;
    }

    $stmt->close();
}
$con->close();
?>
