<?php
include("../../Config/conect.php");

if (isset($_POST['type']) && $_POST['type'] == "LeaveType") {
    $code = $_POST['code'];
    $leaveType = $_POST['leaveType'];
    
    // Handle checkbox values
    $isded = ($_POST['isded'] === 'on') ? 1 : 0; // ternary operator
    $isOverBalance = ($_POST['isOverBalance'] === 'on') ? 1 : 0;
    $isProbation = ($_POST['isProbation'] === 'on') ? 1 : 0;

    // Prepare the SQL with proper escaping to prevent SQL injection
    $code = $con->real_escape_string($code);
    $leaveType = $con->real_escape_string($leaveType);
    
    $SQL = "INSERT INTO lmleavetype (Code, LeaveType, IsDeduct, IsOverBalance, IsProbation) 
            VALUES ('$code', '$leaveType', $isded, $isOverBalance, $isProbation)";
            
    $result = $con->query($SQL);
    
    if($result) {
        echo "New record created successfully";
    } else {
        http_response_code(400);
        echo "Error: " . $con->error;
    }
}
else  if (isset($_POST['type']) && $_POST['type'] == "PublicHoliday") {
    $holiday_name = $_POST['holiday_name'];
    $holiday_date = $_POST['holiday_date'];
    $description = $_POST['description'];
    
    // Prepare the SQL with proper escaping to prevent SQL injection
    $holiday_name = $con->real_escape_string($holiday_name);
    $holiday_date = $con->real_escape_string($holiday_date);
    $description = $con->real_escape_string($description);
    
    $SQL = "INSERT INTO public_holidays (holiday_name, holiday_date, description) 
            VALUES ('$holiday_name', '$holiday_date', '$description')";
            
    $result = $con->query($SQL);
    
    if($result) {
        echo "New record created successfully";
    } else {
        http_response_code(400);
        echo "Error: " . $con->error;
    }
}



?>
