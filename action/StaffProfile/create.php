<?php
  header('Content-Type: application/json');
    include '../../Config/conect.php';
    // if(isset($_POST['btnSubmit'])){
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
      if (!$result) {
          throw new Exception('Error creating staff profile: ' . $con->error);
      }

      $member = $_POST['familyMembers'];
      $familyMembers = json_decode($member, true);
      // echo $member;
      if($familyMembers){
        foreach($familyMembers as $member){
            $relationName = $member['name'];
            $relationType = $member['retype'];
            $gender = $member['gender'];
            $isTax = $member['isTax'];
            
             $familySQL = "INSERT INTO `hrfamily` (`EmpCode`, `RelationName`, `RelationType`, `Gender`, `IsTax`)
            VALUES ('$empcode', '$relationName', '$relationType', '$gender', '$isTax')";
            $familyResult = $con->query($familySQL);
            if (!$familyResult) {
                throw new Exception('Error creating family member: ' . $con->error);
            }
          }
         
          $familyStmt->close();
      }
      

        echo json_encode([
            'status' => 'success',
            'message' => 'Staff profile created successfully'
        ]);

      // $result = $con->query($SQL);
      // echo "success"
      // if($result){
      //  $message ="Data Inserted";
      //   header("Location: ../../view/StaffProfile/index.php?message=$message");
      //   exit();
      // }

    //}
?>