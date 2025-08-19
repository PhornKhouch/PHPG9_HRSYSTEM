<?php
include("../../Config/conect.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $id = intval($_POST['id']);
        
        // Prepare and execute the delete query
        $stmt = $con->prepare("DELETE FROM prpaypolicy WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $con->error);
        }

        $stmt->bind_param("i", $id);
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Policy deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Policy not found']);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        error_log("Error in delete.php: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Error deleting policy: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$con->close();
?>
