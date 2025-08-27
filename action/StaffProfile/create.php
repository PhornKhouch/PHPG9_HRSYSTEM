<?php
    include '../../Config/conect.php';
    if(isset($_POST['btnSubmit'])){
      $empcode = $_POST['empCode'];
      $empname = $_POST['empName'];
      $gender = $_POST['gender'];
      $dob = $_POST['dob'];
      $salary = $_POST['salary'];
      $company = $_POST['company'];
      $department = $_POST['department'];
      $position = $_POST['position'];
      $level = $_POST['level'];
      $division = $_POST['division'];
      $startdate= $_POST['startDate'];
      $proDate = $_POST['probationDate'];
      $telegram = $_POST['telegram'];
      $email = $_POST['email'];
      $phone = $_POST['contact'];
      $address= $_POST['address'];
      $SQL = "INSERT INTO `hrstaffProfile` (`empCode`, `empName`, `gender`, `dob`, `salary`, `Company`, `Department`, `Position`, `Level`, `Division`, `StartDate`, `ProbationDate`, `Telegram`, `Email`, `Contact`, `Address`)
       VALUES ('$empcode', '$empname', '$gender', '$dob', '$salary', '$company', '$department', '$position', '$level', '$division', '$startdate', '$proDate', '$telegram', '$email', '$phone', '$address')";



      $result = $con->query($SQL);
      if($result){
       $message ="Data Inserted";
        header("Location: ../../view/StaffProfile/index.php?message=$message");
        exit();
      }

    }
?>