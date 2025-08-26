<?php
    include '../../Config/conect.php';
    if(isset($_POST['btnSubmit'])){
      $empcode = $_POST['empCode'];
      $empname = $_POST['empName'];
      $gender = $_POST['gender'];
      $dob = $_POST['dob'];
      $salary = $_POST['salary'];
      $SQL = "INSERT INTO `hrstaffProfile` (`empCode`, `empName`, `gender`, `dob`, `salary`) VALUES ('$empcode', '$empname', '$gender', '$dob', '$salary')";
      $result = $con->query($SQL);
      if($result){
        echo "Data Inserted";
      }

    }
?>