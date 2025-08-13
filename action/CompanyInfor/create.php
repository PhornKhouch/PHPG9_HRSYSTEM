<?php
include("../../Config/conect.php");

if($_POST['type']=="Company")
{
    try {
        $code=$_POST['code'];
        $name=$_POST['name'];
        $status=$_POST['status'];
        $sql="INSERT INTO hrcompany values('$code','$name','$status')";
        if ($con->query($sql) === TRUE) {
            echo "Data Inserted successfully";
        } else {
            throw new mysqli_sql_exception($con->error);
        }
    } catch (mysqli_sql_exception $e) {
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            echo "Duplicate Code: The company code '$code' already exists";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
